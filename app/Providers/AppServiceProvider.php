<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use App\Interfaces\BukuInterfaces;
use App\Interfaces\UserInterface;
use App\Repositories\UserRepo;
use App\Repositories\BukuRepo;


class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        BukuInterfaces::class => BukuRepo::class,
        UserInterface::class => UserRepo::class,
    ];
    public function register(): void
    {
       foreach($this->bindings as $interface => $implementation){
        App::bind($interface, $implementation);
       }
    }

        //
}    

