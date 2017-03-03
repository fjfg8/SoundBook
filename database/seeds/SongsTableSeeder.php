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
            'date' => '15/06/2015',
            'user_id' => 1
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Mi gran noche',
            'artist' => 'Raphael',
            'duration' => '04:10',
            'gender' => 'Copla',
            'date' => '17/02/1978',
            'user_id' => 1
        ]);
        DB::table('songs')->insert([
            
            'title' => 'Ave Maria',
            'artist' => 'David Bisbal',
            'duration' => '03:40',
            'gender' => 'Salsa',
            'date' => '03/06/2002',
            'user_id' => 2
        ]);
    }
}
