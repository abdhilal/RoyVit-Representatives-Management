<?php

namespace App\Http\Controllers;

use App\Models\VisitPeriod;
use Illuminate\Http\Request;
use App\Services\VisitPeriodService;
use App\Http\Requests\UpdateVisitPeriodRequest;

class VisitPeriodController extends Controller
{
    protected $visitPeriodService;

    public function __construct(VisitPeriodService $visitPeriodService)
    {
        $this->visitPeriodService = $visitPeriodService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitPeriods = $this->visitPeriodService->getAll();
        return view('pages.monthlyPeriods.index', compact('visitPeriods'));
    }



    /**
     * Display the specified resource.
     */
    public function show(VisitPeriod $visitPeriod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitPeriod $visitPeriod)
    {
        return view('pages.monthlyPeriods.partials.form', compact('visitPeriod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisitPeriodRequest $request, VisitPeriod $visitPeriod)
    {
        $this->visitPeriodService->update($visitPeriod, $request->validated());
        return redirect()->route('visitPeriods.index')->with('success', __('Visit period updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */

}
