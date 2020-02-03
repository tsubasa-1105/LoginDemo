<?php

    require_once('config.php');

    try {
        # データベースへ接続
        $pdo = new PDO(DSN);
        # PDOエラーを表示
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        # テーブルの作成
        $pdo->exec('create table if not exists users(
            id       integer primary key autoincrement,
            email    text unique,
            password text,
            created  text
        )');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    # POST -> メールアドレス の型チェック
    if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo ERROR_EMAIL;
        return false;
    }

    # パスワードの正規表現
    if (TRUE) {
        #preg_match('/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}$/i', $_POST['password']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        echo ERROR_PASSWORD;
        return false;
    }

    # 登録処理
    try {
        $stmt = $pdo->prepare(INSERT_USER);
        $stmt->execute([$email, $password, (string)time()]);
        echo '<div>登録完了</div>';

        echo '<div><a href=".">ログインページへ戻る</a></div>';
    } catch (PDOException $e) {
        echo ERROR_UNIQUE;
    }

?>
