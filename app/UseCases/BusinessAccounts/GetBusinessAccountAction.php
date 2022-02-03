<?php

namespace App\UseCases\BusinessAccounts;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class GetBusinessAccountAction
{
    public function __invoke ( string $base_url, int $page_id, string $access_token )
    {
        $query = [
            'fields'       => 'instagram_business_account',
            'access_token' => $access_token
        ];

        $target_url = $base_url . '/' . $page_id;

        try {
            $client                       = new Client();
            $business_account_id_response = $client->request( 'GET', $target_url, [ 'query' => $query ] );

            $result = json_decode( $business_account_id_response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR );
        } catch
        ( \JsonException $e ) {
            print $e->getMessage();
        }

        if ( isset( $result[ 'error' ] ) ) {
            throw new \RuntimeException( $result[ 'error' ][ 'message' ] ?? 'アクセストークンが間違っている可能性があります。' );
        }

        if ( !isset( $result[ 'instagram_business_account' ][ 'id' ] ) ) {
            throw new \RuntimeException( 'インスタグラムがビジネスアカウントになっていません。' );
        }

        return $result[ 'instagram_business_account' ][ 'id' ];
    }
}