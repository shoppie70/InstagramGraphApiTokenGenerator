<?php

namespace App\Emails;

class LogMail extends Mail
{
    public function __construct(array $response)
    {
//        ToDo: とりあえずのHTMLなのでちゃんとしたものに書き直す
        $body = "
            <h1>アカウント情報</h1>
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
        <h1>投稿データ</h1>
        <ul style='list-style:none; display:flex; flex-wrap:wrap;'>";

        foreach ($response['posts'] as $post) {
            $body .= "
                <li style='max-width:calc(100% / 4 - 1rem); margin: 0.5rem; width: 100%;'>
                    <div style='background-image: url({$post['img']}); background-size: cover; background-repeat:no-repeat; background-position: center; padding-top: 100%;'></div>
                </li>
            ";
        }

        $body .= "</ul>";

        $this->send($body);
    }
}
