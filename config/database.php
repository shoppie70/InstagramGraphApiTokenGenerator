<?php

/**
 * DBの設定
 */
$db_connections = [
    'driver'    => config('DRIVER'),
    'host'      => config('HOST'),
    'database'  => config('DATABASE'),
    'username'  => config('USERNAME'),
    'password'  => config('PASSWORD'),
    'charset'   => config('CHARSET'),
    'collation' => config('COLLATION')
];

class_alias(Illuminate\Database\Capsule\Manager::class, 'DB');

$database = new DB();
$database->addConnection($db_connections);
$database->setAsGlobal();
$database->bootEloquent();
