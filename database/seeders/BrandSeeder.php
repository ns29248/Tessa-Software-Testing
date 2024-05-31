<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandNames = ['Fanola', 'RrLine', 'Oro Therapy', 'No Yellow'];

        foreach ($brandNames as $brandName) {
            Brand::create([
                'name' => $brandName,
            ]);
        }
    }

}
