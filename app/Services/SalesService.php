<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\Product;

class SalesService
{
    public function getAllSales()
    {
        return Sale::with('product')->get();
    }

    public function getSaleById($id)
    {
        return Sale::with('product')->findOrFail($id);
    }

    public function createSale($data)
    {
        return Sale::create($data);
    }

    public function updateSale(Sale $sale, $data)
    {
        $sale->update($data);
    }

    public function deleteSale(Sale $sale)
    {
        $sale->delete();
    }
}

