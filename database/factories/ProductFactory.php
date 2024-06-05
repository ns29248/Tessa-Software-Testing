<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'brand_id' => Brand::inRandomOrder()->first()->id ?? Brand::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'quantity' => $this->faker->numberBetween(1, 200),
            'price' => $this->faker->numberBetween(1000, 2000),
            'stylist_price' => $this->faker->numberBetween(100, 1000),
        ];
    }

    public function withDescription($description)
    {
        return $this->afterCreating(function (Product $product) use ($description) {
            $product->translations()->create(['description' => $description]);
        });
    }
}
