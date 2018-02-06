<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i = 1; $i <= 3; $i++)
    	{
    		DB::table('users')->insert(
    			[
    				'name' => 'User_'.$i,
    				'about' => 'Hi, I am User_'.$i,
    				'image' => 'default.jpg',
    				'email' => 'user_'.$i.'@gmail.com',
    				'password' => bcrypt('123456'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
    			]
    		);
    	}
    }
}
