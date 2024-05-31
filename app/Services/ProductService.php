<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use App\Models\ProductTranslation;
use App\Models\Sale;
use Intervention\Image\Facades\Image as Images;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductService
{
    public function getProducts()
    {
        return Product::with('translations');
    }

    public function getAllBrandsAndCategories()
    {
        return [
            'brands' => Brand::all(),
            'categories' => Category::all()
        ];
    }

    public function createProduct($data, $imageName)
    {
        DB::beginTransaction();
        try {
            $product = new Product($data);
            $product->save(); // Save the product to get an ID

            // Handle multilingual descriptions
            if (isset($data['description'])) {
                foreach ($data['description'] as $locale => $description) {
                    $translation = new ProductTranslation([
                        'locale' => $locale,
                        'description' => $description,
                    ]);
                    $product->translations()->save($translation);
                }
            }

            // Handle image saving
            if ($imageName) {
                $image = new Image();
                $image->name = $imageName; // Assume imageName is the .webp filename provided by middleware
                $product->image()->save($image);
            } else {
                throw new \Exception("No image provided");
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateProduct(Product $product, $data, $imageName)
    {
        DB::beginTransaction();
        try {
            // Update basic product details
            $product->update($data);

            // Update multilingual descriptions
            if (isset($data['description'])) {
                foreach ($data['description'] as $locale => $description) {
                    $translation = $product->translations()->where('locale', $locale)->firstOrCreate(['locale' => $locale]);
                    $translation->update(['description' => $description]);
                }
            }

            // Update or create new image
            if ($imageName) {
                $image = $product->image ?: new Image();
                $image->name = $imageName; // Assume imageName is the .webp filename provided by middleware
                $product->image()->save($image);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
    }

    public function show(Product $product)
    {
       return $this->getProducts()->with('image')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->paginate(3);
    }
    public function showHairColors($brandName)
    {
       return $this->getProducts()->whereHas('category', function ($query) {
            $query->where('name', 'Hair Color');
        })->whereHas('brand', function ($query) use ($brandName) {
            $query->where('name', $brandName);
        })->get();
    }

    public function latestProducts()
    {
        return $this->getProducts()->latest()->paginate(3);
    }

    public function getProductsOnSale()
    {
        return Sale::with('product')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();

    }
}

