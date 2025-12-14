<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CityService
{
    public function getAllCities()
    {
        if(Auth::user()->hasRole('super-admin')){
            return City::paginate(10);
        }
        return City::where('warehouse_id', Auth::user()->warehouse_id)->paginate(10);
    }

    public function createCity(array $data)
    {
        DB::table('cities')->insert([
            'name' => $data['name'],
            'warehouse_id' => Auth::user()->warehouse_id,
        ]);
    }

    public function updateCity(City $city, array $data)
    {
        $city->update([
            'name' => $data['name'],
        ]);
    }

    public function deleteCity(City $city)
    {
        $city->delete();
    }
}
