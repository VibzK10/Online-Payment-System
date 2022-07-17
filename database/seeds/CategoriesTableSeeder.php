<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $categories = [
            "Drink and drive", "No license", "Expired insurance" , "No seatbelt/helmet" , "Over-speeding"
        ];

        foreach($categories as $category)
        {
            Category::create([
                'name'  => $category,
                'color' => $faker->hexcolor,
                'amount' => rand(1000,5000)
            ]);
        }
    }
}
