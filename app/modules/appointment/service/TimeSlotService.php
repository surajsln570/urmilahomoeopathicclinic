<?php

namespace App\modules\appointment\service;

use App\modules\appointment\models\TimeSlotModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TimeSlotService
{
    public function all()
    {
        return TimeSlotModel::orderBy('day')->orderBy('start_time')->get();
    }

    public function find(int $id): TimeSlotModel
    {
        return TimeSlotModel::findOrFail($id);
    }

    public function create(array $data): TimeSlotModel
    {
        $this->ensureNoOverlap($data);

        return DB::transaction(fn() => TimeSlotModel::create($data));
    }

    public function update(TimeSlotModel $timeSlot, array $data): TimeSlotModel
    {
        $this->ensureNoOverlap($data, excludeId: $timeSlot->id);

        DB::transaction(fn() => $timeSlot->update($data));

        return $timeSlot->fresh();
    }

    public function destroy(TimeSlotModel $timeSlot): void
    {
        $timeSlot->delete();
    }

    /**
     * Prevent overlapping slots on the same day.
     */
    protected function ensureNoOverlap(array $data, ?int $excludeId = null): void
    {
        $overlap = TimeSlotModel::where('day', $data['day'])
            ->where('start_time', '<', $data['end_time'])
            ->where('end_time', '>', $data['start_time'])
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists();

        if ($overlap) {
            throw ValidationException::withMessages([
                'start_time' => 'A time slot already exists that overlaps with this time on the selected day.',
            ]);
        }
    }
}
