<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => 7,
            'message' => 'Message1',
            'title' => 'Title1',
            'access_id' => 1,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('posts')->insert([
            'user_id' => 8,
            'message' => 'Message2',
            'title' => 'Title2',
            'access_id' => 2,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('posts')->insert([
            'user_id' => 10,
            'message' => 'Message3',
            'title' => 'Title3',
            'access_id' => 3,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('posts')->insert([
            'user_id' => 10,
            'message' => 'Message4',
            'title' => 'Title4',
            'access_id' => 2,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('posts')->insert([
            'user_id' => 7,
            'message' => 'Message5',
            'title' => 'Title5',
            'access_id' => 2,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
