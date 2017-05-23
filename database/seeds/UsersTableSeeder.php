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
            'gender' => 'Hombre',
            'status' => 'Soltero/a',
            'preferences' => 'Rap',
            'image' => 'https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg'
        ]);

        DB::table('users')->insert([
            
            'name' => 'Jonay',
            'email' => 'jonay@ejemplo.com',
            'nick'=> 'jonay',
            'password' => bcrypt('jonay'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Casado/a',
            'preferences' => 'Rock',
            'image' => 'img/jonay.png'
        ]);

        DB::table('users')->insert([
            
            'name' => 'Fran',
            'email' => 'fran@ejemplo.com',
            'nick' => 'fran',
            'password' => bcrypt('fran'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Soltero/a',
            'preferences' => 'Rap',
            'image' => 'img/fran.jpg'
        ]);

         DB::table('users')->insert([
            
            'name' => 'Raul',
            'email' => 'raul@ejemplo.com',
            'nick' => 'raul',
            'password' => bcrypt('raul'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Soltero/a',
            'preferences' => 'Rap',
            'image' => 'img/raul.jpg'
        ]);

        DB::table('users')->insert([
            
            'name' => 'Larry',
            'email' => 'larry@ejemplo.com',
            'nick' => 'larry',
            'password' => bcrypt('larry'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Comprometido/a',
            'preferences' => 'HipHop',
            'image' => 'img/larry.png'
        ]);

        DB::table('users')->insert([
            
            'name' => 'Alex',
            'email' => 'alex@ejemplo.com',
            'nick' => 'alex',
            'password' => bcrypt('alex'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Comprometido/a',
            'preferences' => 'Pop',
            'image' => 'img/alex.png'
        ]);

        DB::table('users')->insert([
            
            'name' => 'Angel',
            'email' => 'angel@ejemplo.com',
            'nick' => 'angel',
            'password' => bcrypt('angel'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Soltero/a',
            'preferences' => 'Salsa',
            'image' => 'img/angel.png'
        ]);

        DB::table('users')->insert([
            
            'name' => 'Carlos',
            'email' => 'carlos@ejemplo.com',
            'nick' => 'carlos',
            'password' => bcrypt('carlos'),
            'isAdmin' => false,
            'gender' => 'Hombre',
            'status' => 'Soltero/a',
            'preferences' => 'Copla',
            'image' => 'img/carlos.png'
        ]);

        DB::table('users')->insert([
            
            'name' => 'Paloma',
            'email' => 'paloma@ejemplo.com',
            'nick' => 'paloma',
            'password' => bcrypt('paloma'),
            'isAdmin' => false,
            'gender' => 'Mujer',
            'status' => 'Casado/a',
            'preferences' => 'Reggaeton',
            'image' => 'img/paloma.png'
        ]);

        DB::table('users')->insert([
            
            'name' => 'Natalia',
            'email' => 'natalia@ejemplo.com',
            'nick' => 'natalia',
            'password' => bcrypt('natalia'),
            'isAdmin' => false,
            'gender' => 'Mujer',
            'status' => 'Soltero/a',
            'preferences' => 'Pop',
            'image' => 'img/natalia.png'
        ]);

        DB::table('users')->insert([
            
            'name' => 'Arancha',
            'email' => 'arancha@ejemplo.com',
            'nick' => 'arancha',
            'password' => bcrypt('arancha'),
            'isAdmin' => false,
            'gender' => 'Mujer',
            'status' => 'Soltero/a',
            'preferences' => 'Latino',
            'image' => 'img/arancha.png'
        ]);

    

    }
}
