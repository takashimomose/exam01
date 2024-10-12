# プロジェクトのセットアップ手順
以下の手順に従って、Laravelアプリケーションのセットアップを行ってください。

## 1. インストールディレクトリへの移動
まず、プロジェクトをインストールするディレクトリに移動します。

```bash
$ cd coachtech/laravel
```

## 2. リポジトリのクローン
次に、リポジトリをクローンします。

```bash
$ git clone git@github.com:takashimomose/exam01.git
```

## 3. Dockerコンテナの作成
クローンしたプロジェクトディレクトリへ移動し、Dockerコンテナをビルドおよび起動します。

```bash
$ cd exam01
$ docker-compose up -d --build
```

## 4. PHPコンテナへのアクセス
PHPコンテナに入るには、以下のコマンドを実行します。

```bash
$ docker-compose exec php bash
```

## 5. Composerのインストール
コンテナ内でComposerの依存関係をインストールします。

```bash
$ composer install
```

## 6. .envファイルの編集
.envファイルを編集し、データベース接続情報を以下のように設定してください。

```bash
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

## 7. パーミッションの設定
もしアプリケーションにアクセスできない場合、以下のコマンドを実行してパーミッションを修正してください。

```bash
$ sudo chmod -R 777 src/*
```

## 8. データベースの確認
docker-compose.ymlで設定したphpMyAdminにアクセスし、データベースが存在しているかを確認します。

phpMyAdmin URL: http://localhost:8080/

## 9. アプリケーションへのアクセス
アプリケーションにアクセスするには、以下のURLにアクセスします。

アプリケーション URL: http://localhost/
アクセス時に「Permission denied」というエラーが発生した場合は、再度以下のコマンドを実行してパーミッションを修正してください。

```bash
$ sudo chmod -R 777 src/*
```

## 10. アプリケーションキーの生成
もしアプリケーションキーが生成・設定されていない場合は、以下のコマンドを実行してキーを生成してください。

```bash
$ php artisan key:generate
```

## 11. 動作確認
最後に、ブラウザで以下にアクセスし、お問い合わせ入力フォーム画面が正しく表示されていることを確認してください。
http://localhost/

以上でセットアップは完了です。