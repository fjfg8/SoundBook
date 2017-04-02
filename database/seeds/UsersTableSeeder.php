<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            
            'name' => 'Jonay',
            'email' => 'jonay@ejemplo.com',
            'nick'=> 'Aylmao',
            'password' => 'jonay',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rock'
           
        ]);

        DB::table('users')->insert([
            
            'name' => 'Fran',
            'email' => 'fran@ejemplo.com',
            'nick' => 'Nanet',
            'password' => 'fran',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rap'
        
        ]);

         DB::table('users')->insert([
            
            'name' => 'Raul',
            'email' => 'raul@ejemplo.com',
            'nick' => 'Raul',
            'password' => 'raul',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rap'
            
        ]);

    }
}
