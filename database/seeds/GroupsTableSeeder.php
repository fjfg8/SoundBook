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
            'musicStyle' => 'Rock',
            'description' => 'Para los amantes der rock duro y las motos'
        
        ]);
        DB::table('groups')->insert([
            
            'name' => 'La ruta del bakalao',
            'musicStyle' => 'Techno',
            'description' => 'Viva la fiesta'
        ]);
        DB::table('groups')->insert([
            
            'name' => 'Salsaludos',
            'musicStyle' => 'Tropical',
            'description' => 'ritmos caribeños y mojitos al sol'
        ]);

        DB::table('groups')->insert([
            
            'name' => 'otro',
            'musicStyle' => 'Tropical',
            'description' => 'ritmos caribeños sol'
        ]);
    }
}
