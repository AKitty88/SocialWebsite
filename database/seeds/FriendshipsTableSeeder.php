<?php

use Illuminate\Database\Seeder;

class FriendshipsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('friendships')->insert([
            'id' => 1,
            'user_id_A' => 7,
            'user_id_B' => 8,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('friendships')->insert([
            'id' => 2,
            'user_id_A' => 8,
            'user_id_B' => 10,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('friendships')->insert([
            'id' => 3,
            'user_id_A' => 10,
            'user_id_B' => 7,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
