<?php

namespace App\UseCases\AccessTokens;

use GuzzleHttp\Client;
use JsonException;

class GetAccessToken3Action
{
    protected string $url_for_access_token3;

    public function __invoke(string $access_token2, string $base_url, int $instagram_management_id)
    {
        $this->url_for_access_token3 = $base_url
            . '/'. $instagram_management_id
            . '/accounts';

        $query = [
            'access_token' => $access_token2,
            'limit'        => '1000'
        ];

        try {
            $client                      = new Client();
            $access_token3_response_json = $client->request('GET', $this->url_for_access_token3, [ 'query' => $query ]);

            $result = json_decode($access_token3_response_json->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return $e->getMessage();
        }

        if (isset($result[ 'error' ])) {
            throw new \RuntimeException($result[ 'error' ][ 'message' ] ?? 'Access token2 has expired or is incorrect. / アクセストークン2が有効期限切れ もしくは 間違っています。');
        }

        return $result;
    }
}
