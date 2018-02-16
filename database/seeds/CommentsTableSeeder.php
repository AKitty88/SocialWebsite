<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            'user_id' => 7,
            'comment' => 'Comment1',
            'post_id' => 1,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('comments')->insert([
            'user_id' => 7,
            'comment' => 'Comment2',
            'post_id' => 1,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('comments')->insert([
            'user_id' => 8,
            'comment' => 'Comment3',
            'post_id' => 3,
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
