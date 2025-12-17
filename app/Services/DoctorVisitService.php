<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\Product;
use App\Models\DoctorVisit;
use App\Models\VisitPeriod;
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

    public function create(array $data, VisitPeriod $period)
    {
        DB::beginTransaction();
        $user = auth()->user();

        $visitsCount = DoctorVisit::where('representative_id', $user->id)
            ->where('doctor_id', $data['doctor_id'])
            ->where('visit_period_id', $period->id)
            ->count();

        if ($visitsCount >= $period->max_visits) {
            throw new \Exception(__('The maximum number of visits allowed for this month has been reached.'));
        }

        if (isset($data['attachment'])) {
            $imagePath = $data['attachment']
                ->store('doctor_visits', 'public');
        } else {
            $imagePath = null;
        }

        $doctorVisit = DoctorVisit::create([
            'doctor_id' => $data['doctor_id'],
            'visit_period_id' => $period->id,
            'visit_date' => $data['visit_date'],
            'representative_id' => $user->id,
            'notes' => $data['note'] ?? null,
            'image' => $imagePath,
        ]);

        foreach ($data['product_id'] as $index => $productId) {
            $doctorVisit->samples()->create([
                'product_id' => $productId,
                'quantity' => $data['quantity'][$index],
            ]);

            RepresentativeStore::where('representative_id', $user->id)
                ->where('product_id', $productId)
                ->decrement('quantity', $data['quantity'][$index]);
        }


        DB::commit();
    }


    public function getAll(Request $request)
    {
        $user = Auth::user();
        $query = DoctorVisit::query();
        $query->with(['doctor', 'period']);

        if ($user->hasRole('super-admin')) {
            return $query->paginate(20);
        }
        return $query->where('representative_id', $user->id)->orWhere('visit_period_id', $user->id)->paginate(20);
    }
}
