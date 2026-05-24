# Instagram Graph API Token Generator

## 概要 (Overview)
Instagram Graph APIの「無期限アクセストークン（Token 3）」および「Instagram Business Account ID」を自動で取得するためのWebアプリケーションです。

InstagramのAPIを利用するためには、複数の段階を踏んで手動でトークンを取得・交換する必要がありますが、このツールを使えば、以下の4つの情報を入力するだけで最終的に必要なデータが全て自動的に取得できます。

- `App ID`
- `App Secret`
- `Access Token 1` (短期アクセストークン)
- `Facebook Page Name` (連携しているFacebookページ名)

多言語対応（日本語・英語）が組み込まれており、マニュアルも完備されています。

## デプロイ先 (Deployment)
https://instagram.salvador79.dev/
※ 近日中に [instagram.sho-tsukamoto.jp](https://instagram.sho-tsukamoto.jp/) へ移行予定です。

## 開発の背景 (Background)
Instagram Graph APIのトークン生成プロセスは非常に煩雑です。この面倒な作業を自動化し、手軽にアクセストークンを取得できるようにすること、そして個人的な `PHP` と `英語` の学習を目的として開発されました。

## システム構造 (System Architecture)
本システムは Laravel 12 をベースに構築されており、入力された情報をもとに Meta Graph API と複数回の通信を行い、最終的な無期限トークンを取得します。処理の主なフローは以下の通りです。

1. **Token 2 (長期トークン) の取得**
   - ユーザーから送信された `Access Token 1` を利用し、有効期限が約60日間の `Access Token 2` を取得します (`GetAccessToken2Action`)。
2. **アカウント管理IDの取得**
   - 取得した Token 2 を用いて、ユーザーの管理権限（Instagram Management ID）を取得します (`GetAccessTokenIdAction`)。
3. **Token 3 (無期限トークン) の取得**
   - 管理IDと Token 2 を使用して、ユーザーが管理するページのアクセストークン一覧を取得します (`GetAccessToken3Action`)。
   - 入力された `Facebook Page Name` と合致するページを抽出し、対応する無期限の `Access Token 3` とページIDを取得します (`SortAccessToken3Action`)。
4. **Instagram Business Account ID の取得**
   - 取得したページIDと Token 3 を用いて、連携されている Instagram ビジネスアカウントのIDを取得します (`GetBusinessAccountAction`)。
5. **最終検証と通知**
   - 取得したトークンを使って実際のInstagramの投稿データが取得できるかを検証します (`GetInstagramPostsAction`)。
   - 処理のログをデータベースに保存し、取得したトークン情報などを管理者にメールで通知します。
   - 最後に、画面上に `Access Token 3` と `Business Account ID` を返却して表示します。

## 主な機能 (Features)
- **トークンの自動交換**: 短期トークンから長寿命トークン、そして無期限アクセストークン（Token 3）への交換を自動で処理。
- **アカウントIDの取得**: 指定したFacebookページに関連付けられたInstagramビジネスアカウントIDの自動取得。
- **多言語対応 (i18n)**: 日本語 (`/ja`) と英語 (デフォルト) のルーティングによるUIおよびマニュアルページの提供。
- **モダンな基盤**: Laravel 12 をベースにした堅牢なAPI通信とバックエンド処理。

## 使用技術 (Tech Stack)
- **Backend**: PHP 8.2+, Laravel 12.x
- **Frontend**: Blade Templates, HTML/CSS/JavaScript
- **Environment**: Docker (Laravel Sail)

## 使い方 (Usage)
1. ご自身のInstagramアカウントを「プロアカウント（ビジネス）」に切り替えます。
2. InstagramアカウントとFacebookページを連携（リンク）させます。
3. [Facebook for Developers](https://developers.facebook.com/) にアクセスしてアプリを作成します。
4. アプリのダッシュボードから `App ID`, `App Secret`, `Access Token 1` (短期トークン) を取得します。
5. 本ツールのフォームに取得した情報を入力して送信します。
6. 無期限の `Access Token 3` と `Instagram Business Account ID` が自動的に画面に表示されます。
7. 取得したトークンとIDを使用して、ご自身のWebサイトなどにInstagramのフィード表示機能などを自由に組み込んでください。

## 開発環境の構築 (Local Setup)

本プロジェクトは Laravel Sail を利用して簡単にローカルのDockerコンテナ環境を構築できます。

```bash
# リポジトリのクローン
git clone https://github.com/shoppie70/InstagramGraphApiTokenGenerator.git
cd InstagramGraphApiTokenGenerator

# パッケージのインストール
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# 環境変数の設定
cp .env.example .env

# Sail (Dockerコンテナ) の起動
./vendor/bin/sail up -d

# アプリケーションキーの生成
./vendor/bin/sail artisan key:generate

# （必要であれば）フロントエンドのアセットビルド
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

起動後、ブラウザで `http://localhost` にアクセスして動作を確認できます。

## ライセンス (License)
本プロジェクトは [MIT License](https://en.wikipedia.org/wiki/MIT_License) のもとで公開されています。

## 開発者 (Author)
**Sho Tsukamoto（塚本 翔）**
- [株式会社ハジメクリエイト](https://hajimecreate.com/)
- ~~[ウェブティ株式会社](https://webty.jp/staffblog/author/tsukamoto/)~~
