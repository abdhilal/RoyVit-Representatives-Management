<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\VisitPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VisitPeriodService
{

    function currentVisitPeriod()
    {
        $month = now()->format('Y-m');
        $user = Auth::user();



        $period = VisitPeriod::where('month', $month)->first();


        if (!$period) {
            $period = VisitPeriod::create(
                [
                    'month' => $month,
                    'max_visits' => 5,
                    'warehouse_id' => $user->warehouse_id
                ]
            );
            Doctor::where('warehouse_id', $user->warehouse_id)->update(['visits_count' => 0]);
        }

        return $period;
    }

    function getAll()
    {
        return VisitPeriod::with('warehouse')->where('warehouse_id', Auth::user()->warehouse_id)->paginate(10);
    }

    function update(VisitPeriod $visitPeriod, array $data)
    {
        $visitPeriod->update($data);
    }
}
