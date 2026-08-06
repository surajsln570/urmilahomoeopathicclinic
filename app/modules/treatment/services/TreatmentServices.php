<?php

namespace App\modules\treatment\services;

use App\modules\treatment\models\TreatmentModel;
use App\modules\treatment\requests\TreatmentRequest;

class TreatmentServices
{
    public function create(TreatmentRequest $request)
    {
        $data = $request->validated();
        $file = $request->file('image');
        $filepath = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload/treatments'), $filepath);


        return TreatmentModel::create([
            'image' => 'upload/treatments/' . $filepath,
            'disease' => $data['disease'],
            'description' => $data['description'],
            'symptoms' => $data['symptoms']
        ]);
    }
    public function get()
    {
        return TreatmentModel::latest()->get();
    }
    public function delete(int $id): bool
    {
        $treatment = TreatmentModel::findOrFail($id);
        if ($treatment->image) {
            $imagePath = public_path($treatment->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        return $treatment->delete();
    }
    public function edited(int $id, TreatmentRequest $request)
    {
        $data = $request->validated();

        $treatment = TreatmentModel::findOrFail($id);

        // If a new image is uploaded
        if ($request->hasFile('image')) {

            // Delete old image
            if ($treatment->image && file_exists(public_path($treatment->image))) {
                unlink(public_path($treatment->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('upload/treatments'),
                $filename
            );

            $treatment->image = 'upload/treatments/' . $filename;
        }

        $treatment->disease = $data['disease'];
        $treatment->description = $data['description'];
        $treatment->symptoms = $data['symptoms']; // Change to symptom if that's your column name

        $treatment->save();

        return $treatment;
    }
}
