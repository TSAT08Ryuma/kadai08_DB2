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

            <form method="post" action="insert.php">
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-comment"></i> ニックネーム
                    </label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="例：TokyoTaro" required>
                </div>

                <div class="form-group">
                    <label for="action" class="form-label">
                        <i class="fas fa-comment"></i> 行動の名称
                    </label>
                    <input type="text" id="action" name="action" class="form-input" placeholder="例：水泳" required>
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">
                        <i class="fas fa-comment"></i> アクションの中身
                    </label>
                    <textarea id="content" name="content" class="form-textarea" placeholder="行動の詳細" required></textarea>
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


                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    送信する
                </button>
            </form>
        </div>
    </main>
</body>

</html>