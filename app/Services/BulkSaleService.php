<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Exception;

class BulkSaleService
{
    public function getAllBrands()
    {
        return Brand::all();
    }

    public function getProductsByBrandAndCategory($brandId, $categoryName)
    {
        return Product::whereHas('category', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        })
            ->whereHas('brand', function ($query) use ($brandId) {
                $query->where('id', $brandId);
            })
            ->get();
    }

    public function createBulkSale($products, $saleDetails)
    {
        $salesData = $products->map(function ($product) use ($saleDetails) {
            return [
                'product_id' => $product->id,
                'sale_price' => $saleDetails['sale_price'],
                'start_date' => $saleDetails['start_date'],
                'end_date' => $saleDetails['end_date'],
            ];
        })->toArray();

        DB::beginTransaction();
        try {
            Sale::upsert($salesData, ['product_id'], ['sale_price', 'start_date', 'end_date', 'updated_at']);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create bulk sale: ' . $e->getMessage());
            throw new Exception('Failed to create bulk sale. Please try again.');
        }
    }
}

