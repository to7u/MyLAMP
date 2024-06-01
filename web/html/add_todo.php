<?php
/*
* TODO追加処理
*/
$task = $_POST['task'];
$username = $_SESSION['username'];

$sql = "SELECT id FROM users WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];

    // TODOを追加
    $sql = "INSERT INTO todos (task, user_id) VALUES ('$task', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        echo "New todo added successfully!";
    } else {
        echo "Error adding todo: " . $conn->error;
    }
}
?>
