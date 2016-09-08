<?php

use Illuminate\Database\Seeder;

class FoodTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foods')->truncate();
        DB::table('foods')->insert([
        	['name' => 'Somtum', 'kcal' => 300],
        	['name' => 'Chicken Wing', 'kcal' => 250],
        	['name' => 'Pork Steak', 'kcal' => 400],
        	['name' => 'Vegetable Salad', 'kcal' => 150],
        	['name' => 'Sweet Soda', 'kcal' => 450],
        ]);
    }
}
