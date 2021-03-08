<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('sliders')->insert([
            [
            	'name' => 'slider1',
	            'image' => '04-03-46-05-03-2021.jpg',
	            'status' => 1,
            ],
            [
            	'name' => 'slider2',
	            'image' => '04-03-26-05-03-2021.jpg',
	            'status' => 1,
            ],
            [
            	'name' => 'slider3',
	            'image' => '04-03-44-05-03-2021.jpg',
	            'status' => 1,
            ],
            [
            	'name' => 'slider4',
	            'image' => '04-03-06-05-03-2021.jpg',
	            'status' => 1,
            ],
        ]);



        
    }
}
