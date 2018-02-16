<?php

use Illuminate\Database\Seeder;

class AccesslevelsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('accesslevels')->insert([
            'id' => 1,
            'accesslevel' => 'Only me',
        ]);
        
        DB::table('accesslevels')->insert([
            'id' => 2,
            'accesslevel' => 'My friends',
        ]);
        
        DB::table('accesslevels')->insert([
            'id' => 3,
            'accesslevel' => 'Everyone',
        ]);
    }
}
