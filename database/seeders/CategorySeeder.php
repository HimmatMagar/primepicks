<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = File::get(path:'database/json/category.json');
        $json = collect(json_decode($path));
        $json -> each(function($json) {
            Category::create([
                'id' => $json -> id,
                'category' => $json -> category
            ]);
        });
    }
}
