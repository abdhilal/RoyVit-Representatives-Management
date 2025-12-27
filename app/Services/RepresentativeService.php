<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Representative;
use Illuminate\Support\Facades\DB;

class RepresentativeService
{
    protected $visitPeriodService;

    public function __construct(VisitPeriodService $visitPeriodService)
    {
        $this->visitPeriodService = $visitPeriodService;
    }

    public function getAll(Request $request)
    {
        $search = $request->input('search');

        $user = auth()->user();
        $representatives = User::where('warehouse_id', $user->warehouse_id)->has('doctors')
            ->withCount('doctors')
            ->withCount([
                'doctors as specializations_count' => function ($query) {
                    $query->select(DB::raw('COUNT(DISTINCT specialization_id)'));
                }
            ])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(15);
        return $representatives;
    }

    public function getRepresentative(User $representative)
    {
        $period = $this->visitPeriodService->currentVisitPeriod();

        $representative->loadCount('doctors')->loadCount('DoctorVisits as total_visits_count')
            ->loadCount([
                'DoctorVisits as visited_doctors_count' => function ($query) use ($representative, $period) {
                    $query->where('visit_period_id', $period->id);
                }
            ])
            ->loadCount([
                'doctors as specializations_count' => function ($query) {
                    $query->select(DB::raw('COUNT(DISTINCT specialization_id)'));
                }
            ]);

        $specializations = $representative->doctors()
            ->join('specializations', 'doctors.specialization_id', '=', 'specializations.id')
            ->select(
                'specializations.id',
                'specializations.name',
                DB::raw('COUNT(doctors.id) as doctors_count')
            )
            ->groupBy('specializations.id', 'specializations.name')
            ->get();

        return [
            'representative' => $representative,
            'specializations' => $specializations
        ];
    }
}
