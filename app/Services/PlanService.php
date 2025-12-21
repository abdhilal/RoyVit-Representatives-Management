<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Product;
use App\Models\VisitPeriod;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\VisitPeriodService;



class PlanService
{
    protected $visitPeriodService;

    public function __construct(VisitPeriodService $visitPeriodService)
    {
        $this->visitPeriodService = $visitPeriodService;
    }

    public function getAllPlans(Request $request)
    {

        $query = Plan::query();
        $query->with(['visitPeriod']);

        return $query->where('warehouse_id', Auth::user()->warehouse_id)->paginate(20);
    }

    public function getPlanCreateData()
    {
        $products = Product::query()->where('warehouse_id', Auth::user()->warehouse_id)->get();
        $specializations = Specialization::query()->where('warehouse_id', Auth::user()->warehouse_id)->get();

        return compact('products', 'specializations');
    }

    public function createPlan(array $data)
    {

        $period = $this->visitPeriodService->currentVisitPeriod();

        $visit_period_id = VisitPeriod::query()->where('month', now()->format('Y-m'))->first()->id;

        $plan = Plan::create([
            'warehouse_id' => Auth::user()->warehouse_id,
            'name' => $data['name'],
            'visit_period_id' => $visit_period_id,
        ]);

        foreach ($data['specializations_id'] as $key => $specialization_id) {
            if (!isset($data['product_id'][$key])) {
                continue;
            }
            $plan->planItems()->create([
                'specialization_id' => $specialization_id,
                'product_id' => $data['product_id'][$key],
            ]);
        }
        return $plan;
    }

    public function deletePlan(Plan $plan)
    {
        $plan->planItems()->delete();
        $plan->delete();
    }
}
