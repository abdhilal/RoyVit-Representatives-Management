<?php

namespace App\Services;

use App\Models\RepresentativeStore;
use App\Models\User;

class RepresentativeStoreService
{
    public function getRepresentativeStores($id=null)
    {
        if ($id) {

            return RepresentativeStore::where('representative_id', $id)->with('product')->paginate(15);
        }
        return RepresentativeStore::where('representative_id', auth()->user()->id)->with('product')->paginate(15);
    }

    public function getAllRepresentativeStores()
    {
        return User::where('warehouse_id', auth()->user()->warehouse_id)->paginate(15);
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
