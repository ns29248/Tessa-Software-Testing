<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller; // Correct the namespace


use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Models\Brand;

class MainController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function showProducts(Request $request)
    {
            return view('main.home.index',
                ['products'=>$this->productService->latestProducts()],
                ['popularProducts' => $this->productService->getProducts()->inRandomOrder()->paginate(3)]
            );
    }

    public function shop()
    {
        return view('main.shop.shop');
    }





    public function show(Product $product)
    {

        return view('main.show-product', [
                'product'=>$product,
                'relatedProducts'=> $this->productService->show($product)
            ]);
    }

}
