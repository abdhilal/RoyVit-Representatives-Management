<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Doctor;
use App\Enums\GanderDoctor;
use App\Models\Classification;
use App\Models\Specialization;

class DoctorService
{

    public function getAllDoctors()
    {
        if (auth()->user()->hasRole('super-admin')) {
            return Doctor::paginate(10);
        }

        if (auth()->user()->hasRole('representatives')) {
            return Doctor::where('user_id', auth()->user()->id)->paginate(10);
        }
        return Doctor::where('warehouse_id', auth()->user()->id)->paginate(10);
    }

    public function getDataCrateDoctors()
    {
        $areas =Area::all();
        $specializations = Specialization::where('warehouse_id', auth()->user()->warehouse_id)->get();
        $classifications = Classification::where('warehouse_id', auth()->user()->warehouse_id)->get();
        $ganders = GanderDoctor::cases();
        return compact('areas', 'specializations', 'classifications', 'ganders');
    }



    public function createDoctor(array $data)
    {
        $data['warehouse_id'] = auth()->user()->warehouse_id;
        $data['representative_id'] = auth()->user()->id;
        return Doctor::create($data);
    }

    public function getDoctorWithRelations(Doctor $doctor): Doctor
    {
        return $doctor->load([
            'area',
            'warehouse',
            'classification',
            'specialization',
            'representative',
        ]);
    }

    public function updateDoctor(Doctor $doctor, array $data)
    {
        $doctor->update($data);
    }

    public function deleteDoctor(Doctor $doctor)
    {
        $doctor->delete();
    }
}
