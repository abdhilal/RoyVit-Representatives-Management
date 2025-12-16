<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Enums\GanderDoctor;
use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Services\DoctorService;
use App\Services\ClassificationService;
use App\Services\SpecializationsService;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    protected $doctorService;


    public function __construct(
        DoctorService $doctorService,


    ) {
        $this->doctorService = $doctorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = $this->doctorService->getAllDoctors($request);
        return view('pages.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctor = new Doctor();

        return view('pages.doctors.partials.form',array_merge(['doctor' => $doctor], $this->doctorService->getDataCrateDoctors() ) );
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
        $doctor = $this->doctorService->getDoctorWithRelations($doctor);
        $ganders = GanderDoctor::cases();
        return view('pages.doctors.partials.form',array_merge(['doctor' => $doctor], $this->doctorService->getDataCrateDoctors() ) );
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
