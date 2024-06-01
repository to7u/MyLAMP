<?php
$todo_id = $_GET['delete_todo'];

$sql = "DELETE FROM todos WHERE id='$todo_id'";
if ($conn->query($sql) === TRUE) {
    echo "Todo deleted successfully!";
} else {
    echo "Error deleting todo: " . $conn->error;
}
?>
