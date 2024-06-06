<?php
/*
* TODO編集機能
*/
include 'db_connection.php';

$task = $_POST['task'];
$todo_id = $_POST['todo_id'];

$sql = "UPDATE todos SET task='$task' WHERE id='$todo_id'";
if ($conn->query($sql) === TRUE) {
    echo "Todo updated successfully!";
} else {
    echo "Error updating todo: " . $conn->error;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit TODO</title>
</head>
<body>
    <h2><?php echo isset($message) ? $message : ''; ?></h2>
    <a href="index.php">Back to TODO list</a>
</body>
</html>