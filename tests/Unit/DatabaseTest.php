<?php

namespace Tests\Unit;

use App\User;
use App\Song;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DatabaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    

    public function testExample()
    {
        $this->assertDatabaseHas('users',['email'=> 'jonay@ejemplo.com']);
        $user = new User();
        $com = $user->comment()->where('user_id', 2) ->get();
        $song = new Song();
        $com2 = $song->comment()->where('user_id', 2) ->get();
        $this->assertEquals($com,$com2);
        
    }
}
