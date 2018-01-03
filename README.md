# ChatSampleApi

2chのような掲示板のAPIのサンプルです。

## 動作確認環境

- Apache 2.4
- PHP 7.1
- MySQL 5.7

## 利用しているライブラリ

- Symfony 3.2
- phpunit
- phake


## 環境の作成方法

以下の手順に従って動作環境を作成していきます。


### docker コンテナを起動する

プロジェクトのルートディレクトリから、``` infrastructure ```  ディレクトリに
移動し、以下のコマンドを実行してください。

```
cd infrastructure
docker-compose up -d
```

初回起動の場合、MySQLのデータを永続化させるためにデータを共有する、  
MySQLのデータ用のディレクトリを作成する必要があります。

```
mkdir mysql
```

2回目以降の起動時は、

```
docker-compose start
```

で起動できます。

### composer でのライブラリのインストール

上記の手順に従ってdockerコンテナを作成した後に、web用のコンテナにログインした後に、
composerをダウンロードし、ライブラリのインストールを行ってください。

```
## コンテナへのログイン
docker-exec -it chat-web /bin/bash

## composerのダウンロード
curl -sS https://getcomposer.org/installer | php

## ライブラリのインストール
php composer.phar install
```

``` composer install ``` でタイムアウトが発生する場合は、以下のコマンドでタイムアウトの時間を変更してください。

```
export COMPOSER_PROCESS_TIMEOUT={time}
```

### Symfony の設定ファイルの変更

app/config/parameters.yml に下記の記載を行ってください。

```
parameters:
    database_host: chat-db
    database_port: null
    database_name: chat
    database_user: chat
    database_password: chat
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: {各自設定してください。}

```

### データベースの作成

doctrineを利用して、設定ファイルから自動でデータベースを生成することができます。
コンテナにログインした後に、プロジェクトのルートディレクトリで以下のコマンドを実行してください。

```
php bin/console doctrine:schema:update --force
```
