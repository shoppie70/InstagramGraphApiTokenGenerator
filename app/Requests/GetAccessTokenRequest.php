<?php

namespace App\Requests;

class GetAccessTokenRequest
{
    protected string $access_token1;
    protected int    $app_id;
    protected string $app_secret;
    protected string $facebook_page_name;

    public function __construct(array $request)
    {
        $this->access_token1      = filter_var($request[ 'access_token1' ], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->app_id             = filter_var($request[ 'app_id' ], FILTER_SANITIZE_NUMBER_INT);
        $this->app_secret         = filter_var($request[ 'app_secret' ], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->facebook_page_name = filter_var($request[ 'facebook_page_name' ], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    public function getRequest(): array
    {
        return [
            'access_token1'      => $this->access_token1,
            'app_id'             => $this->app_id,
            'app_secret'         => $this->app_secret,
            'facebook_page_name' => $this->facebook_page_name,
        ];
    }

    public function validateAccessTokenRequest(): bool
    {
        if (isset($this->access_token1, $this->app_id, $this->app_secret, $this->facebook_page_name)) {
            return true;
        }

        return false;
    }
}
