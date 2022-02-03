<?php

namespace App\Controllers;

use App\Models\LogRecord;

class AppController extends Controller
{
    public function index (): string
    {
        $title = 'Instagram Graph Api Automatic Token Acquisition Tool';

        $endpoint = base_uri() . '/api/v1/store';
        $method   = 'POST';

        $btns = [
            [
                'btn_id'          => 'accessTokenContent',
                'display_name'    => 'Access Token3',
                'display_name_ja' => 'アクセストークン3',
            ],
            [
                'btn_id'          => 'businessAccountId',
                'display_name'    => 'Instagram Business Account ID',
                'display_name_ja' => 'Instagram Business AccountのID',
            ]
        ];

        $variables = [
            'title'    => $title,
            'endpoint' => $endpoint,
            'method'   => $method,
            'btns'     => $btns
        ];

        return $this->blade( 'index', $variables );
    }
}