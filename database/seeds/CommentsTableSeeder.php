<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:29:01',
            'comment' => 'Muy buena cancion',
            'likes' => '100',
            'user_id' => 1,
            'song_id' => 1
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:29:30',
            'comment' => 'Estupenda',
            'likes' => '10',
            'user_id' => 2,
            'song_id' => 2
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:30:23',
            'comment' => 'Un clasico',
            'likes' => '5',
            'user_id' => 1,
            'song_id' => 3
        ]);

    }
}
