<?php

use Illuminate\Database\Seeder;

class BMITable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bmi')->truncate();
        DB::table('bmi')->insert([
            ['detail' => 'Obesity superlatives.'],
            ['detail' => 'Obesity level 2. Your risk of diseases that accompany obesity. If you have a waist circumference greater than normal, you run the risk of disease is high. You must control diet And serious exercise.'],
            ['detail' => ' obesity levels. If you have a waist circumference greater than 90 cm(men), 80 cm (women) you will have a chance to disease, diabetes, high blood pressure need to diet, And exercise.'],
            ['detail' => 'If you are overweight Dental Federation as diabetes, high cholesterol ortrying to lose weight, a body mass index lower than 23.'],
            ['detail' => 'Normal weight and fat content were normal. Usually do not have the disease The incidence of diabetes High blood pressure than obese people than this.'],
            ['detail' => 'Too little weight. This may be due to the athletes who exercise a lot. Moreover, inadequate nutrition. Solutions need to eat quality food. And a sufficient amount of energy And exercise properly.'],
        ]);
    }
}
