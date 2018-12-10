<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 3;  $i++) {
            $this->call(RootCategoriesTableSeeder::class);
        }

        for($i = 0; $i < 10;  $i++) {
            $this->call(CategoriesTableSeeder::class);
        }

        for($i = 0; $i < 20;  $i++) {
            $this->call(ProductsTableSeeder::class);
        }
    }
}
