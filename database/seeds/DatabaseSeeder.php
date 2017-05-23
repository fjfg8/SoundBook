<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(SongsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(GroupUserTableSeeder::class);
        $this->call(PublicationsTableSeeder::class);
        $this->call(UserUserTableSeeder::class);
        
    }
}
