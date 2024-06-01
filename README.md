# Dockerを用いたLAMP環境

## ポートの設定

BurpやZAPを使用する場合は、バッテイングするおそれがあるため、適宜設定変更する。

## Apacheの設定ファイル

Apacheの設定ファイル各種を/web/apache_config配下に配置してある。
デフォルトではマウントの記載はコメントアウトしてある。
以下の手順でマウントすることで、設定変更を容易に行えるようになる。

1. デフォルト状態でdocker compose up -dを実行しコンテナを起動
2. 一旦、docker compose stopでコンテナを停止
1. docker-compose.ymlから下記の記述をコメントイン
    ./web/apache_config/apache2:/etc/apache2 #Apache設定ファイル
2. コンテナ再度起動する

## Apacheの設定ファイルをローカルにコピーする手順

すでにローカルにデフォルトの設定ファイルを配置しているが、起動したコンテナより設定ファイルを入手する必要がある場合の手順

1. docker compose up -dを実行しコンテナを起動
2. 下記コマンドでコンテナのデフォルト設定をローカルにコピー、コンテナは停止する
    以下の例は、コピー先のデレクトリは/web/apache_configへ指定している
    コンテナIDは都度、意図したものを取得すること
    docker cp {コンテナID}:/etc/apache2 ./
