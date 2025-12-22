<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Imports\FilesImport;
use App\Services\FileServer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateFileRequest;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    protected $fileServer;
    public function __construct(FileServer $fileServer)
    {
        $this->fileServer = $fileServer;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = $this->fileServer->getAllFiles();
        return view('pages.files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $file = new File();
        return view('pages.files.partials.create', compact('file'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        DB::beginTransaction();
        $data=$request->validated();

        $this->fileServer->upload($data  );


        Excel::import(new FilesImport(Auth::user()->warehouse_id), $data['file']);
        DB::commit();


        return redirect()
            ->route('files.index')
            ->with('success', __('File imported successfully.'));
    }


    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $this->fileServer->delete($file);
        return redirect()
            ->route('files.index')
            ->with('success', __('File deleted successfully.'));
    }

    public function download(File $file)
    {
        // Authorization (اختياري لكنه مهم)
        // $this->authorize('view', $file);

        return $this->fileServer->download($file);
    }
}
