<?php

namespace App\UseCases\Logs;

use App\Http\Requests\GetAccessTokenRequest;
use App\Models\Log;

class SaveLogAction
{
    public function __invoke(GetAccessTokenRequest $request, int $instagram_management_id, string $access_token2, string $access_token3, string $instagram_business_account): void
    {
        Log::query()
            ->create(
                [
                    'app_id'             => $request['app_id'] ?? '',
                    'app_secret'         => $request['app_secret'] ?? '',
                    'management_id'      => $instagram_management_id ?? 0,
                    'access_token_1'     => $request['access_token1'] ?? '',
                    'access_token_2'     => $access_token2 ?? '',
                    'access_token_3'     => $access_token3 ?? '',
                    'facebook_page_name' => $request['facebook_page_name'] ?? '',
                    'business_account'   => $instagram_business_account ?? '',
                ]
            );
    }
}
