<?php
/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */

$id = $_GET['id'];

// 接続局面
require_once(__DIR__ . '/../config/funcs.php');
require_once(__DIR__ . '/../config/db.php');
$pdo = trycatchDB();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM ' . DB_TABLE . ' where id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$result = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();   
    // var_dump($result); 
    // exit();
}
?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📝データ登録</title>
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
                <i class="fas fa-clipboard-list"></i>
                気分を上げる方法
            </a>
            <a href="select.php" class="nav-link">
                <i class="fas fa-list"></i>
                データ一覧
            </a>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="main-container form-page">
        <div class="form-card">
            <h1 class="form-title">📝 気分を上げる方法</h1>
            <p class="form-subtitle">入力してみてください</p>

            <form method="post" action="update.php">
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-comment"></i> ニックネーム
                    </label>
                    <input type="text" id="name" name="name" class="form-input" value=<?= $result['name'] ?> required>
                </div>

                <div class="form-group">
                    <label for="action" class="form-label">
                        <i class="fas fa-comment"></i> 行動の名称
                    </label>
                    <input type="text" id="action" name="action" class="form-input" value=<?= $result['action'] ?> required>
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">
                        <i class="fas fa-comment"></i> アクションの中身
                    </label>
                    <textarea id="content" name="content" class="form-textarea"  required><?= $result['content'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="rate" class="form-label"> 
                        <i class="fas fa-comment"></i>おすすめ度
                    </label>
                    <label><input type="radio" name="rate" value="1"> ★</label>
                    <label><input type="radio" name="rate" value="2"> ★★</label>
                    <label><input type="radio" name="rate" value="3"> ★★★</label>
                    <label><input type="radio" name="rate" value="4"> ★★★★</label>
                    <label><input type="radio" name="rate" value="5"> ★★★★★</label>
                </div>

                <input type="hidden" name="id" value="<?= $result['id'] ?>"> 

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    送信する
                </button>
            </form>
        </div>
    </main>
</body>

</html>