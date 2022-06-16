<?php

namespace App\Emails;

use RuntimeException;

class ErrorLogMail extends Mail
{
    public function __construct(RuntimeException $e, $access_token_request)
    {
        $body = "
            <h1 style='font-size: 1.3rem;'>Error Information</h1>
            <dl style='display: flex; margin-bottom: 0.5rem'>
                <dt style='margin:0; min-width: 200px'>
                    エラーメッセージ
                </dt>
                <dd style='margin:0'>
                    {$e->getMessage()}
                </dd>
            </dl>
            <dl style='display: flex; margin-bottom: 0.5rem'>
                <dt style='margin:0; min-width: 200px'>
                    アクセストークン1
                </dt>
                <dd style='margin:0'>
                    {$access_token_request['access_token1']}
                </dd>
            </dl>
            <dl style='display: flex; margin-bottom: 0.5rem'>
                <dt style='margin:0; min-width: 200px'>
                    app_id
                </dt>
                <dd style='margin:0'>
                    {$access_token_request['app_id']}
                </dd>
            </dl>
            <dl style='display: flex; margin-bottom: 0.5rem'>
                <dt style='margin:0; min-width: 200px'>
                    app_secret
                </dt>
                <dd style='margin:0'>
                    {$access_token_request['app_secret']}
                </dd>
            </dl>
            <dl style='display: flex; margin-bottom: 0.5rem'>
                <dt style='margin:0; min-width: 200px'>
                    facebook_page_name
                </dt>
                <dd style='margin:0'>
                    {$access_token_request['facebook_page_name']}
                </dd>
            </dl>";

        $this->send('トークン取得ツールでエラーが発生しました。', $body);
    }
}
