<?php

use Illuminate\Database\Seeder;
use App\Category;
use Faker\Factory;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        if($categories->isEmpty()) return;

        $fake = Factory::create();

        $category = $categories->random();
        $category->children()->create(['name' => $fake->word]);
    }
}
