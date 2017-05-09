<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    /*public function boot()
    {
        if (config('database.default' ) == 'sqlite') {
            $db = app()->make('db');
               $db->connection()->getPdo()->exec("PRAGMA foreign_keys = ON" );
        }
    }*/

    public function boot(Dispatcher $events)
    {

        if (config('database.default' ) == 'sqlite') {
            $db = app()->make('db');
               $db->connection()->getPdo()->exec("PRAGMA foreign_keys = ON" );
        }
        
        
            $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
                $user = Auth::user();
                if($user->isAdmin){
                    $event->menu->add('ADMINISTRACIÓN WEB');
                    $event->menu->add([
                        'text' => 'Admin',
                        'url' => 'admin',
                        'icon' => 'database',
                    ]);
                }
            });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
