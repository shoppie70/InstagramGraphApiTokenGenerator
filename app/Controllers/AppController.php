<?php

namespace App\Controllers;

class AppController extends Controller
{
    public function index (): string
    {
        $title    = 'TOP';
        $endpoint = base_uri() . '/api/v1/store';
        $method   = 'POST';

        $variables = [
            'title'    => $title,
            'endpoint' => $endpoint,
            'method'   => $method,
        ];

        return $this->blade( 'index', $variables );
    }
}