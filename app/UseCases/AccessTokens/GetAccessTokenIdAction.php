<?php

namespace App\UseCases\AccessTokens;

use GuzzleHttp\Client;
use JsonException;

class GetAccessTokenIdAction
{
    public function __invoke ( string $access_token2, string $access_token_id_uri )
    {
        $query = [
            'access_token' => $access_token2,
        ];

        try {
            $client                = new Client();
            $accessTokenIdResponse = $client->request( 'GET', $access_token_id_uri, [ 'query' => $query ] );

            $result = json_decode( $accessTokenIdResponse->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR );
        } catch ( JsonException $e ) {
            return $e->getMessage();
        }


        if ( isset( $result[ 'error' ] ) ) {
            throw new \RuntimeException( $result[ 'error' ][ 'message' ] ?? 'アクセストークン2が有効期限切れ もしくは 間違っています。' );
        }

        return $result[ 'id' ] ?? null;
    }
}