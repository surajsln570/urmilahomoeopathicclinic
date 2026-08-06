<?php

namespace App\modules\appointment\service;

use App\modules\appointment\models\AppointmentModel;
use App\modules\appointment\models\TimeSlotModel;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\map;

class AppointmentService
{
    public function book(array $data): array
    {
        $slot = TimeSlotModel::find($data['time_slot_id']);

        if (!$slot || !$slot->status) {
            return [
                'success' => false,
                'status'  => 422,
                'message' => 'Selected slot is no longer available.',
            ];
        }

        $requestedDay = Carbon::parse($data['date'])->format('l');

        if ($slot->day !== $requestedDay) {
            return [
                'success' => false,
                'status'  => 422,
                'message' => 'Selected slot is not valid for this date. Please reselect.',
            ];
        }

        try {
            $appointment = AppointmentModel::create([
                'patient_name'   => $data['patient_name'],
                'patient_mobile' => $data['patient_mobile'],
                'date'           => $data['date'],
                'time_slot_id'   => $data['time_slot_id'],
                'status'         => 'pending',
            ]);
        } catch (QueryException $e) {
            Log::error('Appointment booking failed: ' . $e->getMessage());
            return [
                'success' => false,
                'status'  => 409,
                'message' => 'This slot has just been booked. Please choose another.',
            ];
        }

        return [
            'success' => true,
            'status'  => 200,
            'message' => 'Appointment booked successfully!',
            'data'    => $appointment->load('timeSlot'),
        ];
    }
    private function getHours($startTime, $endTime): float
    {
        $start = Carbon::parse($startTime);
        $end   = Carbon::parse($endTime);

        return $start->diffInHours($end);
    }
    public function getAvailableSlots(string $date): array
    {
        $dayName = Carbon::parse($date)->format('l');
        // dd($dayName);

        $daySlots = TimeSlotModel::where('day', $dayName)
            ->where('status', 1)
            ->orderBy('start_time')
            ->get();


        $availableSlots = $daySlots->filter(function ($daySlot) use ($date) {
            $appointmentCount = AppointmentModel::where('time_slot_id', $daySlot->id)->where('date', $date)
                ->count();
            $hours = $this->getHours($daySlot->start_time, $daySlot->end_time);
            // dd($appointmentCount);
            return $appointmentCount < 10 * $hours;
        });
        return $availableSlots
            ->map(function ($slot) {
                return [
                    'id'    => $slot->id,
                    'label' => Carbon::parse($slot->start_time)->format('h:i A')
                        . ' - '
                        . Carbon::parse($slot->end_time)->format('h:i A'),
                ];
            })
            ->values()
            ->toArray();
    }
    public function update(AppointmentModel $appointment, array $data): AppointmentModel
    {
        $this->ensureNoConflict($appointment, $data);

        return DB::transaction(function () use ($appointment, $data) {
            $appointment->update([
                'patient_id'       => $data['patient_id'],
                'doctor_id'        => $data['doctor_id'],
                'appointment_date' => $data['appointment_date'],
                'appointment_time' => $data['appointment_time'],
                'status'           => $data['status'] ?? $appointment->status,
                'notes'            => $data['notes'] ?? $appointment->notes,
            ]);

            return $appointment->fresh();
        });
    }

    /**
     * Prevent double-booking the same doctor at the same date/time.
     */
    protected function ensureNoConflict(AppointmentModel $appointment, array $data): void
    {
        $conflict = AppointmentModel::where('doctor_id', $data['doctor_id'])
            ->where('appointment_date', $data['appointment_date'])
            ->where('appointment_time', $data['appointment_time'])
            ->where('id', '!=', $appointment->id)
            ->exists();

        if ($conflict) {
            throw ValidationException::withMessages([
                'appointment_time' => 'This doctor already has an appointment at the selected date/time.',
            ]);
        }
    }
    public function destroy(AppointmentModel $appointment): void
    {
        $this->ensureCanBeDeleted($appointment);

        DB::transaction(function () use ($appointment) {
            $appointment->delete(); // soft delete if model uses SoftDeletes
        });
    }

    /**
     * Prevent deleting appointments that are already completed.
     */
    protected function ensureCanBeDeleted(AppointmentModel $appointment): void
    {
        if ($appointment->status === 'completed') {
            throw ValidationException::withMessages([
                'appointment' => 'Completed appointments cannot be deleted.',
            ]);
        }
    }
}
