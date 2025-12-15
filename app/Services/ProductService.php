<?php

namespace App\Services;

use App\Models\product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function getAllProducts($type = null)
    {
        if($type){
            return Product::where('type', $type)->where('warehouse_id', Auth::user()->warehouse_id)->paginate(20);
        }
        return Product::where('warehouse_id', Auth::user()->warehouse_id)->paginate(20);
    }

    public function create($data)
    {
        return Product::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'warehouse_id' => Auth::user()->warehouse_id,
        ]);
    }

    public function update($request, Product $product)
    {
        $product->update($request->validated());
        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();
        return $product;
    }
}
