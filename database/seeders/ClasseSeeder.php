<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classe;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clasess=[
        
            [
                'id' => 4,
                'class_name' => 'ASTHANGA',
                'class_price' => 140000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',
            ],
            [
                'id' => 5,
                'class_name' => 'Body Combat',
                'class_price' => 150000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',

            ],
            [
                'id' => 6,
                'class_name' => 'ZUMBA',
                'class_price' => 160000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',

            ],
            [
                'id' => 7,
                'class_name' => 'HATHA',
                'class_price' => 170000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',

            ],
            [
                'id' => 8,
                'class_name' => 'Wall Swing',
                'class_price' => 180000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',

            ],
            [
                'id' => 9,
                'class_name' => 'Basic Swing',
                'class_price' => 130000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',

            ],
            [
                'id' => 10,
                'class_name' => 'Bellydance',
                'class_price' => 150000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',

            ],
            [
                'id' => 11,
                'class_name' => 'BUNGEE*',
                'class_price' => 110000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',
            ],
            [   
                'id' => 12,
                'class_name' => 'Yogalates',
                'class_price' => 120000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',
            ],
            [
                'id' => 13,
                'class_name' => 'BOXING',
                'class_price' => 140000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',
            ],
            [
                'id' => 14,
                'class_name' => 'Calisthenics ',
                'class_price' => 190000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',
            ],
            [
                'id' => 15,
                'class_name' => 'Pound Fit',
                'class_price' => 170000,
                'class_capacity' => 10,
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' =>'2021-04-01 00:00:00',

            ],
            [
                'id' => 16,
                'class_name' => 'Trampoline Workout',
                'class_price' => 120000,
                'class_capacity' => 10,
                'created_at' =>'2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',
            ],
            [
                'id' => 17,
                'class_name' => 'Yoga For Kids',
                'class_price' => 160000,
                'class_capacity' => 10,
                'created_at' =>'2021-04-01 00:00:00',
                'updated_at' => '2021-04-01 00:00:00',
            ],
            [
                'id' => 18,
                'class_name' => 'Abs Pilates',
                'class_price' => 130000,
                'class_capacity' => 10,
                'created_at' =>'2021-04-01 00:00:00',
            ],
            [
                'id' => 19,
                'class_name' => 'Swing For Kids',
                'class_price' => 120000,
                'class_capacity' => 10,
                'created_at' =>'2021-04-01 00:00:00',
            ],
   
        ];
        foreach ($clasess as $clas) {
            Classe::create($clas);
        }
    }
}
