<?php

namespace App\modules\appointment\controllers;

use App\Http\Controllers\Controller;
use App\modules\appointment\models\AppointmentModel;
use App\modules\appointment\models\TimeSlotModel;
use App\modules\appointment\requests\AppointmentRequest;
use App\modules\appointment\requests\TimeSlotRequest;
use App\modules\appointment\service\AppointmentService;
use App\modules\appointment\service\TimeSlotService;
use App\Modules\Auth\Requests\UpdateAppointmentRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    //
    // protected AppointmentService $appointmentService;
    // protected TimeSlotService $timeSlotService,

    // public function __construct(AppointmentService $appointmentService, TimeSlotService $timeSlotService)
    // {
    //     $this->appointmentService = $appointmentService;
    //     $this->timeSlotService = $appointmentService;
    // }
    public function __construct(
        protected AppointmentService $appointmentService,
        protected TimeSlotService $timeSlotService,
    ) {}

    public function showAppointment(Request $request)
    {
        $appointments = AppointmentModel::with('timeSlot')->latest()->get();
        $timeSlots = $this->timeSlotService->all();

        return Inertia::render('appointment/index', [
            'appointments' => $appointments,
            'timeSlots' => $timeSlots,
        ]);
    }
    public function show()
    {
        return view('appointment::screens.t');
    }
    public function create()
    {
        return view('appointment::screens.t');
    }
    public function edit()
    {
        return view('appointment::screens.t');
    }
    public function store(AppointmentRequest $request)
    {
        $result = $this->appointmentService->book($request->validated());

        return redirect()->back()->with('success', 'Appointment booked successfully');
    }
    public function update(UpdateAppointmentRequest $request, AppointmentModel $appointment): RedirectResponse
    {
        $this->appointmentService->update($appointment, $request->validated());

        return redirect()
            ->route('appointment.show', $appointment)
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(AppointmentModel $appointment): RedirectResponse
    {
        $this->appointmentService->destroy($appointment);

        return redirect()
            ->route('dash-appointment')
            ->with('success', 'Appointment deleted successfully.');
    }








    public function timeSlots()
    {
        $timeSlots = $this->timeSlotService->all();
        return Inertia::render('appointment/TimeSlots', [
            'timeSlots' => $timeSlots,
        ]);
    }

    public function createTimeSlot()
    {
        return view('appointment.time-slots.create');
    }

    public function storeTimeSlot(TimeSlotRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $request->boolean('status');
        $this->timeSlotService->create($data);

        return redirect()->route('appointment.slots')
            ->with('success', 'Time slot created successfully.');
    }

    public function showTimeSlot(int $id)
    {
        $timeSlot = $this->timeSlotService->find($id);
        return view('appointment.time-slots.show', compact('timeSlot'));
    }

    public function editTimeSlot(int $id)
    {
        $timeSlot = $this->timeSlotService->find($id);
        return view('appointment.time-slots.edit', compact('timeSlot'));
    }

    public function updateTimeSlot(TimeSlotRequest $request, int $id)
    {
        $timeSlot = $this->timeSlotService->find($id);
        $data = $request->validated();
        $data['status'] = $request->boolean('status');
        $this->timeSlotService->update($timeSlot, $data);

        return redirect()->route('appointment.slots')
            ->with('success', 'Time slot updated successfully.');
    }

    public function destroyTimeSlot(int $id)
    {
        $timeSlot = $this->timeSlotService->find($id);
        $this->timeSlotService->destroy($timeSlot);

        return redirect()->route('appointment.slots.index')
            ->with('success', 'Time slot deleted successfully.');
    }

    public function availableSlots(Request $request)
    {
        $slots = $this->appointmentService
            ->getAvailableSlots($request->query('date'));

        return response()->json($slots);
    }
}
