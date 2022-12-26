<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    public function index()
    {
        $title = 'Instagram Graph Api Token Generator';

        $endpoint = route('store');
        $method = 'POST';

        $btns = [
            [
                'btn_id' => 'accessTokenContent',
                'display_name' => 'Access Token3',
                'display_name_ja' => 'アクセストークン3',
            ],
            [
                'btn_id' => 'businessAccountId',
                'display_name' => 'Instagram Business Account ID',
                'display_name_ja' => 'Instagram Business AccountのID',
            ]
        ];

        $usage_items = [
            'Switch your Instagram account to a professional account.',
            'Link your Facebook Page to Instagram account.',
            'Access <a class="text-blue-600" href="https://developers.facebook.com/tools">Meta for Developers</a>.',
            'Obtain <span class="label">Access Token1</span>, <span class="label">app secret</span>, <span class="label">App ID</span>.',
            'Enter the data into form of this tool.',
            '<span class="label">Access token 3</span> and <span class="label">Instagram Business Account ID</span> will be obtained automatically.',
            'You can embed it into your website in any way you like.',
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

        $variables = [
            'title' => $title,
        ];

        return $this->blade('manual', $variables);
    }
}
