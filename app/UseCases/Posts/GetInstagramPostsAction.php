<?php

namespace App\UseCases\Posts;

class GetInstagramPostsAction
{
    protected array  $posts                 = [];
    protected string $version               = 'v11.0';
    protected int    $instagram_media_limit = 12;
    protected int    $instagram_business_account;
    protected string $instagram_access_token;
    protected string $baseUrl;

    public function __construct(int $businessAccount, string $accessToken)
    {
        $this->instagram_business_account = $businessAccount;
        $this->instagram_access_token     = $accessToken;

        $query = [
            'fields'       => "name,media.limit({$this->instagram_media_limit}){media_url,thumbnail_url}",
            'access_token' => $this->instagram_access_token,
        ];

        $this->baseUrl = 'https://graph.facebook.com/'
            . $this->version . '/'
            . $this->instagram_business_account
            . '?' . http_build_query($query);
    }

    public function getPost(): array
    {
        $response_json = mb_convert_encoding(@file_get_contents($this->baseUrl), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $object        = json_decode($response_json, true, 512, JSON_THROW_ON_ERROR);

        if (isset($object[ 'media' ][ 'data' ])) {
            foreach ($object[ 'media' ][ 'data' ] as $data) {
                $this->posts[] = [
                    'img' => $data[ 'thumbnail_url' ] ?? $data[ 'media_url' ],
                ];
            }
        }
        return $this->posts;
    }
}
