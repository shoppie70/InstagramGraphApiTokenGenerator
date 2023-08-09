<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetAccessTokenRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'access_token1'      => 'required|string',
            'app_id'             => 'required|string',
            'app_secret'         => 'required|string',
            'facebook_page_name' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'access_token1'      => 'Access Token1',
            'app_id'             => 'App ID',
            'app_secret'         => 'App Secret',
            'facebook_page_name' => 'Facebook Page Name',
        ];
    }
}
