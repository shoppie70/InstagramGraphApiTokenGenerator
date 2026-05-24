<?php

return [
    'description' => 'ご自身でデータを貼り付け、送信ボタンを押してください。<br>
        <strong>Instagram Graph API のレスポンス</strong>を確認できるため、詳細なエラーに対応できます。<br>
        JSONを見やすくするために、<span class="label">Firefox Developer Edition</span> をインストールするか、Chrome拡張機能 <span class="label">JsonVue</span> を導入することをお勧めします。',
    'back_to_auto' => '自動取得ツールへ',
    'step1_title' => '1. アクセストークン 2 の取得',
    'step1_desc' => '<a class="underline" href="https://developers.facebook.com" target="_blank" rel="noopener">https://developers.facebook.com</a> で取得した情報をもとに、以下のフォームに入力してください。',
    'step1_label_token1' => 'アクセス トークン 1',
    'step1_label_app_id' => 'App ID',
    'step1_label_app_secret' => 'App Secret',
    'step1_copy_hint' => '“access_token”: “xxxx” の部分をコピーしてください。これが <span class="label">アクセス トークン 2</span> です。',
    'step1_btn' => 'レスポンスページを開く',
    
    'step2_title' => '2. Instagram管理IDの取得',
    'step2_desc' => '<span class="label">アクセス トークン 2</span> を使用して、<span class="label">Instagram管理ID</span> を取得します。',
    'step2_label_token2' => 'アクセス トークン 2',
    'step2_btn' => 'レスポンスページを開く',
    
    'step3_title' => '3. アクセストークン 3 の取得',
    'step3_desc' => '<span class="label">アクセス トークン 2</span> と <span class="label">Instagram管理ID</span> を使用して、<span class="label">アクセス トークン 3</span> と <span class="label">InstagramページID</span> を取得します。',
    'step3_label_token2' => 'アクセス トークン 2',
    'step3_label_mgmt_id' => 'Instagram管理ID',
    'step3_copy_hint' => '<span class="label">アクセス トークン 3</span> と <span class="label">InstagramページID</span> をコピーしてください。<br>以下はレスポンスのサンプルです。',
    'step3_btn' => 'レスポンスページを開く',
    
    'step4_title' => '4. InstagramビジネスアカウントIDの取得',
    'step4_label_token3' => 'アクセス トークン 3',
    'step4_label_page_id' => 'InstagramページID',
    'step4_copy_hint' => '“instagram_business_account”: “xxxx” の部分をコピーしてください。これが <span class="label">Instagram ビジネス アカウント ID</span> です。',
    'step4_desc' => '<span class="label">アクセス トークン 3</span> と <span class="label">Instagram ビジネス アカウント ID</span> を使用して、ホームページにInstagramの投稿を埋め込むことができます。',
    'step4_btn' => 'レスポンスページを開く',
];
