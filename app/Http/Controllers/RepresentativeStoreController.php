<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepresentativeStore;
use App\Services\RepresentativeStoreService;
use App\Http\Requests\StoreRepresentativeStoreRequest;
use App\Http\Requests\UpdateRepresentativeStoreRequest;

class RepresentativeStoreController extends Controller
{

    protected $RepresentativeStoreService;
    public function __construct(RepresentativeStoreService $RepresentativeStoreService)
    {
        $this->RepresentativeStoreService = $RepresentativeStoreService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $representativeStores = $this->RepresentativeStoreService->getAllRepresentativeStores($request);

        return view('pages.representativeStores.index', compact('representativeStores'));
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
    public function store(StoreRepresentativeStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {

        $representativeStores = $this->RepresentativeStoreService->getRepresentativeStores($request, $id);


        return view('pages.representativeStores.partials.show', compact('representativeStores', 'id'));
    }
    public function onlyshow(Request $request)
    {
        $id = auth()->user()->id;
        $representativeStores = $this->RepresentativeStoreService->getRepresentativeStores($request, $id);

        return view('pages.representativeStores.partials.show', compact('representativeStores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepresentativeStore $representativeStore)
    {
        return view('pages.representativeStores.partials.form', compact('representativeStore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepresentativeStoreRequest $request, RepresentativeStore $representativeStore)
    {
        $this->RepresentativeStoreService->updateRepresentativeStore($request->validated(), $representativeStore);

        return redirect()->back()->with('success', __('Representative Store updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepresentativeStore $representativeStore)
    {
        $this->RepresentativeStoreService->deleteRepresentativeStore($representativeStore);

        return redirect()->back()->with('success', __('Representative Store deleted successfully'));
    }
}
