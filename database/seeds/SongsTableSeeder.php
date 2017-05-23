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
            'url' => "https://www.youtube.com/embed/VMp55KH_3wo",
            'date' => '2015-05-12',
            'user_id' => 1,
            'type_id' => 4,
            'created_at'=>'2017-02-03'
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Mi gran noche',
            'artist' => 'Raphael',
            'album' => 'Grandes exitos',
            'url' => "https://www.youtube.com/embed/477d0T1YuKE",
            'date' => '1978-02-17',
            'user_id' => 1,
            'type_id' => 5,
            'created_at'=>'2017-02-01'
            
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Ave Maria',
            'artist' => 'David Bisbal',
            'album' => 'Especial OT',
            'url' => "https://www.youtube.com/embed/gra-sIV1n4U",
            'date' => '2002-03-06',
            'user_id' => 2,
            'type_id' => 11,
            'created_at'=>'2017-02-02'
        ]);
        DB::table('songs')->insert([
            
            'title' => '100 Frases',
            'artist' => 'Sharif',
            'album' => 'Sobre los margenes',
            'url' => "https://www.youtube.com/embed/5vtf8k3Ibgo",
            'date' => '2014-03-06',
            'user_id' => 3,
            'type_id' => 3,
            'created_at'=>'2017-03-02'
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Copacabana',
            'artist' => 'Izal',
            'album' => 'Copacabana',
            'url' => "https://www.youtube.com/embed/eFN5TSKCuCs",
            'date' => '2015-03-13',
            'user_id' => 5,
            'type_id' => 12,
            'created_at'=>'2017-04-02'
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Triste cancion de amor',
            'artist' => 'Sharif',
            'album' => 'Sobre los margenes',
            'url' => "https://www.youtube.com/embed/ZQW_xbekOJc",
            'date' => '2013-03-23',
            'user_id' => 5,
            'type_id' => 3,
            'created_at'=>'2017-02-02'
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
