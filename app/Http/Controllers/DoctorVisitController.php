<?php

namespace App\Http\Controllers;

use App\Models\DoctorVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\DoctorVisitService;
use App\Services\VisitPeriodService;
use App\Http\Requests\StoreDoctorVisitRequest;

class DoctorVisitController extends Controller
{
    protected $doctorVisitService;
    protected $visitPeriodService;

    public function __construct(DoctorVisitService $doctorVisitService, VisitPeriodService $visitPeriodService)
    {
        $this->doctorVisitService = $doctorVisitService;
        $this->visitPeriodService = $visitPeriodService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->doctorVisitService->getAllVisits($request);

        return view('pages.doctorVisits.index', compact('data'));
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
    public function store(StoreDoctorVisitRequest $request)
    {
        $period = $this->visitPeriodService->currentVisitPeriod();

        try {
            $this->doctorVisitService->create($request->validated(), $period);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('doctorVisits.index')->with('success', __('Doctor visit created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorVisit $doctorVisit)
    {
        $doctorVisit->load(['doctor', 'representative', 'period', 'samples.product']);
        $doctorMonthCount = DoctorVisit::where('doctor_id', $doctorVisit->doctor_id)
            ->where('visit_period_id', $doctorVisit->visit_period_id)
            ->count();
        return view('pages.doctorVisits.partials.show', compact('doctorVisit', 'doctorMonthCount'));
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
