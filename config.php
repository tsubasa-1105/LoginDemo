<?php

    # ini_set('display_errors',1);
    define('DSN','sqlite:./user.db');

    # リクエスト
    define('SEARCH_EMAIL','select * from users where email = ?');
    define('INSERT_USER','insert into users(email, password, created) values(?, ?, ?)');

    # エラーメッセージ登録
    define('ERROR_EMAIL','入力されたメールアドレスが不正です．');
    define('ERROR_PASSWORD','パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください．');
    define('ERROR_UNIQUE','登録済みのメールアドレスです．');
    define('ERROR_LOGIN_FAILURE','メールアドレスまたはパスワードが間違っています．');
    
?>