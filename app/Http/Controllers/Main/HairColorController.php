<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller; // Correct the namespace

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class HairColorController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function showHairColors($brandName)
    {
        return view('main.hair-color.index', [
            'products' => $this->productService->showHairColors($brandName)
        ]);
    }
}
