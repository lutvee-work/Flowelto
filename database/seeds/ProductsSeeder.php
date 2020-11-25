<?php

use Illuminate\Database\Seeder;
use App\Flowers;
use App\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert([
            [
                'name' => "Gift",
                'image' => '87364.jpg'
            ],
            [
                'name' => 'Wedding',
                'image' => 'flower.png'
            ]
        ]);

        DB::table('flowers')->insert([
            [
                'name' => 'Gift Flower',
                'product_id' => 1,
                'image' => 'flower2.png',
                'price' => 100000,
                'description' => 'loremipsum'
            ],
            [
                'name' => 'Wedding Flower',
                'product_id' => 2,
                'image' => 'flower.png',
                'price' => 200000,
                'description' => 'loremipsumssss'
            ]
        ]);        
        
    }
}
