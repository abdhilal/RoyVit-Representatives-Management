<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Services\CityService;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller
{

    protected $cityService;
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }
    public function index()
    {
        $cities = $this->cityService->getAllCities();
        return view('pages.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $city = new City();
        return view('pages.cities.partials.form', compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        $this->cityService->createCity($request->validated());
        return redirect()->route('cities.index')->with('success', __('city created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return view('pages.cities.partials.form', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $this->cityService->updateCity($city, $request->validated());
        return redirect()->route('cities.index')->with('success', __('city updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $this->cityService->deleteCity($city);
        return redirect()->route('cities.index')->with('success', __('city deleted successfully'));
    }
}
