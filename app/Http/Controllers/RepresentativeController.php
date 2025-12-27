<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Representative;
use App\Services\RepresentativeService;
use App\Http\Requests\StoreRepresentativeRequest;
use App\Http\Requests\UpdateRepresentativeRequest;

class RepresentativeController extends Controller
{
    protected $RepresentativeService;

    public function __construct(RepresentativeService $RepresentativeService)
    {
        $this->RepresentativeService = $RepresentativeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $representatives = $this->RepresentativeService->getAll($request);
        return view('pages.representatives.index', compact('representatives'));
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
    public function store(StoreRepresentativeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $representative)
    {
        $representatives = $this->RepresentativeService->getRepresentative($representative);
        return view('pages.representatives.partials.show', $representatives);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Representative $representative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepresentativeRequest $request, Representative $representative)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Representative $representative)
    {
        //
    }
}
