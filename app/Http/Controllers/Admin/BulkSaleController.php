<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BulkSaleRequest; // Assuming you create a specific request for bulk sales
use App\Services\BulkSaleService;
use Illuminate\Http\Request;

class BulkSaleController extends Controller
{
    protected $bulkSaleService;

    public function __construct(BulkSaleService $bulkSaleService)
    {
        $this->bulkSaleService = $bulkSaleService;
    }

    public function createBulkSale()
    {
        $brands = $this->bulkSaleService->getAllBrands();
        return view('admin.bulk-sale', compact('brands'));
    }

    public function storeBulkSale(Request $request)
    {
        $products = $this->bulkSaleService->getProductsByBrandAndCategory($request->brand_id, 'Elise Robel');

        try {
            $this->bulkSaleService->createBulkSale($products, $request->all());
            return redirect()->route('sales.index')->with('success', 'Products successfully added to sale.');
        } catch (\Exception $e) {
            return back()->withError('An error occurred: ' . $e->getMessage());
        }
    }

    public function showProductsForBulkSale(Request $request)
    {
        $brands = $this->bulkSaleService->getAllBrands();
        $selectedBrand = $request->brand;
        $products = $this->bulkSaleService->getProductsByBrandAndCategory($selectedBrand, 'Hair Color');

        return view('admin.bulk-sale', compact('brands', 'products', 'selectedBrand'));
    }
}

