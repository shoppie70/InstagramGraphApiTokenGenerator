<?php

namespace App\UseCases\AccessTokens;

use GuzzleHttp\Client;
use RuntimeException;

class GetAccessToken2Action
{
    protected array $query;

    public function __construct(array $form_request)
    {
        $this->query = [
            'grant_type' => 'fb_exchange_token',
            'client_id' => $form_request['app_id'],
            'client_secret' => $form_request['app_secret'],
            'fb_exchange_token' => $form_request['access_token1'],
        ];
    }

    public function __invoke(string $base_url)
    {
        $client = new Client();
        $accessToken2Response = $client->request('GET', $base_url, ['query' => $this->query]);

        $result = json_decode($accessToken2Response->getBody()->getContents(), true);

        if (isset($result['error'])) {
            throw new RuntimeException($result['error']['message'] ?? 'Access token1 has expired or is incorrect. / アクセストークン1が有効期限切れ もしくは 間違っています。');
        }

        if (!isset($result['access_token'])) {
            throw new RuntimeException('Access token1 has expired or is incorrect. / アクセストークン1が有効期限切れ もしくは 間違っています。');
        }

        return $result['access_token'];
    }
}
