<?php

namespace App\Providers;

use App\Helpers\Config;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


class DatabaseServiceProvider
{
    public function boot($driver = 'mysql'): void
    {
        $capsule = new Capsule;

        $capsule->addConnection(Config::get('database.' . $driver));

        $capsule->setEventDispatcher(new Dispatcher(new Container));

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }
}