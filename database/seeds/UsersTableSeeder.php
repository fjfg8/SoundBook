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
            'password' => bcrypt('admin'),
            'isAdmin' => true,
            'gender' => '-',
            'status' => '-',
            'preferences' => '-',
            'image' => 'http://www.carkeysystem.com/wp-content/uploads/2015/05/reprogramacion-de-coches.jpg'
            
        ]);

        DB::table('users')->insert([
            
            'name' => 'Jonay',
            'email' => 'jonay@ejemplo.com',
            'nick'=> 'jonay',
            'password' => bcrypt('jonay'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rock',
            'image' => 'http://xacatolicos.com/app/images/icon-user.png'
           
        ]);

        DB::table('users')->insert([
            
            'name' => 'Fran',
            'email' => 'fran@ejemplo.com',
            'nick' => 'fran',
            'password' => bcrypt('fran'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rap',
            'image' => 'http://xacatolicos.com/app/images/icon-user.png'
        
        ]);

         DB::table('users')->insert([
            
            'name' => 'Raul',
            'email' => 'raul@ejemplo.com',
            'nick' => 'raul',
            'password' => bcrypt('raul'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rap',
            'image' => 'http://xacatolicos.com/app/images/icon-user.png'
            
        ]);

        DB::table('users')->insert([
            
            'name' => 'Larry',
            'email' => 'larry@ejemplo.com',
            'nick' => 'larry',
            'password' => bcrypt('larry'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Casado',
            'preferences' => 'HipHop',
            'image' => 'http://xacatolicos.com/app/images/icon-user.png'
            
        ]);
    

    }
}
