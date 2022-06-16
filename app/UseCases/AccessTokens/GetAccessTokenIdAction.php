<?php

namespace App\UseCases\AccessTokens;

use GuzzleHttp\Client;
use RuntimeException;

class GetAccessTokenIdAction
{

    protected array $query;

    public function __construct(string $access_token2)
    {
        $this->query = [
            'access_token' => $access_token2,
        ];
    }

    public function __invoke(string $access_token_id_uri)
    {
        $client = new Client();
        $accessTokenIdResponse = $client->request('GET', $access_token_id_uri, ['query' => $this->query]);

        $result = json_decode($accessTokenIdResponse->getBody()->getContents(), true);

        if (isset($result['error'])) {
            throw new RuntimeException($result['error']['message'] ?? 'Access token2 has expired or is incorrect. / アクセストークン2が有効期限切れ もしくは 間違っています。');
        }

        if (!isset($result['id'])) {
            throw new RuntimeException('Access token2 has expired or is incorrect. / アクセストークン2が有効期限切れ もしくは 間違っています。');
        }

        return $result['id'];
    }
}
