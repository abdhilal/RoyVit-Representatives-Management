<?php

namespace App\Services;

use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;

class WarehouseService
{
    public function getAllWarehouses()
    {

        if (auth()->user()->hasRole('super-admin')) {
            return Warehouse::with('users')->paginate(10);
        }
        return Warehouse::with('users')->where('created_by', auth()->user()->id)->paginate(10);
    }

    public function createWarehouse(array $data)
    {
        return Warehouse::create([
            'name' => $data['name'],
            'location' => $data['location'],
            'created_by' => auth()->user()->id,
        ]);
    }

    public function updateWarehouse(Warehouse $warehouse, array $data)
    {
        $warehouse->update([
            'name' => $data['name'],
            'location' => $data['location'],
        ]);
    }
}
