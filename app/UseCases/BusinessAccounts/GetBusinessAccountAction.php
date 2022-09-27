<?php

namespace App\UseCases\BusinessAccounts;

use GuzzleHttp\Client;
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

    public function __invoke()
    {
        $client = new Client();
        $business_account_id_response = $client->request('GET', $this->target_url, ['query' => $this->query]);

        $this->result = json_decode($business_account_id_response->getBody()->getContents(), true);

        if (isset($this->result['error'])) {
            throw new RuntimeException($this->result['error']['message'] ?? 'The access token may be wrong. / アクセストークンが間違っている可能性があります。');
        }

        // if(isset($this->result['id'])) {
        //     return $this->result['id'];
        // }

        if (!isset($this->result['instagram_business_account']['id'])) {
            throw new RuntimeException('Instagram is not a business account. / インスタグラムがプロアカウント（ビジネス）になっていないか、Facebookページとインスタグラムのアカウントが正常にリンクされていません。再度、手順を確認してみてください。');
        }

        return $this->result['instagram_business_account']['id'];
    }
}
