<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RepresentativeStore;

class RepresentativeStoreService
{
    public function getRepresentativeStores(Request $request, $id = null)
    {
        $query = RepresentativeStore::where('representative_id', $id)->with('product');

        if ($request->filled('search')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('search') . '%');
            });
        }
        return $query->paginate(15);
    }

    public function getAllRepresentativeStores($request)
    {
        $query = User::where('warehouse_id', auth()->user()->warehouse_id);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        return $query->orderBy('name')->paginate(15);
    }

    public function updateRepresentativeStore(array $data, RepresentativeStore $representativeStore)
    {
        $representativeStore->update($data);
    }

    public function deleteRepresentativeStore(RepresentativeStore $representativeStore)
    {
        $representativeStore->delete();
    }
}
