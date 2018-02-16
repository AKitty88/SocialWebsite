<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'id' => 7,
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => bcrypt('1234'),
            'image' => 'https://cdn2-www.dogtime.com/assets/uploads/gallery/30-impossibly-cute-puppies/impossibly-cute-puppy-8.jpg',
            'birth' => '14.02.1987',
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('users')->insert([
            'id' => 8,
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
            'password' => bcrypt('1234'),
            'image' => 'https://www.piperstreetvet.com.au/wp-content/uploads/2015/11/puppy.jpg',
            'birth' => '24.04.1989',
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        DB::table('users')->insert([
            'id' => 10,
            'name' => 'Tim',
            'email' => 'tim@gmail.com',
            'password' => bcrypt('1234'),
            'image' => 'http://dogtraining.com.au/wp-content/uploads/2016/11/tumblr_og5no8p2F21rbibvmo1_1280.jpg',
            'birth' => '16.03.1988',
            'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
