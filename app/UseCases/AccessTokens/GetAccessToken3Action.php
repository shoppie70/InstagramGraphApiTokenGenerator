<?php

namespace App\UseCases\AccessTokens;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use RuntimeException;

class GetAccessToken3Action
{
    protected string $url_for_access_token3;
    protected array $query;

    public function __construct(string $access_token2, string $base_url, int $instagram_management_id)
    {
        $this->url_for_access_token3 = $base_url
            . '/' . $instagram_management_id
            . '/accounts';

        $this->query = [
            'access_token' => $access_token2,
            'limit' => '1000'
        ];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function __invoke()
    {
        $client = new Client();
        $access_token3_response_json = $client->request('GET', $this->url_for_access_token3, ['query' => $this->query]);

        $result = json_decode($access_token3_response_json->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (isset($result['error'])) {
            throw new RuntimeException($result['error']['message'] ?? 'Access token2 has expired or is incorrect. / アクセストークン2が有効期限切れ もしくは 間違っています。');
        }

        return $result;
    }
}
