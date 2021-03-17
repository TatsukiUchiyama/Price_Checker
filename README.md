# Price_Checker
PHP自作

# 概要
購入した商品を登録しその値段をみんなで共有するアプリケーション


# 制作背景(意図)
日頃購入している商品が割高なのか割安なのか。
どこのお店で購入すればお得に買い物をすることができるのか。
そう言ったことは自分の経験上でしか判断することができませんでした。
このアプリケーションはそんな経験をみんなで蓄積しみんなで共有したいという目的で作成しました。

# 使い方
ログインをしなくてもほかのユーザーが登録した情報だけは閲覧することができますが、まずはログインをしましょう！
右上の箇所からログインすることができます。

ログインに成功したら次は買い物をするお店を登録します。
右上のユーザー名の箇所をプルダウンして店舗の情報を登録できます。

店舗を登録できたらその店舗で購入した商品をどんどん入力してデータを蓄積させましょう。
トップページで登録された情報の一覧を見ることができます。
一覧は調べたい商品の名前や調べたい場所の住所を入れることで絞り込むことができます。


# 使用技術（開発環境）
## バックエンド
PHP

## フロントエンド
HTML, css, JavaScript, JQuery, Ajax

## データベース
MySQL,phpMyAdmin

## Webサーバ
apache

## アプリケーションサーバ
apache

## ソース管理
GitHub

## エディタ
Atom




# Price Checker DB設計


## usersテーブル
|Column     |Type  |Options                 |
|-----------|------|------------------------|
|name       |string|null: false             |
|email      |string|null: false,unique: true|
|password   |string|null: false             |

### Association
- has_many :items
- has_many :shops

## shopsテーブル
|Column           |Type  |Options                       |
|-----------------|------|------------------------------|
|name             |string|null: false                   |
|branch_name      |string|                              |
|prefecture_id    |int   |                              |
|city             |string|                              |
|block_number     |string|                              |
|user_id          |int   |null: false, foreign_key: true|
|collapse         |int   |null: false                   |

### Association
- has_many :items
- belongs_to :user

## itemsテーブル
|Column          |Type    |Options                       |
|----------------|--------|------------------------------|
|name            |string  |null: false                   |
|kana            |string  |null: false                   |
|item_name       |string  |                              |
|price           |int     |null: false                   |
|comment         |text    |                              |
|user_id         |int     |null: false, foreign_key: true|
|shop_id         |int     |null: false, foreign_key: true|
|purchase_date   |datetime|null: false                   |

### Association
- belongs_to :user
- belongs_to :user


## reset_passwordテーブル
|Column     |Type     |Options                   |
|-----------|---------|--------------------------|
|token      |string   |null: false               |
|email      |string   |null: false               |
|created_at |timestamp|default: CURRENT_TIMESTAMP|



