<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->delete();

        DB::table('types')->insert([            
            'type'=>'Electronica'
        ]);
        DB::table('types')->insert([            
            'type'=>'Reggaeton'
        ]);
        DB::table('types')->insert([            
            'type'=>'Rap'
        ]);
        DB::table('types')->insert([            
            'type'=>'Salsa'
        ]);
        DB::table('types')->insert([            
            'type'=>'Copla'
        ]);
        DB::table('types')->insert([            
            'type'=>'Cover'
        ]);
        DB::table('types')->insert([            
            'type'=>'Rock'
        ]);
        DB::table('types')->insert([            
            'type'=>'Pop'
        ]);
        DB::table('types')->insert([            
            'type'=>'Flamenco'
        ]);
        DB::table('types')->insert([            
            'type'=>'Clasica'
        ]);
        DB::table('types')->insert([            
            'type'=>'Latino'
        ]);
        DB::table('types')->insert([            
            'type'=>'Otro'
        ]);
        
        
    }
}
