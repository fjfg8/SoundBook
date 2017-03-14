<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->delete();

        DB::table('accounts')->insert([
            
            'nick'=>'Aylmao'
        ]);
        DB::table('accounts')->insert([
            
            'nick'=>'Fran'
        ]);
        DB::table('accounts')->insert([
            
            'nick'=>'DSS'
        ]);
    }
}
