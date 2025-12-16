<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Factory;
use App\Models\Product;
use App\Models\Pharmacy;
use Maatwebsite\Excel\Row;
use App\Models\Transaction;
use App\Models\Representative;
use App\Models\AreaRepresentative;
use App\Models\TreeProduct;
use Illuminate\Validation\Rules\In;
use Maatwebsite\Excel\Concerns\OnEachRow;

class TreeProductsImport implements OnEachRow
{
    protected $warehouseId;


    public function __construct($warehouseId)
    {
        $this->warehouseId = $warehouseId;
    }

    public function onRow(Row $row)
    {

        $r = $row->toArray();  // مصفوفة عادية مثل [0 => ..., 1 => ...]

        // تخطي الصف الأول (العناوين)
        if ($row->getIndex() === 1) {
            return;
        }

        // خريطة الأعمدة حسب ملفك
        $name     = $r[0];
        $type      = $r[1];




        Product::firstOrCreate([
            'name' => $name,
            'type' => $type,
            'warehouse_id' => $this->warehouseId

        ]);
    }
}
