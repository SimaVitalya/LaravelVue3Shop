<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 20; $i++) {
            DB::table('products')->insert([
                'name' => 'Product ' . $i,
                'price' => rand(200, 1500),
                'category_id' => 1,
                'description' => 'Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum',
                'image' => 'product_'.$i.'.jpg',
            ]);
        }
    }
}
