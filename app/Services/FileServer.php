<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FileServer
{

    public function upload(array $data): File
    {
        return DB::transaction(function () use ($data) {

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
        });
    }
    public function getAllFiles()
    {
        return File::where('warehouse_id', auth()->user()->warehouse_id)->paginate(10);
    }
}
