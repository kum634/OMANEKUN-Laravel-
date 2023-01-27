# OMANEKUN-Laravel-

![omanekun-laravel](https://user-images.githubusercontent.com/90099500/215108786-06a61315-cb80-434c-9cfb-87e3b721d040.png)

## 概要

PHP単体で開発した同様のもの(https://omanekun.kum634.com/)を、ローカル環境で1からLaravelで再実装し直した後、
本番環境に移行したものになります。当初はLaravel5系で実装しAWSで運用しておりましたが、
現在は8系で実装し直し、レンタルサーバーで運用しております。


***デモ***

https://omanekun-laravel.kum634.com/


## 機能

- CSVによる依頼データの一括登録及びダウンロード機能
- ajaxの使用による依頼データの削除機能
- キーワード等で任意の条件を指定して検索し、一致したものをデータベースから取得。
- 登録されている依頼データの日付が「今週」に当てはまるもののみ、データベースから自動的に取得し表示。
- 取得した依頼データを元にワンクリックで作業指示書を作成。
- ユーザー情報管理機能（新規登録、ログイン、自動ログイン、パスワード再設定メール、退会）
- レスポンシブ対応


## 使用技術

- Laravel8系
- PHP7系
- MySQL
- jQuery
- Bootstrap4
- HTML
- CSS
- AWS(EC2、RDS) ※以前


## 推奨ブラウザ

- Google Chrome
- Safari
