<?php

namespace App\Http\Controllers;

use App\Models\DoctorVisit;
use Illuminate\Http\Request;
use App\Services\DoctorVisitService;

class DoctorVisitController extends Controller
{
    protected $doctorVisitService;

    public function __construct(DoctorVisitService $doctorVisitService)
    {
        $this->doctorVisitService = $doctorVisitService;
    }

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
        $data = $this->doctorVisitService->getToCreate();

        $doctorVisit = new DoctorVisit();


        return view('pages.doctorVisits.partials.craete', compact('data', 'doctorVisit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorVisit $doctorVisit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorVisit $doctorVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorVisit $doctorVisit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorVisit $doctorVisit)
    {
        //
    }
}
