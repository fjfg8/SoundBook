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
            'description' => 'Para los amantes der rock duro y las motos',
            'user_id' => 1,
            'song_id' => 1
        ]);
        DB::table('groups')->insert([
            
            'name' => 'La ruta del bakalao',
            'musicStyle' => 'Techno',
            'description' => 'Viva la fiesta',
            'user_id' => 2,
            'song_id' => 2
        ]);
        DB::table('groups')->insert([
            
            'name' => 'Salsaludos',
            'musicStyle' => 'Tropical',
            'description' => 'ritmos caribeños y mojitos al sol',
            'user_id' => 1,
            'song_id' => 3
        ]);
    }
}
