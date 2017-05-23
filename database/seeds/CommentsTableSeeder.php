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
            'user_id' => 1,
            'song_id' => 1
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:29:30',
            'comment' => 'Estupenda',
            'user_id' => 2,
            'song_id' => 2
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:30:23',
            'comment' => 'Un clasico',
            'user_id' => 1,
            'song_id' => 3
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-18 18:30:23',
            'comment' => 'Me encanta',
            'user_id' => 4,
            'song_id' => 6
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:30:23',
            'comment' => 'No me gusta nada',
            'user_id' => 5,
            'song_id' => 8
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:30:23',
            'comment' => 'Para cuando la proxima',
            'user_id' => 3,
            'song_id' => 5
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:30:23',
            'comment' => 'Me hizo llorar',
            'user_id' => 6,
            'song_id' => 9
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:30:23',
            'comment' => 'Que recuerdos',
            'user_id' => 3,
            'song_id' => 2
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:30:23',
            'comment' => 'Un clasico',
            'user_id' => 4,
            'song_id' => 5
        ]);
        DB::table('comments')->insert([
            'created_at' => '2017-05-17 18:30:23',
            'comment' => 'No me gusto nada',
            'user_id' => 6,
            'song_id' => 3
        ]);
    }
}
