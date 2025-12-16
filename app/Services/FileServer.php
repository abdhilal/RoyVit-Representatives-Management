<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FileServer
{

    public function upload(array $data): File
    {
        // DB::beginTransaction();

        $fileName = Str::uuid() . '.' . $data['file']->getClientOriginalExtension();

        $path = $data['file']->storeAs(
            'uploads/files',
            $fileName,
            'public'
        );

        return File::create([
            'name' => $data['name'],
            'warehouse_id' => auth()->user()->warehouse_id,
            'path' => $path,
        ]);
        // DB::commit();



    }
    public function getAllFiles()
    {
        return File::where('warehouse_id', auth()->user()->warehouse_id)->paginate(10);
    }

    public function download(File $file)
    {
        if (!Storage::disk('public')->exists($file->path)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $extension = pathinfo($file->path, PATHINFO_EXTENSION);
        $safeName = str($file->name)->slug('_');

        return Storage::disk('public')->download($file->path, "{$safeName}.{$extension}");
    }

    public function delete(File $file)
    {
        if (!Storage::disk('public')->exists($file->path)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        Storage::disk('public')->delete($file->path);
        $file->delete();
    }
}
