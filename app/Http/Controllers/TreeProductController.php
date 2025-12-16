<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\TreeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\TreeProductsExport;
use App\Imports\TreeProductsImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\StoreTreeProductRequest;
use App\Http\Requests\UpdateTreeProductRequest;

class TreeProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */


    /**
     * Show the form for creating a new resource.
     */
    public function upload()
    {
        $file = new File();
        return view('pages.TreeProducts.partials.create', compact('file'));
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
    public function store(StoreFileRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();



        Excel::import(new TreeProductsImport(Auth::user()->warehouse_id), $data['file']);
        DB::commit();
        return redirect()->back()->with('success', __('Tree Products uploaded successfully'));
    }
}
