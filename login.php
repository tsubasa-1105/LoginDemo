<?php

    # データベースの情報を取得
    require_once('config.php');
    # セッション開始
    session_start();

    # POST -> メールアドレス の型チェック
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo ERROR_EMAIL;
        return false;
    }

    # DB -> メールアドレスを検索
    try {
        $pdo = new PDO(DSN);
        $stmt = $pdo->prepare(SEARCH_EMAIL);
        $stmt->execute([$_POST['email']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage() . PHP_EOL;
    }

    # DB -> メールアドレスを確認
    if (!isset($row['email'])) {
        echo ERROR_LOGIN_FAILURE;
        return false;
    }

    # セッションにメールアドレスを登録
    if (password_verify($_POST['password'], $row['password'])) {
        # セッションを新しく置き換える
        session_regenerate_id(true);
        # メールアドレスを登録
        $_SESSION['EMAIL'] = $row['email'];
        # ログインページに移動
        header('Location: .');;
    } else {
        echo ERROR_LOGIN_FAILURE;
        return false;
    }

?>