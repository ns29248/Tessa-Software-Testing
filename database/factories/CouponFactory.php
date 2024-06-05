<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'type' => $this->faker->randomElement(['fixed', 'percentage']),
            'value' => $this->faker->numberBetween(5, 50),
            'quantity' => $this->faker->numberBetween(1, 100),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
