<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Services\ClassificationService;
use App\Http\Requests\StoreClassificationRequest;
use App\Http\Requests\UpdateClassificationRequest;

class ClassificationController extends Controller
{
    protected $classificationService;
    public function __construct(ClassificationService $classificationService)
    {
        $this->classificationService = $classificationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classifications = $this->classificationService->getAllClassifications();
        return view('pages.classifications.index', compact('classifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classification = new Classification();
        return view('pages.classifications.partials.form', compact('classification'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassificationRequest $request)
    {
        $this->classificationService->createClassification($request->validated());
        return redirect()->route('classifications.index')->with('success', __('Classification created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Classification $classification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classification $classification)
    {
        return view('pages.classifications.partials.form', compact('classification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassificationRequest $request, Classification $classification)
    {
        $this->classificationService->updateClassification($classification, $request->validated());
        return redirect()->route('classifications.index')->with('success', __('Classification updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classification $classification)
    {
        $this->classificationService->deleteClassification($classification);
        return redirect()->route('classifications.index')->with('success', __('Classification deleted successfully'));
    }
}
