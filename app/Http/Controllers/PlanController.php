<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Services\PlanService;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;

class PlanController extends Controller
{
    protected $PlanService;
    public function __construct(PlanService $PlanService)
    {
        $this->PlanService = $PlanService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $plans = $this->PlanService->getAllPlans($request);

        return view('pages.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plan = new Plan();
        $data = $this->PlanService->getPlanCreateData();
        return view('pages.plans.partials.form', compact('plan', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request)
    {

        $plan = $this->PlanService->createPlan($request->validated());
        return redirect()->route('plans.index')->with('success', __('Plan created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        $plan->load(['visitPeriod', 'planItems.specialization', 'planItems.product']);
        return view('pages.plans.partials.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $this->PlanService->deletePlan($plan);
        return redirect()->route('plans.index')->with('success', __('Plan deleted successfully'));
    }
}
