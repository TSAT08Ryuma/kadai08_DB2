<?php
// XSS攻撃を防御する
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../config/funcs.php');
//1.  DB接続します
$pdo = trycatchDB();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM " . DB_TABLE );
$status = $stmt->execute();

//３．データ表示
$view= '<thead>'
        .'<tr><td>' 
        . "日付" 
        . '</td><td>' 
        . "名前" 
        . '</td><td>' 
        . "行動" 
        . '</td><td>' 
        . "内容" 
        . '</td><td>' 
        . "レート" 
        . '</td><td>'
        . "削除"
        . '</td><td>'
        . "更新"
        . '</td></tr>'
        .'</thead>';
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
//   while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//     $view .= "<p>";
//     $view .= $result['date'] . h($result['name']) . h($result['email']) . h($result['content']);
//     $view .= "</p>";
//   }
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= 
        '<tbody>'
        .'<tr><td>'
        . $result['date'] 
        . '</td><td>' 
        . h($result['name']) 
        . '</td><td>' 
        . h($result['action']) 
        . '</td><td>' 
        . h($result['content']) 
        . '</td><td>' 
        . h($result['rate']) 
        . '</td><td>'
        . '<a href="delete.php?id=' . $result['id'] . '">'
        . "[削除]"
        .'</a>'
        . '</td><td>'
        . '<a href="detail.php?id=' . $result['id'] . '">'
        . "[更新]"
        .'</a>'
        . '</td></tr>'
        .'</tbody>' ;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📊 アンケートデータ一覧</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- 装飾要素 -->
    <div class="decoration"></div>
    <div class="decoration"></div>

    <!-- ヘッダー -->
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-chart-bar"></i>
                データ一覧
            </a>
            <a href="index.php" class="nav-link">
                <i class="fas fa-plus"></i>
                データ登録
            </a>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="main-container">
        <div class="content-card">
            <h1 class="page-title">📊 アンケートデータ一覧</h1>
            <p class="page-subtitle">投稿されたアンケートの回答一覧</p>
            
            <div class="data-container">
                <?php if(empty($view)): ?>
                    <!-- もし $view データがない場合の表示 -->
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <p>まだデータがありません</p>
                        <p style="margin-top: 0.5rem; font-size: 0.9rem; color: #999;">
                            最初のアンケートを投稿してみましょう！
                        </p>
                    </div>
                <?php else: ?>
                    <!-- もし $view データが存在する場合 -->
                    <table>
                        <?= $view ?>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>

</html>