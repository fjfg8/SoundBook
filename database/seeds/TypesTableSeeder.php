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

        DB::table('types')->insert([  //1          
            'type'=>'Electronica'
        ]);
        DB::table('types')->insert([  //2          
            'type'=>'Reggaeton'
        ]);
        DB::table('types')->insert([    //3        
            'type'=>'Rap'
        ]);
        DB::table('types')->insert([    //4        
            'type'=>'Salsa'
        ]);
        DB::table('types')->insert([    //5        
            'type'=>'Copla'
        ]);
        DB::table('types')->insert([     //6       
            'type'=>'Cover'
        ]);
        DB::table('types')->insert([    //7        
            'type'=>'Rock'
        ]);
        DB::table('types')->insert([      //8      
            'type'=>'Pop'
        ]);
        DB::table('types')->insert([    //9        
            'type'=>'Flamenco'
        ]);
        DB::table('types')->insert([   //10        
            'type'=>'Clasica'
        ]);
        DB::table('types')->insert([    //11        
            'type'=>'Latino'
        ]);
        DB::table('types')->insert([     //12       
            'type'=>'Otro'
        ]);
        
        
    }
}
