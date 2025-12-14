<?php

namespace App\Services;

use App\Models\Classification;

class ClassificationService
{

    public function getAllClassifications()
    {

        if (auth()->user()->hasRole('super-admin')) {
            return Classification::paginate(10);
        }
        return Classification::where('warehouse_id', auth()->user()->warehouse_id)->paginate(10);
    }

    public function createClassification(array $data)
    {
        return Classification::create([
            'name' => $data['name'],
            'warehouse_id' => auth()->user()->warehouse_id,
        ]);
    }

    public function updateClassification(Classification $classification, array $data)
    {
        $classification->update([
            'name' => $data['name'],
        ]);
    }

    public function deleteClassification(Classification $classification)
    {
        $classification->delete();
    }
}
