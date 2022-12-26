<?php

namespace App\UseCases\AccessTokens;

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
                        'access_token' => $data['access_token'],
                        'instagram_page_id' => $data['id']
                    ];
                }
            }
        }

        if(!isset($this->access_token3_array['access_token'], $this->access_token3_array['instagram_page_id'])) {
            throw new RuntimeException('The Facebook page you sent does not seem to be registered in your Facebook account. / 送信されたFacebookページは、ご利用のFacebookアカウントに登録されていないようです。');
        }

        return $this->access_token3_array;
    }
}
