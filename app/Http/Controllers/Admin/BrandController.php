<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Services\BrandService;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        $brands = $this->brandService->getAllBrands();
        return view('admin.brand')->with('brands', $brands);
    }

    public function store(BrandRequest $request)
    {
        $this->brandService->createBrand($request->validated());
        return redirect()->route('brands.index')->with('success', 'Brand created successfully');
    }

    public function edit(Brand $brand)
    {
        return view('admin.edit-brand', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $this->brandService->updateBrand($brand, $request->validated());
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully');
    }

    public function destroy(Brand $brand)
    {
        $this->brandService->deleteBrand($brand);
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully');
    }
}

