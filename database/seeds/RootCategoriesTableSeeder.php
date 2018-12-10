<?php

use Illuminate\Database\Seeder;
use App\Category;
use Faker\Factory;

class RootCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create();

        $root = Category::create(['name' => $fake->word]);
    }
}
