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
            'date' => '03/03/2017',
            'likes' => '100',
            'user_id' => 1,
            'song_id' => 1
        ]);
        DB::table('comments')->insert([
            
            'comment' => 'Estupenda',
            'date' => '03/03/2017',
            'likes' => '10',
            'user_id' => 2,
            'song_id' => 2
        ]);
        DB::table('comments')->insert([
            
            'comment' => 'Un clasico',
            'date' => '03/03/2017',
            'likes' => '5',
            'user_id' => 1,
            'song_id' => 3
        ]);

    }
}
