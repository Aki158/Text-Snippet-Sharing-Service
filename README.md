# Text-Snippet-Sharing-Service

## 🌱概要
オンラインでプレーンテキストやコードスニペットを共有できるサービス

## 🏠URL
https://text-snippet-sharing-service.aki158-website.blog

## ✨デモ
### スニペット作成
![output](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/a3b56377-cfa8-47c6-8cc0-4be4c6827a1a)

## 📝説明
このサービスは、ユーザーアカウント不要でスニペットを共有できるサービスです。

基本的な機能としてスニペットの作成/閲覧/一覧表示ができます。

スニペットの作成時には、オプション(シンタックスハイライト/有効期限/スニペットの名前)を設定することができます。

有効期限が切れたスニペットは自動的に削除され閲覧できなくなります。

## 🚀使用方法
1. [URL](#URL)にアクセスする 
2. スニペットの内容をエディタに記述する
3. Optional Snippet Settings を設定する
4. Create New Snippet ボタンをクリックする

## 🙋使用例
スニペットを作成する際のイメージは[デモ](#デモ)を参考にしてください。
1. [URL](#URL)にアクセスする
2. エディターに`def main(): print("Hello world")`と記述する
3. Optional Snippet Settings から下記のように設定する
   - Syntax Highlighting : `Python`
   - Snippet Expiration : `10min`
   - Snippet Name / Title : `py_test`
4. Create New Snippet ボタンをクリックする

## 💾使用技術
<table>
<tr>
  <th>カテゴリ</th>
  <th>技術スタック</th>
</tr>
<tr>
  <td rowspan=5>フロントエンド</td>
  <td>HTML</td>
</tr>
<tr>
  <td>CSS</td>
</tr>
<tr>
  <td>JavaScript</td>
</tr>
<tr>
  <td>フレームワーク : Bootstrap</td>
</tr>
<tr>
  <td>ライブラリ(コードエディタ) : Monaco Editor</td>
</tr>
<tr>
  <td>バックエンド</td>
  <td>PHP</td>
</tr>
<tr>
  <td rowspan=4>インフラ</td>
  <td>Amazon EC2</td>
</tr>
<tr>
  <td>Nginx</td>
</tr>
<tr>
  <td>Ubuntu</td>
</tr>
<tr>
  <td>VirtualBox</td>
</tr>
<tr>
  <td>データベース</td>
  <td>MySQL</td>
</tr>
<tr>
  <td rowspan=2>デザイン</td>
  <td>Figma</td>
</tr>
<tr>
  <td>Draw.io(vscode)</td>
</tr>
<tr>
  <td rowspan=3>その他</td>
  <td>Git</td>
</tr>
<tr>
  <td>Github</td>
</tr>
<tr>
  <td>SSL/TLS証明書取得、更新、暗号化 : Certbot</td>
</tr>
</table>

## 🗄️ER図
![ER](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/f9d34ea7-cdba-4bbf-bfc3-52a9125c5b8d)

## 👀機能一覧
### ヘッダー
![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/04a2f93f-e4c0-4530-8022-c72a355a138a)

| 機能 | 内容 |
| ------- | ------- |
| New Snippet | ボタンをクリックすると、スニペット作成ページに遷移します。 |
| Public Snippets | ボタンをクリックすると、スニペット一覧ページに遷移します。 |

### スニペット作成ページ
![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/96014ea6-0ada-4229-80e9-1d7adb15ed4d)

<table>
<tr>
  <th colspan=2>機能</th>
  <th>内容</th>
</tr>
<tr>
  <td colspan=2>エラーメッセージ</td>
  <td>エディタが下記入力の場合は、Create New Snippet ボタンをクリックすると、スニペットの作成に失敗しエラーメッセージを表示します。<br>・65,535バイトを超えている<br>・空白<br>・UTF-8以外のエンコーディング</td>
</tr>
<tr>
  <td colspan=2>エディタ</td>
  <td>共有したいスニペットを記述できます。</td>
</tr>
<tr>
  <td rowspan=4>Optional Snippet Settings</td>
  <td>Syntax Highlighting :</td>
  <td>plaintextと10の主要な言語から選択できます。</td>
</tr>
<tr>
  <td>Snippet Expiration :</td>
  <td>10min、1h、1day、Never のいづれかから選択できます。</td>
</tr>
<tr>
  <td>Snippet Name / Title :</td>
  <td>シンタックスの名前を入力できます。<br>入力しない場合は、デフォルトで Untitled という名前になります。<br>入力時は、サポートしていない文字がありますので、注意してください。<br>サポートしていない文字が入力欄にある場合は、Create New Snippet ボタンをクリックすることができません。</td>
</tr>
<tr>
  <td>Create New Snippet</td>
  <td>ボタンをクリックすると、スニペットを作成できます。</td>
</tr>
</table>

### スニペットの一覧ページ

![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/89e10dbc-f2e0-479c-afd1-a500e1bfb230)

| 機能 | 内容 |
| ------- | ------- |
|  スニペットの一覧表示 | 共有されたスニペットの一覧が表示されます。<br>スニペットが作成されてから新しい順番で表示されます。<br>また、スニペット一覧ページがロードされた時に有効期限を確認しているため、有効期限が切れているスニペットは表示されません。 |
| スニペット閲覧ページへの遷移 | 一覧からユーザーが見たいスニペットをクリックして閲覧することができます。 |
| クリックしたスニペットが有効期限切れの場合の処理 | ロードされてからしばらく時間をおくと、その間にスニペットの有効期限が切れることがあります。<br>その場合は、スニペットの有効期限切れページに遷移します。 |

### スニペットの閲覧ページ

![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/d849a8d8-8900-4495-b51f-36b064b18ea9)

| 機能 | 内容 |
| ------- | ------- |
| スニペットのURL生成 | スニペット作成ページのCreate New Snippet ボタンをクリックすると、スニペット用の一意のURLが生成されます。 |
| スニペットの閲覧 | 共有されたスニペットを閲覧することができます。<br>エディタに記述されているスニペットは、スニペット作成ページで設定したシンタックスハイライトが適用されています。<br>また、閲覧のみを想定しているため、編集はできません。 |
| スニペットの有効期限の確認 | ページがロードされた際にスニペットの有効期限を確認しています。<br>もしも有効期限が切れていた場合は、スニペットの有効期限切れページへ遷移します。 |
| スニペットのコピー | Copy code　ボタンをクリックすると、スニペットを丸ごとコピーできます。 |

### スニペットの有効期限切れページ
![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/6d85c914-f294-45f5-a738-ba4e47b0e31b)

| 機能 | 内容 |
| ------- | ------- |
|  有効期限切れページの表示 | スニペット有効期限が切れた場合は、このページに遷移します。 |

## 📜作成の経緯
下記項目の理解を深めるために作成しました。
- 3 層アーキテクチャ
- データベースのセットアップ
- envのセットアップ
- バックエンド言語を用いたデータベースの操作
- クエリのセキュリティ
- URLルーティング
- サーバサイドレンダリング

## ⭐️こだわった点
### マイグレーションベースのスキーマ管理

| 項目 | 内容 |
| ------- | ------- |
|  概要 | マイグレーションベースのスキーマ管理は、バージョン管理された小規模な変更を段階的に適用してデータベーススキーマを時間とともに管理・進化させる方法です。<br>この方法によりシステムに小さな変更を加え、それを実行またはロールバックする手段を提供できます。 |
| スクリプトの生成 | CLIで下記コマンドを実行すると、スクリプトを生成することができます。<br>`php console code-gen migration --name {FILENAME}`<br>スクリプトはマイグレーションインターフェースに準拠しており、up関数とdown関数で構成されています。<br>下記フォーマットのスクリプトが `Database\Migrations` の配下に生成されます。<br> `{YYYY-MM-DD}_{UNIX_TIMESTAMP}_{FILENAME}.php`|
| 実行 | スクリプトを実行する際は、スキーママイグレーションを行うためのマイグレーションコマンドが用意されていてアップグレード(up)またはロールバック(down)を行うことができます。<br>また、CLIで下記コマンドを実行すると、テーブルが初期化されます。<br>`php console migrate --init` |

### データの投入(シーディング)

| 項目 | 内容 |
| ------- | ------- |
|  スクリプトの生成 | CLIで下記コマンドを実行すると、スクリプトを生成することができます。<br>`php console code-gen seeder --name {FILENAME}`<br>スクリプトは、シーダーシステムに準拠しており、tableName、tableColumns、createRowData()で構成されています。<br>下記フォーマットのスクリプトが `Database\Seeds` の配下に生成されます。|
| 実行 | シードコマンドを実行すると、スクリプトで定義した通りにデータベースにデータが挿入されます。<br>ユーザーが [使用方法](#使用方法) を実施すると、実行されるような処理にしています。 |

### MVCモデル
HTMLRendererは、MVCモデルのアプローチを採用しています。

モデル、ビュー、コントローラが分離され、 Routing\routes.php 内の匿名関数型のコントローラが Renderer クラスのインスタンスを作成して返す役割を果たします。

コントローラは、OOP クラスやデータベーススキーマにマッピングされたデータなどのモデルを使ってデータを準備し、このデータをビューに渡してコンテンツを作成します。

### スニペットのアップロード
ユーザーが[使用方法](#使用方法) を実施すると、スニペット用の一意のURL(※1)が生成されるような処理にしています。  

unique-stringの部分にはhash関数を活用しランダムな文字列を生成しました。

URLのパースには、parse_url関数を活用し`{path}/{unique-string}`のみを取得しています。

※1. フォーマット : `https://{domain}/{path}/{unique-string}`

### 入力値のチェック
入力値は厳格に検証とサニタイズを行っています。

ここでの入力値とは、[使用方法](#使用方法) に従いユーザーが設定したものです。

不適切な入力値があればエラーメッセージを出力するようにしています。

### SQLインジェクションの対策
インジェクションを防ぐ方法として、プリペアドステートメントを利用してデータを取得しています。

具体的には、PHPのmysqliクラスが提供している下記3つの関数を使用しています。

| 関数 | 内容 |
| ------- | ------- |
|  prepare() | 実行するためのSQL文を準備します。<br> ここでは、実際のデータの代わりにプレースホルダを使用しています。|
| bind_param() | プリペアドステートメントのパラメータに変数をバインドします。 |
| execute() | プリペアドステートメントを実行します。 |

### エラーハンドリング
不適切な入力(大量のテキストやコード、またはサポートされていない文字)が送信された場合に、エラーメッセージを表示します。

具体的な不適切な入力の条件は、[スニペット作成ページ](#スニペット作成ページ) の「機能 : エラーメッセージ」に記載していますので確認ください。

## 📮今後の実装したいもの
- [ ] ログイン機能
- [ ] ログインしたユーザーが作成したスニペットを一覧で見れる機能
- [ ] シンタックスハイライトの選択肢を増やす
- [ ] 有効期限の選択肢を増やす
- [ ] レスポンシブデザイン

## 📑参考文献
### 公式ドキュメント
- [Monaco Editor](https://microsoft.github.io/monaco-editor/)
- [Bootstrap](https://getbootstrap.jp/)
- [PHPマニュアル](https://www.php.net/manual/ja/index.php#index)
- [MySQL](https://dev.mysql.com/doc/refman/8.0/en/innodb-online-ddl-operations.html)

### 参考にしたサイト
- [Pastebin](https://pastebin.com/)
