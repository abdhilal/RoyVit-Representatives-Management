<?php

namespace App\Services;

use App\Models\VisitPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VisitPeriodService
{

    function currentVisitPeriod()
    {
        $month = now()->format('Y-m');

        return VisitPeriod::firstOrCreate(
            ['month' => $month],
            [
                'max_visits' => 5,
                'warehouse_id' => Auth::user()->warehouse_id
            ]
        );
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
