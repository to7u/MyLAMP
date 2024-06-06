<?php
/*
* メイン処理
*/
session_start();

// ログインしていない場合はログインページにリダイレクト
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

// テーブルが存在しない場合に作成するクエリ
$createTableQuery = "CREATE TABLE IF NOT EXISTS todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    task TEXT NOT NULL,
    completed BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// テーブルの作成を試行
if ($conn->query($createTableQuery) === TRUE) {
    echo "Table created successfully!";
} else {
    echo "Error creating table: " . $conn->error;
}

// 新規TODO追加
if (isset($_POST['add_todo'])) {
    include 'add_todo.php';
}

// TODO編集
if (isset($_POST['edit_todo'])) {
    include 'edit_todo.php';
}

// TODO削除
if (isset($_GET['delete_todo'])) {
    include 'delete_todo.php';
}

// ユーザー名からユーザーIDを取得
$username = $_SESSION['username'];
$sql = "SELECT todos.id, todos.task FROM todos INNER JOIN users ON todos.user_id = users.id WHERE users.username='$username'";
$result = $conn->query($sql);

include 'index_view.php';

$conn->close();
?>