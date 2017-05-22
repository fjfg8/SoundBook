<?php

use Illuminate\Database\Seeder;
use App\Publication;

class PublicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publications')->delete();

        DB::table('publications')->insert([
            'created_at' => '2017-05-17 18:29:01',
            'title' => 'Concierto en bar manolo',
            'description' => 'Concierto de un grupo muy especial para la ruta del bakalao',
            'group_id' => 2,
            'user_id' => 1
        ]);

        DB::table('publications')->insert([
            'created_at' => '2017-05-17 18:29:01',
            'title' => 'Concierto en barpaco',
            'description' => 'Concierto de un grupo muy especial para la ruta del bakalao',
            'group_id' => 2,
            'user_id' => 1
        ]);

        DB::table('publications')->insert([
            'created_at' => '2017-05-17 18:29:01',
            'title' => 'Concierto en Alicante',
            'description' => 'Concierto de un grupo muy especial para la ruta del bakalao',
            'group_id' => 2,
            'user_id' => 2
        ]);

        DB::table('publications')->insert([
            'created_at' => '2017-05-17 18:29:01',
            'title' => 'Autografos en granvia',
            'description' => 'Firma de autografos',
            'group_id' => 2,
            'user_id' => 1
        ]);
        

    }
}