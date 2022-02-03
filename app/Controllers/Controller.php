<?php

namespace App\Controllers;


use eftec\bladeone\BladeOne;

class Controller
{
    public function blade(string $template, array $variables = []): string
    {
        $dir = dirname(__DIR__, 2);
        $views = $dir . '/resources/views';
        $cache = $dir . '/cache';
        return ( new BladeOne( $views, $cache, BladeOne::MODE_AUTO ) )->run($template, $variables);
    }
}