<?php

namespace App\Modules\Patient\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Patient\Requests\StorePatientRequest;
use App\Modules\Patient\Requests\UpdatePatientRequest;
use App\Modules\Patient\Services\PatientService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PatientController extends Controller
{
    protected PatientService $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    /**
     * Display a listing of patients.
     */
    public function index(): Response
    {
        $patients = $this->patientService->getAll();

        return Inertia::render('Patient/Index', [
            'patients' => $patients,
        ]);
    }

    /**
     * Show the form for creating a new patient.
     */
    public function create(): Response
    {
        return Inertia::render('Patient/Create');
    }

    /**
     * Store a newly created patient.
     */
    public function store(StorePatientRequest $request): RedirectResponse
    {
        $this->patientService->create($request->validated());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    /**
     * Show the form for editing the specified patient.
     */
    public function edit(int $id): Response
    {
        $patient = $this->patientService->findById($id);

        return Inertia::render('Patient/Edit', [
            'patient' => $patient,
        ]);
    }

    /**
     * Update the specified patient.
     */
    public function update(UpdatePatientRequest $request, int $id): RedirectResponse
    {
        $this->patientService->update($id, $request->validated());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    /**
     * Remove the specified patient.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->patientService->delete($id);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient deleted successfully.');
    }
}
