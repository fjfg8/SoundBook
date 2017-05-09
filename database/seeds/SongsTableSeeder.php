<?php

use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->delete();

        DB::table('songs')->insert([
            
            'title' => 'La Gozadera',
            'artist' => 'Marc Anthony',
            'album'=> 'La Gozadera',
            'duration' => '03:25',
            'gender' => 'Salsa',
            'url' => "https://www.youtube.com/embed/VMp55KH_3wo",
            'date' => '2015-05-12',
            'user_id' => 1
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Mi gran noche',
            'artist' => 'Raphael',
            'album' => 'Grandes exitos',
            'duration' => '04:10',
            'gender' => 'Copla',
            'url' => "https://www.youtube.com/embed/477d0T1YuKE",
            'date' => '1978-02-17',
            'user_id' => 1
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Ave Maria',
            'artist' => 'David Bisbal',
            'album' => 'Especial OT',
            'duration' => '03:40',
            'gender' => 'Salsa',
            'url' => "https://www.youtube.com/embed/gra-sIV1n4U",
            'date' => '2002-03-06',
            'user_id' => 2
        ]);

        /*for($i=0;$i<=25;$i++){
           DB::table('songs')->insert([
            
            'title' => 'song'.$i,
            'artist' => 'artist'.$i,
            'duration' => '03:40',
            'gender' => 'Salsa',
            'date' => '2001-01-12',
            'user_id' => 1
        ]); 
        }*/

    }
}
