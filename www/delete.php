<?php
$id = $_GET['id'];

//  データを取得する
require_once(__DIR__ . '/../config/funcs.php');
require_once(__DIR__ . '/../config/db.php');
$pdo = trycatchDB();

//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM ' . DB_TABLE . ' where id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意
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


?>