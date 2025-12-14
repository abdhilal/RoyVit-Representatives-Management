<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use App\Services\SpecializationsService;
use App\Http\Requests\StoreSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;

class SpecializationController extends Controller
{
    protected $specializationsService;

    public function __construct(SpecializationsService $specializationsService)
    {
        $this->specializationsService = $specializationsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specializations = $this->specializationsService->getAllSpecializations();
        return view('pages.specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialization=new Specialization();
        return view('pages.specializations.partials.form', compact('specialization'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecializationRequest $request)
    {
        $this->specializationsService->createSpecialization($request->validated());
        return redirect()->route('specializations.index')->with('success', __('Specialization created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialization $specialization)
    {
        return view('pages.specializations.show', compact('specialization'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialization $specialization)
    {
        return view('pages.specializations.partials.form', compact('specialization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecializationRequest $request, Specialization $specialization)
    {
        $this->specializationsService->updateSpecialization($specialization, $request->validated());
        return redirect()->route('specializations.index')->with('success', __('Specialization updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialization $specialization)
    {
        $this->specializationsService->deleteSpecialization($specialization);
        return redirect()->route('specializations.index')->with('success', __('Specialization deleted successfully'));
    }
}
