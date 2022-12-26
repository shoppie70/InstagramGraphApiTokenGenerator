<?php

namespace App\UseCases\AccessTokens;

use App\Http\Requests\GetAccessTokenRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Lang;
use JsonException;
use RuntimeException;

class GetAccessToken2Action
{
    protected array $query;

    public function __construct(GetAccessTokenRequest $form_request)
    {
        $this->query = [
            'grant_type' => 'fb_exchange_token',
            'client_id' => $form_request->get('app_id'),
            'client_secret' => $form_request->get('app_secret'),
            'fb_exchange_token' => $form_request->get('access_token1'),
        ];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function __invoke(string $base_url)
    {
        $client = new Client();
        $accessToken2Response = $client->request('GET', $base_url, ['query' => $this->query, 'http_errors' => false]);

        $result = json_decode($accessToken2Response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (isset($result['error']) || !isset($result['access_token'])) {
            throw new RuntimeException(Lang::get('validation.access_token1'));
        }

        return $result['access_token'];
    }
}
