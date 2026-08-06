<?php

namespace App\Modules\Patient\Services;

use App\Modules\Patient\Models\Patient;

class PatientService
{
    /**
     * Get all patients.
     */
    public function getAll()
    {
        return Patient::latest()->get();
    }

    /**
     * Find patient by ID.
     */
    public function findById(int $id)
    {
        return Patient::findOrFail($id);
    }

    /**
     * Create a new patient.
     */
    public function create(array $data)
    {
        return Patient::create($data);
    }

    /**
     * Update patient.
     */
    public function update(int $id, array $data)
    {
        $patient = Patient::findOrFail($id);

        $patient->update($data);

        return $patient;
    }

    /**
     * Delete patient.
     */
    public function delete(int $id)
    {
        $patient = Patient::findOrFail($id);

        return $patient->delete();
    }
}
