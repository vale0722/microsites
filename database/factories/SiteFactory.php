<?php

namespace Database\Factories;

use App\Constants\DocumentTypes;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->company(),
            'document_type' => fake()->randomElement(array_column(DocumentTypes::cases(), 'name')),
            'document' => fake()->randomNumber(9),
        ];
    }
}
