<?php

namespace App\Services;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function getAllProducts(Request $request, $type = null)
    {
        $query = Product::query();
        if ($type) {
            $query->where('type', $type);
        }
        if ($request->input("search")) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }
        return $query->where('warehouse_id', Auth::user()->warehouse_id)->paginate(20);
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
