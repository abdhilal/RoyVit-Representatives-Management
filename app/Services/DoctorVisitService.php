<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RepresentativeStore;
use Illuminate\Support\Facades\Auth;

class DoctorVisitService
{


    public function getToCreate()
    {
        $doctors = Doctor::where('representative_id', Auth::id())->get();
        $RepresentativeStores = RepresentativeStore::with(['product'])->where('representative_id', Auth::id())->get();
        return ['doctors' => $doctors, 'RepresentativeStores' => $RepresentativeStores];
    }
}
