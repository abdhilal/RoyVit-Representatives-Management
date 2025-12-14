<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Services\FileServer;
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
        $this->fileServer->upload(
            $request->validated()
        );

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
        //
    }

    public function download(File $file)
    {
        // Authorization (اختياري لكنه مهم)
        // $this->authorize('view', $file);

        if (!Storage::disk('public')->exists($file->path)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $extension = pathinfo($file->path, PATHINFO_EXTENSION);
        $safeName = str($file->name)->slug('_');

        return Storage::disk('public')->download(
            $file->path,
            "{$safeName}.{$extension}"
        );
    }
}
