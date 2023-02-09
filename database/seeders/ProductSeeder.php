<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Property;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->count(10)
            ->hasAttached(
                Property::factory()->count(3),
                [
                    'position' => fake()->unique()->randomNumber(1)
                ]
            )
            ->create();
    }
}
