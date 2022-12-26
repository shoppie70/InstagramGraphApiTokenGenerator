<?php

namespace App\UseCases\BusinessAccounts;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Lang;
use JsonException;
use RuntimeException;

class GetBusinessAccountAction
{
    protected array $result = [];
    protected array $query;
    protected string $target_url;

    public function __construct(string $base_url, int $page_id, string $access_token)
    {
        $this->query = [
            'fields' => 'instagram_business_account',
            'access_token' => $access_token
        ];

        $this->target_url = $base_url . '/' . $page_id;
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function __invoke()
    {
        $client = new Client();
        $business_account_id_response = $client->request('GET', $this->target_url, ['query' => $this->query, 'http_errors' => false]);

        $this->result = json_decode($business_account_id_response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (isset($this->result['error'])) {
            throw new RuntimeException(Lang::get('validation.access_token_wrong'));
        }

        if (!isset($this->result['instagram_business_account']['id'])) {
            throw new RuntimeException(Lang::get('validation.wrong_link_account'));
        }

        return $this->result['instagram_business_account']['id'];
    }
}
