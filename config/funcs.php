<?php
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


require_once('db.php');

function trycatchDB(){
try {
    $dsn = 'mysql:dbname=' . DB_NAME .
           ';charset=' . DB_CHARSET .
           ';host=' . DB_HOST;

  //Password:MAMP='root',XAMPP=''
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    return $pdo;
    } catch (PDOException $e) {
    error_log('[DBConnectError] ' . $e->getMessage());
    http_response_code(500);
    exit('サーバーエラーが発生しました。時間をおいて再度お試しください。');
    }
    // 本番用にエラーログ表示を消去
}