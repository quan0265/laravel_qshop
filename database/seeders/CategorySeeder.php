<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            [
                'id' => 1,
            	'name' => 'laptop',
	            'slug' => 'laptop',
	            'status' => 1,
            ],
            [
                'id' =>2,
            	'name' => 'mobile',
	            'slug' => 'mobile',
	            'status' => 1,
            ],
        ]);
    }
}