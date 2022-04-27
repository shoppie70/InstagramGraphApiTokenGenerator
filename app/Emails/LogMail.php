<?php

namespace App\Emails;

class LogMail extends Mail
{
    public function __construct(array $response)
    {
        $body = "
            <h1 style='font-size: 1.3rem;'>アカウント情報</h1>
            <dl style='display: flex; margin-bottom: 0.5rem'>
                <dt style='margin:0; min-width: 200px'>
                    Facebook Page Name
                </dt>
                <dd style='margin:0'>
                    {$response['page_name']}
                </dd>
            </dl>
            <dl style='display: flex; margin-bottom: 0.5rem'>
                <dt style='margin:0; min-width: 200px'>
                    Instagram Business Account
                </dt>
                <dd style='margin:0'>
                    {$response['business_account']}
                </dd>
            </dl>
            <dl style='display: flex; margin-bottom: 0.5rem'>
                <dt style='margin:0; min-width: 200px'>
                    Instagram Management ID
                </dt>
                <dd style='margin:0'>
                    {$response['managementID']}
                </dd>
            </dl>
        ";

        $body .= "
        <h1 style='font-size: 1.3rem'>投稿データ</h1>
        <div>";

        foreach ($response['posts'] as $post) {
            $body .= "
                <img src='{$post['img']}' style='max-width: 200px; margin-bottom: 1rem'>
            ";
        }

        $body .= "</div>";

        $this->send($body);
    }
}
