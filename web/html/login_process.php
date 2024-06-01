<?php
/*
* ログイン処理
*/
$username = $_POST['username'];
$password = $_POST['password'];

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
