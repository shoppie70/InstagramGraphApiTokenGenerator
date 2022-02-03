<?php


namespace App\Controllers\Api;


use App\Requests\GetAccessTokenRequest;
use App\UseCases\AccessTokens\GetAccessToken2Action;
use App\UseCases\AccessTokens\GetAccessToken3Action;
use App\UseCases\AccessTokens\GetAccessTokenIdAction;
use App\UseCases\BusinessAccounts\GetBusinessAccountAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use JsonException;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class AccessTokenController
{
    protected string $version = 'v11.0';
    protected string $host    = 'https://graph.facebook.com/';
    protected string $base_url;
    protected string $url_for_access_token2;
    protected string $access_token_id_url;
    protected string $url_for_access_token3;
    protected string $facebook_page_name;
    protected array  $request;
    protected int    $instagram_management_id;
    protected int    $instagram_page_id;
    protected string $access_token2;
    protected string $access_token3;
    protected string $instagram_business_account;

    public function __construct ()
    {
        $this->base_url              = $this->host . $this->version;
        $this->url_for_access_token2 = $this->base_url . '/oauth/access_token';
        $this->access_token_id_url   = $this->base_url . '/me';
    }

    public function store ()
    {
        $this->request = ( new GetAccessTokenRequest( $_REQUEST ) )->validateGetAccessTokenRequest();

        // アクセストークン2の取得
        try {
            $this->access_token2 = ( new GetAccessToken2Action )( $this->request, $this->url_for_access_token2 );
        } catch ( \RuntimeException $e ) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];

            return json( $response, 400 );
        }

        //　アクセストークン3を取得するために`Instagram Management ID`を取得
        try {
            $this->instagram_management_id = ( new GetAccessTokenIdAction )( $this->access_token2, $this->access_token_id_url );
        } catch ( \RuntimeException $e ) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return json( $response, 400 );
        }

        if ( !isset( $this->instagram_management_id, $this->access_token2 ) ) {
            $response = [
                'status'  => '400',
                'message' => 'アクセストークン2もしくはInstagram Management IDが無効です。',
            ];
            return json( $response, 400 );
        }

        try {
            // ToDo: ここはFormRequestで対処する
            if ( !isset( $this->request[ 'page_name' ] ) ) {
                $response = [
                    'success' => false,
                    'message' => 'リンクされているFacebookページがありません。'
                ];
                return json( $response, 400 );
            }

            $this->url_for_access_token3 = $this->base_url
                . $this->instagram_management_id
                . '/accounts';

            $access_token3_response_json = Http::get( $this->url_for_access_token3, [
                'access_token' => $this->access_token2,
                'limit'        => '-1'
            ] );

            $this->facebook_page_name = $this->request[ 'page_name' ];
            $responseArray            = json_decode( $access_token3_response_json->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR );

            // Facebookページ名を用いて、アクセストークン3を取得
            $access_token3_array     = ( new GetAccessToken3Action )( $this->facebook_page_name, $responseArray );
            $this->instagram_page_id = $access_token3_array[ 'instagram_page_id' ];
            $this->access_token3     = $access_token3_array[ 'access_token' ];

        } catch ( JsonException $e ) {
            print $e->getMessage();
        }

        // Instagram Business Account
        try {
            $this->instagram_business_account = ( new GetBusinessAccountAction )( $this->base_url, $this->instagram_page_id, $this->access_token3 );
        } catch ( \RuntimeException $e ) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return json( $response, 400 );
        }

//            $log_table = new LogTable();
//            $log_table->fill(
//                [
//                    'app_id'             => $request->app_id,
//                    'app_secret'         => $request->app_secret,
//                    'management_id'      => $this->instagram_management_id,
//                    'access_token_1'     => $request->get( 'access_token_1' ),
//                    'access_token_2'     => $this->access_token2,
//                    'access_token_3'     => $this->access_token3 ?? '',
//                    'facebook_page_name' => $request->page_name,
//                    'business_account'   => $this->instagram_business_account,
//                ]
//            );
//            $log_table->save();

        $response = [
            'managementID'     => $this->instagram_management_id,
            'accessToken2'     => $this->access_token2,
            'accessToken3'     => $this->access_token3,
            'page_name'        => $this->facebook_page_name,
            'business_account' => $this->instagram_business_account,
        ];

        return response()->json( $response );
    }
}
