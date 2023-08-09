<?php

namespace App\UseCases\AccessTokens;

use Illuminate\Support\Facades\Lang;
use RuntimeException;

class SortAccessToken3Action
{
    protected array $access_token3_array = [];

    public function __invoke($page_name, $response_array): array
    {
        // Facebookページ名を用いて、アクセストークン3とInstagram Page IDを選別
        foreach ($response_array as $array) {
            foreach ($array as $data) {
                if (isset($data['name']) && $data['name'] === $page_name) {
                    $this->access_token3_array = [
                        'access_token'      => $data['access_token'] ?? null,
                        'instagram_page_id' => $data['id'] ?? null
                    ];
                }
            }
        }

        if (!isset($this->access_token3_array['access_token'], $this->access_token3_array['instagram_page_id'])) {
            throw new RuntimeException(Lang::get('validation.facebook_page_none'));
        }

        return $this->access_token3_array;
    }
}
