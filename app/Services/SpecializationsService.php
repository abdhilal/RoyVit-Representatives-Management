<?php

namespace App\Services;

use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;

class SpecializationsService
{
    public function getAllSpecializations()
    {
        if (Auth::user()->hasRole('super-admin')) {
            return Specialization::paginate(10);
        }
        return Specialization::where('warehouse_id', Auth::user()->warehouse_id)->paginate(10);
    }

    public function createSpecialization(array $data)
    {
        $data['warehouse_id'] = Auth::user()->warehouse_id;
        Specialization::create($data);
    }
    public function updateSpecialization(Specialization $specialization, array $data)
    {
        $specialization->update($data);
    }

    public function deleteSpecialization(Specialization $specialization)
    {
        $specialization->delete();
    }
}
