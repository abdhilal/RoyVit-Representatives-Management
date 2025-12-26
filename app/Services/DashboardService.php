<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\Doctor;
use App\Models\DoctorVisit;
use App\Models\VisitPeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\RepresentativeStore;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardService

{
    protected $visitPeriodService;
    public function __construct(VisitPeriodService $visitPeriodService)
    {
        $this->visitPeriodService = $visitPeriodService;
    }
    public function getDashboardData()
    {


        $user = auth()->user();
        $Doctors = Doctor::where('representative_id', $user->id)->get();


        $doctorVisitsZero = 0;
        $doctorVisitsOne = 0;
        $doctorVisitsTwo = 0;
        $doctorVisitsThree = 0;
        $doctorVisitsFour = 0;
        $doctorVisitsFive = 0;

        foreach ($Doctors as $doctor) {
            if ($doctor->visits_count == 0) {
                $doctorVisitsZero++;
            }
            if ($doctor->visits_count == 1) {
                $doctorVisitsOne++;
            } elseif ($doctor->visits_count == 2) {
                $doctorVisitsTwo++;
            } elseif ($doctor->visits_count == 3) {
                $doctorVisitsThree++;
            } elseif ($doctor->visits_count >= 4) {
                $doctorVisitsFour++;
            }
            if ($doctor->visits_count >= 5) {
                $doctorVisitsFive++;
            }
        }
        $doctorVisitsAll = $doctorVisitsZero + $doctorVisitsOne + $doctorVisitsTwo + $doctorVisitsThree + $doctorVisitsFour + $doctorVisitsFive;
        $totalVisits = ($doctorVisitsAll - $doctorVisitsZero) ?? 0;
        return [
            'totalVisits' => $totalVisits,
            'doctorVisitsAll' => $doctorVisitsAll,
            'doctorVisitsZero' => $doctorVisitsZero,
            'doctorVisitsOne' => $doctorVisitsOne,
            'doctorVisitsTwo' => $doctorVisitsTwo,
            'doctorVisitsThree' => $doctorVisitsThree,
            'doctorVisitsFour' => $doctorVisitsFour,
            'doctorVisitsFive' => $doctorVisitsFive,
        ];
    }
}
