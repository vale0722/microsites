<?php

namespace Database\Seeders;

use App\Constants\CategoryName;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = array_map(function (string $name) {
            return ['name' => $name, 'created_at' => now()];
        }, CategoryName::toArray());

        Category::insert($categories);
    }
}
