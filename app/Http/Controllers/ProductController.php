<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Enums\ProductsType;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $type = null)
    {
        $products = $this->productService->getAllProducts($request, $type);
        return view('pages.products.index', compact('products', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $productsTypes = ProductsType::toArray();
        return view('pages.products.partials.form', compact('product', 'productsTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return redirect()->route('products.type.index', $product->type)->with('success', __('Product created successfully'));
    }

    /**
     * Display the specified resource.
     */

    public function show(Product $product) {}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $productsTypes = ProductsType::toArray();
        return view('pages.products.partials.form', compact('product', 'productsTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productService->update($request, $product);
        return redirect()->route('products.type.index', $product->type)->with('success', __('Product updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productService->delete($product);
        return redirect()->route('products.type.index', $product->type)->with('success', __('Product deleted successfully'));
    }
}
