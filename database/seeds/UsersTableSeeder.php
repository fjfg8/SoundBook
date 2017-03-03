<?php

use Illuminate\Database\Seeder;

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
            'password' => 'jonay',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rock',
            'admin' => true
        ]);

        DB::table('users')->insert([
            
            'name' => 'Fran',
            'email' => 'fran@ejemplo.com',
            'password' => 'fran',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rap',
            'admin' => true
        ]);
    }
}
