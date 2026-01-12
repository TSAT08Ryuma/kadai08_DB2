<?php
$name = $_POST['name'];
$action = $_POST['action'];
$rate = $_POST['rate'];
$content = $_POST['content'];
$id = $_POST['id'];

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../config/funcs.php');
//1.  DB接続します
$pdo = trycatchDB();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE ' . DB_TABLE . ' SET name = :name, action = :action, content= :content, rate = :rate, date=NOW() where id=:id;');

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':action', $action, PDO::PARAM_STR);
$stmt->bindValue(':rate', $rate, PDO::PARAM_INT); //PARAM_INTなので注意
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: select.php');
    exit();
}