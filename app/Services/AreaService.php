<?php

namespace App\Services;

use App\Models\Area;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AreaService
{
    public function getAllAreas()
    {
        if (Auth::user()->hasRole('super-admin')) {
            return Area::with('city')->withCount('doctors')->paginate(10);
        }
        return Area::with(['city', function ($query) {
            $query->where('warehouse_id', Auth::user()->warehouse_id);
        }])->withCount('doctors')->paginate(10);
    }

    public function createArea(array $data)
    {
        return Area::create($data);
    }

    public function updateArea(Area $area, array $data)
    {
        $area->update($data);
        return $area;
    }

    public function deleteArea(Area $area)
    {
        $area->delete();
    }
}
