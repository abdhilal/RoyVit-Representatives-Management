<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Doctor;
use App\Enums\GanderDoctor;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Models\Specialization;

class DoctorService
{

    public function getAllDoctors(Request $request)
    {
        $query = Doctor::query();

        if (auth()->user()->hasRole('super-admin')) {

            $query->where('warehouse_id', auth()->user()->warehouse_id);
        }

        if (auth()->user()->hasRole('representative')) {

            $query->where('representative_id', auth()->user()->id);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('address', 'like', '%' . $request->input('search') . '%')
                ->paginate(10);
        }

        return $query->orderBy('name')->paginate(20);
    }

    public function getDataCrateDoctors()
    {
        $areas = Area::all();
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
