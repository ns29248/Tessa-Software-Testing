<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Services\SalesService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    protected $salesService;

    public function __construct(SalesService $salesService)
    {
        $this->salesService = $salesService;
    }

    public function index()
    {
        $sales = $this->salesService->getAllSales();
        return view('admin.sale', compact('sales'));
    }

    public function create(Product $product)
    {
        return view('admin.create-sale', compact('product'));
    }

    public function store(SaleRequest $request)
    {
        $this->salesService->createSale($request->validated());
        return redirect()->route('sales.index')->with('success', 'Sale added successfully.');
    }

    public function show(Sale $sale)
    {
        $sale = $this->salesService->getSaleById($sale->id);
        return view('admin.sale.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        return view('admin.sale.edit', compact('sale'));
    }

    public function update(SaleRequest $request, Sale $sale)
    {
        $this->salesService->updateSale($sale, $request->validated());
        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $this->salesService->deleteSale($sale);
        return redirect()->route('sales.index')->with('success', 'Sale product deleted successfully.');
    }
}

