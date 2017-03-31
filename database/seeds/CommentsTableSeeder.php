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
            
            'comment' => 'Muy buena cancion',
            'likes' => '100',
            'user_id' => 1,
            'song_id' => 1
        ]);
        DB::table('comments')->insert([
            
            'comment' => 'Estupenda',
            'likes' => '10',
            'user_id' => 2,
            'song_id' => 2
        ]);
        DB::table('comments')->insert([
            
            'comment' => 'Un clasico',
            'likes' => '5',
            'user_id' => 1,
            'song_id' => 3
        ]);

    }
}
