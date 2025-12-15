<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Factory;
use App\Models\Product;
use App\Models\Pharmacy;
use Maatwebsite\Excel\Row;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\Classification;
use App\Models\Representative;
use App\Models\AreaRepresentative;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class FilesImport implements ToCollection
{
    protected $warehouseId;

    public function __construct($warehouseId)
    {
        $this->warehouseId = $warehouseId;
    }

    public function collection(Collection $rows)
    {
        // تخطي العناوين
        $rows->shift();

        // كاش داخلي
        $areas = Area::pluck('id', 'name')->toArray();

        $specializations = Specialization::where('warehouse_id', $this->warehouseId)
            ->pluck('id', 'name')->toArray();

        $classifications = Classification::where('warehouse_id', $this->warehouseId)
            ->pluck('id', 'name')->toArray();

        $users = User::pluck('id', 'email')->toArray();


        foreach ($rows as $r) {

            $areaId = $areas[$r[4]] ??= Area::create([
                'name' => $r[4],
            ])->id;

            $specId = $specializations[$r[3]] ??= Specialization::create([
                'name' => $r[3],
                'warehouse_id' => $this->warehouseId,
            ])->id;

            $classId = $classifications[$r[6]] ??= Classification::firstOrCreate([
                'name' => $r[6],
                'warehouse_id' => $this->warehouseId,
            ])->id;

            $email = Str::of($r[7])
                ->lower()
                ->replaceMatches('/[^a-z0-9]+/i', '')
                ->append('@royvit.com')
                ->toString();

            $userId = $users[$email] ??= User::create([
                'name' => $r[7],
                'email' => $email,
                'warehouse_id' => $this->warehouseId,
                'password' => bcrypt('12345678'),
            ])->id;

            Doctor::firstOrCreate(
                [
                    'address' => $r[5],
                    'name' => $r[1],
                    'specialization_id' => $specId,

                    'area_id' => $areaId,
                    'representative_id' => $userId,
                    'warehouse_id' => $this->warehouseId,
                    'gender' => $r[2] == 'ذكر' ? 'male' : 'female',
                    'classification_id' => $classId,
                ]
            );
        }
    }
}
