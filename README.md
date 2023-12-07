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
イメージは[デモ](#デモ)を参考にしてください。
1. [URL](#URL)にアクセスする
2. エディターに「def main(): print("Hello world")」と記述する
3. Optional Snippet Settings から下記のように設定する
   - Syntax Highlighting : Python
   - Snippet Expiration : 10min
   - Snippet Name / Title : py_test
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
- ヘッダー
<table>
<tr>
  <th colspan=2>機能</th>
  <th>内容</th>
</tr>
<tr>
  <td colspan=2>New Snippet</td>
  <td>ボタンをクリックするとスニペット作成ページに遷移します。</td>
</tr>
<tr>
  <td colspan=2>Public Snippets</td>
  <td>ボタンをクリックするとスニペット一覧ページに遷移します。</td>
</tr>
</table>

- スニペット作成ページ
![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/96014ea6-0ada-4229-80e9-1d7adb15ed4d)

<table>
<tr>
  <th colspan=2>機能</th>
  <th>内容</th>
</tr>
<tr>
  <td colspan=2>エラーメッセージ</td>
  <td>エディタが下記入力の場合は、Create New Snippet ボタンをクリックするとスニペットの作成に失敗しエラーメッセージを表示します。<br>・65,535バイトを超えている<br>・空白<br>・UTF-8以外のエンコーディング</td>
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
  <td>ボタンをクリックするとスニペットを作成できます。</td>
</tr>
</table>

- スニペットの一覧ページ

![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/89e10dbc-f2e0-479c-afd1-a500e1bfb230)

<table>
<tr>
  <th>機能</th>
  <th>内容</th>
</tr>
<tr>
  <td>スニペットの一覧表示</td>
  <td>共有されたスニペットの一覧が表示されます。<br>スニペットが作成されてから新しい順番で表示されます。<br>また、スニペット一覧ページがロードされた時に有効期限を確認しているため、有効期限が切れているスニペットは表示されません。</td>
</tr>
<tr>
  <td>スニペット閲覧ページへの遷移</td>
  <td>一覧からユーザーが見たいスニペットをクリックして閲覧することができます。</td>
</tr>
<tr>
  <td>クリックしたスニペットが有効期限切れの場合の処理</td>
  <td>ロードされてからしばらく時間をおくと、その間にスニペットの有効期限が切れることがあります。<br>その場合は、スニペットの有効期限切れページに遷移します。</td>
</tr>
</table>

- スニペットの閲覧ページ

![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/d849a8d8-8900-4495-b51f-36b064b18ea9)

<table>
<tr>
  <th>機能</th>
  <th>内容</th>
</tr>
<tr>
  <td>スニペットの閲覧</td>
  <td>共有されたスニペットを閲覧することができます。<br>エディタに記述されているスニペットは、スニペット作成ページで設定したシンタックスハイライトが適用されています。<br>また、閲覧のみを想定しているため、編集はできません。</td>
</tr>
<tr>
  <td>スニペットの有効期限の確認</td>
  <td>ページがロードされた際にスニペットの有効期限を確認しています。<br>もしも有効期限が切れていた場合は、スニペットの有効期限切れページへ遷移します。</td>
</tr>
<tr>
  <td>スニペットのコピー</td>
  <td>Copy code　ボタンをクリックするとスニペットを丸ごとコピーできます。</td>
</tr>
</table>

## ⭐️こだわった点
テキストや参考にした記事などを再度読み返して技術の理解を深めてから書く。

ここがエンジニアに一番読んでもらいたい箇所なのでできるだけ詳細に書く。

## 📮今後の実装したいもの
- ログイン機能
- シンタックスハイライトの選択肢を増やす
- レスポンシブデザイン



