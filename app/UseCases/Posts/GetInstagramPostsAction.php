<?php

namespace App\UseCases\Posts;

use JsonException;

class GetInstagramPostsAction
{
    protected array  $posts           = [];
    protected string $version         = 'v11.0';
    protected int    $instaMediaLimit = 12;
    protected int    $instaBusinessAccount;
    protected string $instaAccessToken;
    protected string $baseUrl;

    public function __construct ( int $businessAccount, string $accessToken )
    {
        $this->instaBusinessAccount = $businessAccount;
        $this->instaAccessToken     = $accessToken;

        $query = [
            'fields'       => "name,media.limit({$this->instaMediaLimit}){media_url,thumbnail_url}",
            'access_token' => $this->instaAccessToken,
        ];

        $this->baseUrl = 'https://graph.facebook.com/'
            . $this->version . '/'
            . $this->instaBusinessAccount
            . '?' . http_build_query( $query );
    }

    public function getPost (): array
    {
        $response_json = mb_convert_encoding( @file_get_contents( $this->baseUrl ), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN' );
        $object        = json_decode( $response_json, true, 512, JSON_THROW_ON_ERROR );

        if ( isset( $object[ 'media' ][ 'data' ] ) ) {
            foreach ( $object[ 'media' ][ 'data' ] as $data ) {
                $this->posts[] = [
                    'img' => $data[ 'thumbnail_url' ] ?? $data[ 'media_url' ],
                ];
            }
        }
        return $this->posts;
    }
}