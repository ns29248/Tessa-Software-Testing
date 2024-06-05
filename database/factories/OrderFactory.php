<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'total' => $this->faker->randomFloat(2, 10, 500),
            'created_at' => now(),
            'updated_at' => now(),
            'coupon_id' => $this->faker->boolean(50) ? Coupon::factory() : null, // Use conditional logic for nullable field
            'status' => $this->faker->numberBetween(0, 3), // Example status values as integers

        ];
    }
}
