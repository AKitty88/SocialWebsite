<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AccesslevelsTableSeeder::class);
        $this->call(FriendshipsTableSeeder::class);
    }
}
