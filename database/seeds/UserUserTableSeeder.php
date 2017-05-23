<?php

use Illuminate\Database\Seeder;

class UserUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_user')->delete();

        DB::table('user_user')->insert([
            'user_id1' => 2,
            'user_id2' => 1
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 2,
            'user_id2' => 3
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 2,
            'user_id2' => 4
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 3,
            'user_id2' => 1
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 3,
            'user_id2' => 2
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 4,
            'user_id2' => 3
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 5,
            'user_id2' => 2
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 2,
            'user_id2' => 6
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 4,
            'user_id2' => 1
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 5,
            'user_id2' => 3
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 2,
            'user_id2' => 5
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 1,
            'user_id2' => 2
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 1,
            'user_id2' => 3
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 1,
            'user_id2' => 4
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 1,
            'user_id2' => 5
        ]);
         DB::table('user_user')->insert([
            'user_id1' => 1,
            'user_id2' => 6
        ]);
    }
}
