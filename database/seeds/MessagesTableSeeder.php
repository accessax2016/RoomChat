<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 50; $i++)
    	{
    		DB::table('messages')->insert(
    			[
    				'content' => 'Message_'.$i,
    				'user_id' => rand(1,3),
    				'room_id' => rand(1,3),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
    			]
    		);
    	}
    }
}
