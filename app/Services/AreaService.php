<?php

namespace App\Services;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AreaService
{
    public function getAllAreas(Request $request)
    {
        $query = Area::query();
        if (Auth::user()->hasRole('super-admin')) {
            $query->with('city');
        }


        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        return $query->withCount('doctors')->orderBy('name')->paginate(20);
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
