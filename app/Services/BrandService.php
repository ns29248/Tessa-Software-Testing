<?php

namespace App\Services;

use App\Models\Brand;

class BrandService
{
    public function getAllBrands()
    {
        return Brand::all();
    }

    public function createBrand($data)
    {
        return Brand::create($data);
    }

    public function updateBrand(Brand $brand, $data)
    {
        $brand->update($data);
        return $brand;
    }

    public function deleteBrand(Brand $brand)
    {
        $brand->delete();
    }

    public function getBrandByName($brandName)
    {
        return Brand::where('name', $brandName)->value('id');
    }
}
