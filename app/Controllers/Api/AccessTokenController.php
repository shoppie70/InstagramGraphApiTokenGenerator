<?php

namespace App\Controllers\Api;

use App\Emails\LogMail;
use App\Requests\GetAccessTokenRequest;
use App\UseCases\AccessTokens\GetAccessToken2Action;
use App\UseCases\AccessTokens\GetAccessToken3Action;
use App\UseCases\AccessTokens\GetAccessTokenIdAction;
use App\UseCases\AccessTokens\SortAccessToken3Action;
use App\UseCases\BusinessAccounts\GetBusinessAccountAction;
use App\UseCases\Logs\SaveLogAction;
use App\UseCases\Posts\GetInstagramPostsAction;
use DB;
use JsonException;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Throwable;

class AccessTokenController
{
    protected string $version = 'v11.0';
    protected string $host    = 'https://graph.facebook.com/';
    protected string $base_url;
    protected string $url_for_access_token2;
    protected string $access_token_id_url;
    protected string $facebook_page_name;
    protected array  $request;
    protected int    $instagram_management_id;
    protected int    $instagram_page_id;
    protected string $access_token2;
    protected string $access_token3;
    protected string $instagram_business_account;

    public function __construct()
    {
        $this->base_url              = $this->host . $this->version;
        $this->url_for_access_token2 = $this->base_url . '/oauth/access_token';
        $this->access_token_id_url   = $this->base_url . '/me';
    }

    public function store()
    {
        $access_token_request = ( new GetAccessTokenRequest($_REQUEST) );

        if ($access_token_request->validateAccessTokenRequest()) {
            $this->request = $access_token_request->getRequest();
        }

        // アクセストークン2の取得
        try {
            $this->access_token2 = ( new GetAccessToken2Action() )($this->request, $this->url_for_access_token2);
        } catch (\RuntimeException $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];

            return json($response, 400);
        }

        //　アクセストークン3を取得するために`Instagram Management ID`を取得
        try {
            $this->instagram_management_id = ( new GetAccessTokenIdAction() )($this->access_token2, $this->access_token_id_url);
        } catch (\RuntimeException $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return json($response, 400);
        }

        if (!isset($this->instagram_management_id, $this->access_token2)) {
            $response = [
                'status'  => '400',
                'message' => 'Access token2 or Instagram Management ID is invalid. / アクセストークン2もしくはInstagram Management IDが無効です。',
            ];
            return json($response, 400);
        }

        // Access Token3とInstagram Page IDの取得
        try {
            $this->facebook_page_name = $this->request[ 'facebook_page_name' ];
            $access_token3_response   = ( new GetAccessToken3Action() )($this->access_token2, $this->base_url, $this->instagram_management_id);

            // Facebookページ名を用いて、アクセストークン3を取得
            $access_token3_array = ( new SortAccessToken3Action() )($this->facebook_page_name, $access_token3_response);

            $this->instagram_page_id = $access_token3_array[ 'instagram_page_id' ];
            $this->access_token3     = $access_token3_array[ 'access_token' ];
        } catch (JsonException $e) {
            print $e->getMessage();
        }

        // Instagram Business Account　ID　の取得
        try {
            $this->instagram_business_account = ( new GetBusinessAccountAction() )($this->base_url, $this->instagram_page_id, $this->access_token3);
        } catch (\RuntimeException $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return json($response, 400);
        }

        // インスタの投稿を取得
        try {
            $posts = new GetInstagramPostsAction($this->instagram_business_account, $this->access_token3);
        } catch (\RuntimeException $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return json($response, 400);
        }

        $response = [
            'managementID'     => $this->instagram_management_id,
            'accessToken2'     => $this->access_token2,
            'accessToken3'     => $this->access_token3,
            'page_name'        => $this->facebook_page_name,
            'business_account' => $this->instagram_business_account,
            'posts'            => $posts->getPost()
        ];
        
        return json($response, 200);
    }
}
