<?php
// セッションIDをクッキーから取得する
session_id($_COOKIE['session_id']);

// セッションを開始する
session_start();

// クッキーがセットされているかを確認する
if(isset($_COOKIE['session_id'])) {
    // セッションIDを設定する
    session_id($_COOKIE['session_id']);
}

$db_host = 'mysql';
$db_user = 'test_user';
$db_pass = 'test_password';
$db_name = 'test_db';

// MySQLデータベースへの接続
$conn = new mysqli($db_host, $db_user, $db_pass);

// エラーハンドリング
if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
}

$conn->select_db($db_name);

// 新規ユーザー登録
if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // SQLインジェクションの脆弱性を持つクエリ
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = $conn->query($query);
    if($result) {
        echo "ユーザー登録が成功しました。";
    } else {
        echo "エラー：ユーザー登録に失敗しました。";
    }
}

// ログイン
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // SQLインジェクションの脆弱性を持つクエリ
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    
    if($result->num_rows == 1) {
        // セッションIDを更新（アクティブなセッションがある場合にのみ）
        if(session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
        $_SESSION['username'] = $username;
        setcookie('session_id', session_id(), time() + (86400 * 30), "/"); // クッキーを30日間有効にする
        setcookie('username', $username, time() + (86400 * 30), "/"); // ユーザー名のクッキーを30日間有効にする
        echo "ログイン成功。";
    } else {
        echo "ユーザー名またはパスワードが正しくありません。";
    }
}

// ログアウト
if(isset($_POST['logout'])) {
    session_destroy();
    setcookie('session_id', '', time() - 3600, "/"); // クッキーを削除
    header("Location: ".$_SERVER['PHP_SELF']);
}

// HTMLの描写
?>
<!DOCTYPE html>
<html>
<head>
    <title>セッション管理デモアプリ</title>
</head>
<body>
    <?php if(isset($_SESSION['username'])) { ?>
        <h2>ようこそ、<?php echo $_SESSION['username']; ?>さん</h2>
        <p>セッションID: <?php echo session_id(); ?></p>
        <form method="post" action="">
            <button type="submit" name="logout">ログアウト</button>
        </form>
    <?php } else { ?>
        <h2>新規ユーザー登録</h2>
        <form method="post" action="">
            <input type="text" name="username" placeholder="ユーザー名" required><br>
            <input type="password" name="password" placeholder="パスワード" required><br>
            <button type="submit" name="register">登録</button>
        </form>
        <h2>ログイン</h2>
        <form method="post" action="">
            <input type="text" name="username" placeholder="ユーザー名" required><br>
            <input type="password" name="password" placeholder="パスワード" required><br>
            <button type="submit" name="login">ログイン</button>
        </form>
    <?php } ?>
</body>
</html>
