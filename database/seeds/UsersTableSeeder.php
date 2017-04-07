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
            
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'nick' => 'admin',
            'password' => 'admin',
            'gender' => '-',
            'status' => '-',
            'preferences' => '-'
            
        ]);

        DB::table('users')->insert([
            
            'name' => 'Jonay',
            'email' => 'jonay@ejemplo.com',
            'nick'=> 'jonay',
            'password' => 'jonay',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rock'
           
        ]);

        DB::table('users')->insert([
            
            'name' => 'Fran',
            'email' => 'fran@ejemplo.com',
            'nick' => 'fran',
            'password' => 'fran',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rap'
        
        ]);

         DB::table('users')->insert([
            
            'name' => 'Raul',
            'email' => 'raul@ejemplo.com',
            'nick' => 'raul',
            'password' => 'raul',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rap'
            
        ]);

        DB::table('users')->insert([
            
            'name' => 'Larry',
            'email' => 'larry@ejemplo.com',
            'nick' => 'larry',
            'password' => 'larry',
            'gender' => 'Hombre',
            'status' => 'Casado',
            'preferences' => 'HipHop'
            
        ]);
    

    }
}
