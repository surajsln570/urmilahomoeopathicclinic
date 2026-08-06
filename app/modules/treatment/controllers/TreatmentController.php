<?php

namespace App\modules\treatment\controllers;

use App\Http\Controllers\Controller;
use App\modules\treatment\requests\TreatmentRequest;
use App\modules\treatment\services\TreatmentServices;
use Inertia\Inertia;

class TreatmentController extends Controller
{
    //
    protected TreatmentServices $treatmentService;
    public function __construct(TreatmentServices $treatmentService)
    {
        $this->treatmentService = $treatmentService;
    }
    public function store(TreatmentRequest $treatmentRequest)
    {
        $this->treatmentService->create($treatmentRequest);
        return redirect()->route('dashtreatment.show');
    }
    public function show()
    {
        $treatments = $this->treatmentService->get();
        return Inertia::render('cms/Treatment', [
            'treatments' => $treatments,
        ]);
    }
    public function delete($id)
    {
        $this->treatmentService->delete($id);
        return redirect()->route('dashtreatment.show')->with('success', 'Treatment deleted successfully');
    }
    public function update($id, TreatmentRequest $request)
    {
        $this->treatmentService->edited($id, $request);

        return redirect()
            ->route('dashtreatment.show')
            ->with('success', 'Treatment updated successfully.');
    }
}
