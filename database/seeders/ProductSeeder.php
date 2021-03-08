<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
                'brand_id' => 1,
            	'name' => 'Laptop Dell Inspiron 3505 R3 3250U',
	            'slug' => 'laptop-dell-inspiron-3505-r3-3250u',
            	'image' => '06-03-40-05-03-2021.jpg',
            	'price' => 11990000,
            	'price_old' => 0,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],
            [
                'brand_id' => 1,
            	'name' => 'Dell Vostro 3400 i3 1115G4',
	            'slug' => 'dell-vostro-3400-i3-1115g4',
            	'image' => '07-03-31-05-03-2021.jpg',
            	'price' => 12490000,
            	'price_old' => 0,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],
            [
                'brand_id' => 1,
            	'name' => 'Dell Vostro 3500 i3 1115G4',
	            'slug' => 'dell-vostro-3500-i3-1115g4',
            	'image' => '07-03-48-05-03-2021.jpg',
            	'price' => 12690000,
            	'price_old' => 150000000,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],
            [
                'brand_id' => 1,
            	'name' => 'Dell Vostro 3500 i7 1165G7',
	            'slug' => 'dell-vostro-3500-i7-1165g7',
            	'image' => '07-03-15-05-03-2021.jpg',
            	'price' => 20990000,
            	'price_old' => 24000000,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],
            [
                'brand_id' => 1,
            	'name' => 'Dell Inspiron 5406 i5 1135G7',
	            'slug' => 'dell-inspiron-5406-i5-1135g7',
            	'image' => '07-03-58-05-03-2021.jpg',
            	'price' => 18990000,
            	'price_old' => 21000000,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],
            [
                'brand_id' => 5,
            	'name' => 'iPhone 7 Plus 128GB',
	            'slug' => 'iphone-7-plus-128gb',
            	'image' => '07-03-17-05-03-2021.jpg',
            	'price' => 11000000,
            	'price_old' => 0,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],
            [
                'brand_id' => 5,
            	'name' => 'iPhone 11',
	            'slug' => 'iphone-11',
            	'image' => '07-03-55-05-03-2021.jpg',
            	'price' => 16200000,
            	'price_old' => 17900000,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],
            [
                'brand_id' => 1,
            	'name' => 'Samsung Galaxy A11',
	            'slug' => 'samsung-galaxy-a11',
            	'image' => '07-03-59-05-03-2021.jpg',
            	'price' => 2800000,
            	'price_old' => 0,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],
            [
                'brand_id' => 1,
            	'name' => 'Samsung Galaxy A02s',
	            'slug' => 'samsung-galaxy-a02s',
            	'image' => '07-03-38-05-03-2021.jpg',
            	'price' => 3200000,
            	'price_old' => 0,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],
            [
                'brand_id' => 1,
            	'name' => 'Samsung Galaxy A12',
	            'slug' => 'samsung-galaxy-a12',
            	'image' => '07-03-43-05-03-2021.jpg',
            	'price' => 3700000,
            	'price_old' => 4290000,
            	'description' => 'sản phẩm tốt',
	            'status' => 1,
            ],

        ]);
    }
}
