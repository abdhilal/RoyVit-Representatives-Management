<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Services\AreaService;
use App\Services\CityService;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;

class AreaController extends Controller
{
    protected $areaService;
    protected $cityService;

    public function __construct(AreaService $areaService, CityService $cityService)
    {
        $this->areaService = $areaService;
        $this->cityService = $cityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = $this->areaService->getAllAreas();
        return view('pages.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = $this->cityService->getAllCities();
        $area = new Area();
        return view('pages.areas.partials.form', compact('cities', 'area'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
    {
        $this->areaService->createArea($request->validated());
        return redirect()->route('areas.index')->with('success', __('area created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        $cities = $this->cityService->getAllCities();
        return view('pages.areas.partials.form', compact('cities', 'area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        $this->areaService->updateArea($area, $request->validated());
        return redirect()->route('areas.index')->with('success', __('area updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $this->areaService->deleteArea($area);
        return redirect()->route('areas.index')->with('success', __('area deleted successfully'));
    }
}
