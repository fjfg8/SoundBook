<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('groups')->delete();

        DB::table('groups')->insert([
            
            'name' => 'Los Angeles del Infierno',
            'type_id' => 7,
            'description' => 'Para los amantes der rock duro y las motos',
            'user_admin_id' => 4

        
        ]);
        DB::table('groups')->insert([
            
            'name' => 'La ruta del bakalao',
            'type_id' => 1,
            'description' => 'Viva la fiesta',
            'user_admin_id' => 1
        ]);
        DB::table('groups')->insert([
            
            'name' => 'Salsaludos',
            'type_id' => 4,
            'description' => 'ritmos caribeños y mojitos al sol',
            'user_admin_id' => 3
        ]);

        DB::table('groups')->insert([
            
            'name' => 'otro',
            'type_id' => 11,
            'description' => 'ritmos caribeños sol',
            'user_admin_id' => 2
        ]);
    }
}
