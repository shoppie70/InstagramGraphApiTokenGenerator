<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Lang;

class AppController extends Controller
{
    public function index()
    {
        $title = Lang::get('common.title');

        $endpoint = route('store.' . app()->getLocale());
        $method   = 'POST';

        $btns = [
            [
                'btn_id'       => 'accessTokenContent',
                'display_name' => Lang::get('common.access_token3'),
            ],
            [
                'btn_id'       => 'businessAccountId',
                'display_name' => Lang::get('common.instagram_business_account_id'),
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
        $title = Lang::get('common.manual_title');

        return view('manual', compact(
            'title',
        ));
    }
}
