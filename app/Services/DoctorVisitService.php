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

        $doctorOptions = $doctors
            ->mapWithKeys(function ($d) {
                return [$d->id => ($d->name ?? '')];
            })
            ->toArray();

        $productOptions = $RepresentativeStores
            ->filter(function ($store) {
                return $store->product && $store->product->id;
            })
            ->sortBy(function ($store) {
                return $store->product->name ?? '';
            })
            ->mapWithKeys(function ($store) {
                $name = $store->product->name ?? '';
                $typeLabel = __($store->product->type ?? '');
                $quantity = $store->quantity ?? 0;
                return [
                    $store->product->id => "{$name} - {$typeLabel} - " . __('Quantity') . ": {$quantity}",
                ];
            })
            ->toArray();

        return [
            'doctorOptions' => $doctorOptions,
            'productOptions' => $productOptions,
        ];
    }
}
