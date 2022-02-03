<?php


namespace App\Helpers;

use Illuminate\Config\Repository;


class Config
{
    private static array $instances = [];

    private static function loadFile(string $filename): void
    {
        static::$instances[$filename] = new Repository(require dirname(__DIR__, 2) . '/config/' . $filename . '.php');
    }

    public static function get(string $key)
    {
        $filename = strstr($key,'.', true);
        $key =  mb_substr(strstr($key,'.', false), 1);

        if (!isset(static::$instances[$filename])) {
            self::loadFile($filename);
        }

        return static::$instances[$filename]->get($key);
    }
}