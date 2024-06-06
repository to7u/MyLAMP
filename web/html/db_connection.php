<?php
/*
 * データベース関連処理
 */
$db_host = 'mysql';
$db_user = 'test_user';
$db_pass = 'test_password';
$db_name = 'test_db';

$conn = new mysqli($db_host, $db_user, $db_pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->select_db($db_name);
?>
