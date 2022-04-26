<?php

namespace App\UseCases\AccessTokens;

use GuzzleHttp\Client;
use RuntimeException;

class GetAccessToken2Action
{
    public function __invoke(array $form_request, string $base_url)
    {
        $query = [
            'grant_type' => 'fb_exchange_token',
            'client_id' => $form_request['app_id'],
            'client_secret' => $form_request['app_secret'],
            'fb_exchange_token' => $form_request['access_token1'],
        ];

        try {
            $client = new Client();
            $accessToken2Response = $client->request('GET', $base_url, ['query' => $query]);

            $result = json_decode($accessToken2Response->getBody()->getContents(), true);

            if (isset($result['error'])) {
                throw new RuntimeException($result['error']['message'] ?? 'Access token1 has expired or is incorrect. / アクセストークン1が有効期限切れ もしくは 間違っています。');
            }
        } catch (RuntimeException $e) {
            return $e->getMessage();
        }

        return $result['access_token'];
    }
}
