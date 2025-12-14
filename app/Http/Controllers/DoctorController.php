<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Enums\GanderDoctor;
use App\Services\AreaService;
use App\Services\DoctorService;
use App\Services\ClassificationService;
use App\Services\SpecializationsService;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    protected $doctorService;
    protected $areaService;
    protected $specializationsService;
    protected $classificationService;

    public function __construct(
        DoctorService $doctorService,
        AreaService $areaService,
        SpecializationsService $specializationsService,
        ClassificationService $classificationService

    ) {
        $this->doctorService = $doctorService;
        $this->areaService = $areaService;
        $this->specializationsService = $specializationsService;
        $this->classificationService = $classificationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = $this->doctorService->getAllDoctors();
        return view('pages.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctor = new Doctor();
        $areas = $this->areaService->getAllAreas();
        $specializations = $this->specializationsService->getAllSpecializations();
        $classifications = $this->classificationService->getAllClassifications();
        $ganders = GanderDoctor::cases();



        return view('pages.doctors.partials.form', compact('doctor', 'areas', 'specializations', 'classifications', 'ganders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        $this->doctorService->createDoctor($request->validated());
        return redirect()->route('doctors.index')->with('success', __('Doctor created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $doctor = $this->doctorService->getDoctorWithRelations($doctor);
        $genderLabel = null;
        if ($doctor->gender) {
            $genderLabel = GanderDoctor::fromString($doctor->gender)?->label() ?? $doctor->gender;
        }
        return view('pages.doctors.partials.show', compact('doctor', 'genderLabel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $areas = $this->areaService->getAllAreas();
        $specializations = $this->specializationsService->getAllSpecializations();
        $classifications = $this->classificationService->getAllClassifications();
        $ganders = GanderDoctor::cases();
        return view('pages.doctors.partials.form', compact('doctor', 'areas', 'specializations', 'classifications', 'ganders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $this->doctorService->updateDoctor($doctor, $request->validated());
        return redirect()->route('doctors.index')->with('success', __('Doctor updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $this->doctorService->deleteDoctor($doctor);
        return redirect()->route('doctors.index')->with('success', __('Doctor deleted successfully'));
    }
}
