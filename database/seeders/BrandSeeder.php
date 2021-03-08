<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brands')->insert([
            [
                'id' => 1,
                'category_id'=> 1,
            	'name' => 'dell',
	            'slug' => 'dell',
	            'status' => 1,
            ],
            [
                'id' => 2,
                'category_id'=> 1,
            	'name' => 'asus',
	            'slug' => 'asus',
	            'status' => 1,
            ],
            [
                'id' => 3,
                'category_id'=> 1,
            	'name' => 'hp',
	            'slug' => 'hp',
	            'status' => 1,
            ],
            [
                'id' => 4,
                'category_id'=> 1,
            	'name' => 'aser',
	            'slug' => 'aser',
	            'status' => 1,
            ],
            [
                'id' => 5,
                'category_id'=> 2,
            	'name' => 'iphone',
	            'slug' => 'iphone',
	            'status' => 1,
            ],
            [
                'id' => 6,
                'category_id'=> 2,
            	'name' => 'samsung',
	            'slug' => 'samsung',
	            'status' => 1,
            ],
            [
                'id' => 7,
                'category_id'=> 2,
            	'name' => 'oppo',
	            'slug' => 'oppo',
	            'status' => 1,
            ],
        ]);
    }
}
