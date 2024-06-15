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
        $data = $this->productService->getAllBrandsAndCategories();
        $products = $this->productService->getProducts()->get();

        return view('admin.product', [
            'brands' => $data['brands'],
            'categories' => $data['categories'],
            'products' => $products
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
            'categories' => $this->productService->getAllBrandsAndCategories()['categories'],
            'product' => $product
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
        return redirect()->route('products.index')->with('message', 'Product Deleted Successfully');
    }
}

