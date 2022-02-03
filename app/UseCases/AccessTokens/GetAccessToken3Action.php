<?php

namespace App\UseCases\AccessTokens;

class GetAccessToken3Action
{
    protected array $access_token3_array = [];

    public function __invoke ( $page_name, $response_array ): array
    {
        // Facebookページ名を用いて、アクセストークン3を取得
        foreach ( $response_array as $array ) {
            foreach ( $array as $data ) {
                if ( isset( $data[ 'name' ] ) && $data[ 'name' ] === $page_name ) {
                    $this->access_token3_array[] = [
                        'access_token'     => $data[ 'access_token' ],
                        'instagram_page_id' => $data[ 'id' ]
                    ];
                }
            }
        }

        return $this->access_token3_array;
    }
}