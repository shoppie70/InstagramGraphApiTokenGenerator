<?php

namespace App\UseCases\BusinessAccounts;

use GuzzleHttp\Client;
use RuntimeException;

class GetBusinessAccountAction
{
    protected array $result = [];

    public function __invoke(string $base_url, int $page_id, string $access_token)
    {
        $query = [
            'fields' => 'instagram_business_account',
            'access_token' => $access_token
        ];

        $target_url = $base_url . '/' . $page_id;

        try {
            $client = new Client();
            $business_account_id_response = $client->request('GET', $target_url, ['query' => $query]);

            $this->result = json_decode($business_account_id_response->getBody()->getContents(), true);

            if (isset($this->result['error'])) {
                throw new RuntimeException($this->result['error']['message'] ?? 'The access token may be wrong. / アクセストークンが間違っている可能性があります。');
            }

            if (!isset($this->result['instagram_business_account']['id'])) {
                throw new RuntimeException('Instagram is not a business account. / インスタグラムがビジネスアカウントになっていません。');
            }

        } catch (RuntimeException $e) {
            print $e->getMessage();
        }

        return $this->result['instagram_business_account']['id'];
    }
}
