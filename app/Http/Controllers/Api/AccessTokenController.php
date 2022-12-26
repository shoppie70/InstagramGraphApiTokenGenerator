<?php

namespace App\Http\Controllers\Api;

use App\Emails\LogMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetAccessTokenRequest;
use App\UseCases\AccessTokens\GetAccessToken2Action;
use App\UseCases\AccessTokens\GetAccessToken3Action;
use App\UseCases\AccessTokens\GetAccessTokenIdAction;
use App\UseCases\AccessTokens\SortAccessToken3Action;
use App\UseCases\BusinessAccounts\GetBusinessAccountAction;
use App\UseCases\Logs\SaveLogAction;
use App\UseCases\Posts\GetInstagramPostsAction;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use RuntimeException;

class AccessTokenController extends Controller
{
    protected string $version;
    protected string $host;
    protected string $base_url;
    protected string $url_for_access_token2;
    protected string $access_token_id_url;
    protected string $facebook_page_name;
    protected array $request;
    protected int $instagram_management_id;
    protected int $instagram_page_id;
    protected string $access_token2;
    protected string $access_token3;
    protected string $instagram_business_account;

    public function __construct()
    {
        $this->version = 'v13.0';
        $this->host = 'https://graph.facebook.com/';
        $this->base_url = $this->host . $this->version;
        $this->url_for_access_token2 = $this->base_url . '/oauth/access_token';
        $this->access_token_id_url = $this->base_url . '/me';
    }

    public function store(GetAccessTokenRequest $request): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();

        $this->facebook_page_name = $request->get('facebook_page_name');

        try {
            // アクセストークン2の取得
            $this->access_token2 = (new GetAccessToken2Action($request))($this->url_for_access_token2);

            //　アクセストークン3を取得するために`Instagram Management ID`を取得
            $this->instagram_management_id = (new GetAccessTokenIdAction($this->access_token2))($this->access_token_id_url);

            if (!isset($this->instagram_management_id, $this->access_token2)) {
                throw new RuntimeException(Lang::get('validation.invalid_token2'));
            }

            $access_token3_response = (new GetAccessToken3Action($this->access_token2, $this->base_url, $this->instagram_management_id))();

            // Facebookページ名を用いて、アクセストークン3を取得
            $access_token3_array = (new SortAccessToken3Action())($this->facebook_page_name, $access_token3_response);

            $this->instagram_page_id = $access_token3_array['instagram_page_id'];
            $this->access_token3 = $access_token3_array['access_token'];

            // Instagram Business Account　ID　の取得
            $this->instagram_business_account = (new GetBusinessAccountAction($this->base_url, $this->instagram_page_id, $this->access_token3))();

            // ログを保存するオプション
            (new SaveLogAction)($request, $this->instagram_management_id, $this->access_token2, $this->access_token3, $this->instagram_business_account);

            DB::commit();
        } catch (RuntimeException|GuzzleException|\JsonException $e) {
            DB::rollback();
            report($e);

            $this->error_mail($e->getMessage(), $request->all());

            return response()->json([
                'status' => 401,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }

        try {
            // インスタの投稿を取得
            $posts = (new GetInstagramPostsAction())($this->instagram_business_account, $this->access_token3);

        } catch (\Exception $e) {
            DB::rollback();
            report($e);

            $this->error_mail($e->getMessage(), $request->all());

            return response()->json([
                'status' => 401,
                'code' => $e->getCode(),
                'message' => Lang::get('validation.instagram_posts_error')
            ]);
        }

        try {
            Mail::send(new LogMail([
                'access_token1' => $request->get('access_token1'),
                'app_id' => $request->get('app_id'),
                'app_secret' => $request->get('app_secret'),
                'facebook_page_name' => $this->facebook_page_name,
                'access_token3' => $this->access_token3,
                'business_account_id' => $this->instagram_business_account,
                'posts' => $posts
            ]));
        } catch (\Exception $e) {
            DB::rollback();
            report($e);

            $this->error_mail($e->getMessage(), $request->all());

            return response()->json([
                'status' => 401,
                'code' => $e->getCode(),
                'message' => Lang::get('validation.communication_error')
            ]);
        }

        return response()->json([
            'status' => 200,
            'accessToken3' => $this->access_token3,
            'business_account' => $this->instagram_business_account,
            'posts' => $posts
        ]);
    }
}
