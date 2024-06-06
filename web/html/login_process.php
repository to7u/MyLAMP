<?php
/*
* ログイン処理
*/
$username = $_POST['username'];
$password = $_POST['password'];

// テーブルが存在しない場合に作成するクエリ
$createTableQuery = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

// テーブルの作成を試行
if ($conn->query($createTableQuery) === TRUE) {
    echo "Table created successfully!";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    // ログイン成功
    $_SESSION['username'] = $username;
    header("Location: index.php");
    exit();
} else {
    echo "Invalid username or password!";
}
?>
