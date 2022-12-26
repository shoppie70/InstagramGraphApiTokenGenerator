<?php

namespace App\UseCases\AccessTokens;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Lang;
use JsonException;
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

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function __invoke(string $access_token_id_uri)
    {
        $client = new Client();
        $accessTokenIdResponse = $client->request('GET', $access_token_id_uri, ['query' => $this->query, 'http_errors' => false]);

        $result = json_decode($accessTokenIdResponse->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (isset($result['error']) || !isset($result['id'])) {
            throw new RuntimeException(Lang::get('validation.access_token2'));
        }

        return $result['id'];
    }
}
