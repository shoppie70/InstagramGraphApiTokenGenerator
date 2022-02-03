<?php

namespace App\UseCases\BusinessAccounts;

use Illuminate\Support\Facades\Http;

class GetBusinessAccountAction
{
    public function __invoke ( string $base_url, int $page_id, string $access_token )
    {
        $businessAccountIdResponse = Http::get( $base_url . '/' . $page_id, [
            'fields'       => 'instagram_business_account',
            'access_token' => $access_token
        ] );

        try {
            $result = json_decode( $businessAccountIdResponse->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR );
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