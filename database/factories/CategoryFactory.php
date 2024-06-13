<?php

namespace Database\Factories;

use App\Constants\CategoryName;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(CategoryName::toArray()),
        ];
    }
}
