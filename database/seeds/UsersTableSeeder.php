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
            'password' => 'jonay',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rock',
            'admin' => true,
            'account_id' => 1
        ]);

        DB::table('users')->insert([
            
            'name' => 'Fran',
            'email' => 'fran@ejemplo.com',
            'password' => 'fran',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rap',
            'admin' => true,
            'account_id' => 2
        ]);

         DB::table('users')->insert([
            
            'name' => 'Raul',
            'email' => 'raul@ejemplo.com',
            'password' => 'raul',
            'gender' => 'Hombre',
            'status' => 'Soltero',
            'preferences' => 'Rap',
            'admin' => true,
            'account_id' => 3
        ]);

    }
}
