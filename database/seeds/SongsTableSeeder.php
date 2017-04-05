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
            'duration' => '03:25',
            'gender' => 'Salsa',
            'date' => '2015-05-12',
            'user_id' => 1
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Mi gran noche',
            'artist' => 'Raphael',
            'duration' => '04:10',
            'gender' => 'Copla',
            'date' => '1978-02-17',
            'user_id' => 1
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Ave Maria',
            'artist' => 'David Bisbal',
            'duration' => '03:40',
            'gender' => 'Salsa',
            'date' => '2002-03-06',
            'user_id' => 2
        ]);

        for($i=0;$i<=25;$i++){
           DB::table('songs')->insert([
            
            'title' => 'song'.$i,
            'artist' => 'artist'.$i,
            'duration' => '03:40',
            'gender' => 'Salsa',
            'date' => '2001-01-12',
            'user_id' => 1
        ]); 
        }

    }
}
