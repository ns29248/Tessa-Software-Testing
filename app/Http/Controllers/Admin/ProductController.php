<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('admin.product', [
            'brands' => $this->productService->getAllBrandsAndCategories()['brands'],
            'categories' => $this->productService->getAllBrandsAndCategories()['categories'],
            'products' => $this->productService->getProducts()->get()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $this->productService->createProduct($request->validated(), $request->input('image'));
        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show(Product $product)
    {
        return view('admin.show-product', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.edit-product', [
            'brands' => $this->productService->getAllBrandsAndCategories()['brands'],
            'categories' => $this->productService->getAllBrandsAndCategories()['categories']
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->productService->updateProduct($product, $request->validated(), $request->input('image'));
        return redirect()->back()->with('message', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}

