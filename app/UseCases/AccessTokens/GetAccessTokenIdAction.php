<?php

namespace App\UseCases\AccessTokens;

use GuzzleHttp\Client;
use RuntimeException;

class GetAccessTokenIdAction
{
    public function __invoke(string $access_token2, string $access_token_id_uri)
    {
        $query = [
            'access_token' => $access_token2,
        ];

        try {
            $client = new Client();
            $accessTokenIdResponse = $client->request('GET', $access_token_id_uri, ['query' => $query]);

            $result = json_decode($accessTokenIdResponse->getBody()->getContents(), true);

            if (isset($result['error'])) {
                throw new \RuntimeException($result['error']['message'] ?? 'Access token2 has expired or is incorrect. / アクセストークン2が有効期限切れ もしくは 間違っています。');
            }
        } catch (RuntimeException $e) {
            return $e->getMessage();
        }
        return $result['id'] ?? null;
    }
}
