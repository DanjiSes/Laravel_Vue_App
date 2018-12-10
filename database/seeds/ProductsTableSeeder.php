<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use Faker\Factory;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        $fake = Factory::create();

        $product = Product::create([
            'name' => $fake->word,
            'descript' => $fake->text,
            'image' => 'https://picsum.photos/300/300/?random',
            'category_id' => $categories->random()->id,
        ]);
    }
}
