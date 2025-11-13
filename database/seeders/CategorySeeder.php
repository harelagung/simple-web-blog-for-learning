<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Web Design",
            "slug" => "web-design",
            "color" => "bg-orange-200",
        ]);

        Category::create([
            "name" => "Programming",
            "slug" => "programming",
            "color" => "bg-green-200",
        ]);

        Category::create([
            "name" => "Artificial Intelligence",
            "slug" => "ai",
            "color" => "bg-blue-200",
        ]);
    }
}
