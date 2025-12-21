<?php

namespace App\Http\Controllers;

use App\Models\PlanItem;
use App\Http\Requests\StorePlanItemRequest;
use App\Http\Requests\UpdatePlanItemRequest;

class PlanItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanItem $planItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanItem $planItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanItemRequest $request, PlanItem $planItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanItem $planItem)
    {
        //
    }
}
