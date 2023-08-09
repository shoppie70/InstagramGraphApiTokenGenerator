<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Lang;

class AppController extends Controller
{
    public function index()
    {
        $title = 'Instagram Graph Api Token Generator';

        $endpoint = route('store');
        $method   = 'POST';

        $btns = [
            [
                'btn_id'       => 'accessTokenContent',
                'display_name' => 'Access Token3',
            ],
            [
                'btn_id'       => 'businessAccountId',
                'display_name' => 'Instagram Business Account ID',
            ]
        ];

        $usage_items = [
            Lang::get('flow.step1'),
            Lang::get('flow.step2'),
            Lang::get('flow.step3'),
            Lang::get('flow.step4'),
            Lang::get('flow.step5'),
            Lang::get('flow.step6'),
            Lang::get('flow.step7'),
        ];

        return view('index', compact(
            'title',
            'endpoint',
            'method',
            'btns',
            'usage_items'
        ));
    }

    public function manual(): string
    {
        $title = 'Manual Acquisition Help tool';

        return view('manual', compact(
            'title',
        ));
    }
}
