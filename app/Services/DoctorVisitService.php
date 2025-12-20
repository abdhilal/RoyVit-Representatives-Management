<?php

namespace App\Services;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\DoctorVisit;
use App\Models\VisitPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RepresentativeStore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DoctorVisitService
{

    public function getAllVisits(Request $request)
    {

        $user = Auth::user();
        $baseQuery = DoctorVisit::query();

        $representatives = collect();
        $doctors = collect();

        if ($user && $user->hasRole('super-admin')) {
            $baseQuery->where('warehouse_id', $user->warehouse_id);

            $representatives = User::whereHas('doctorVisits')->where('warehouse_id', $user->warehouse_id)->get();
            $doctors = Doctor::whereHas('doctorVisits')->where('warehouse_id', $user->warehouse_id)->get();
        }

        if ($user && $user->hasRole('representative')) {
            $baseQuery->where('representative_id', $user->id);

            $doctors = Doctor::whereHas('doctorVisits', function ($q) use ($user) {
                $q->where('representative_id', $user->id);
            })->get();
        }


        $stats = (clone $baseQuery)->selectRaw("
        COUNT(*) as totalVisits,
        SUM(CASE WHEN image IS NOT NULL THEN 1 ELSE 0 END) as totalVisitsIsHasImage,
        SUM(CASE WHEN image IS NULL THEN 1 ELSE 0 END) as totalVisitsIsNotHasImage
    ")->first();


        $totalVisitsIsMonth = (clone $baseQuery)->whereHas('period', function ($q) {
            $q->where('month', now()->format('Y-m'));
        })->count();


        $dataQuery = (clone $baseQuery)
            ->with(['period', 'doctor', 'representative'])
            ->withCount(['samples as total_samples']);

        if ($request->filled('month')) {
            $dataQuery->whereHas('period', function ($q) use ($request) {
                $q->where('month', $request->month);
            });
        }

        if ($request->filled('doctor_id')) {
            $dataQuery->where('doctor_id', $request->doctor_id);
        }

        if ($request->filled('representative_id')) {
            $dataQuery->where('representative_id', $request->representative_id);
        }



        $visits = $dataQuery->orderBy('visit_date', 'desc')->paginate(10);

        $months = VisitPeriod::where('warehouse_id', $user->warehouse_id)->get();





        return [
            'totalVisits' => $stats->totalVisits,
            'totalVisitsIsMonth' => $totalVisitsIsMonth,
            'totalVisitsIsHasImage' => $stats->totalVisitsIsHasImage,
            'totalVisitsIsNotHasImage' => $stats->totalVisitsIsNotHasImage,
            'visits' => $visits,
            'months' => $months,
            'representatives' => $representatives,
            'doctors' => $doctors,
        ];
    }


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
            $filename = Str::uuid() . '.' . $data['attachment']->getClientOriginalExtension();
            $destination = public_path('uploads/doctor_visits');
            File::ensureDirectoryExists($destination);
            $data['attachment']->move($destination, $filename);
            $imagePath = 'uploads/doctor_visits/' . $filename;
        } else {
            $imagePath = null;
        }

        $doctorVisit = DoctorVisit::create([
            'doctor_id' => $data['doctor_id'],
            'warehouse_id' => $user->warehouse_id,
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
}
