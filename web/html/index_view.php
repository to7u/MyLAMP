<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO App</title>
    <style>
        /* Resetting default margins and paddings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20%;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        li a {
            color: #d9534f;
            text-decoration: none;
            margin-left: 10px;
        }

        @media screen and (max-width: 768px) {
            .container {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <form method="post" action="logout.php">
        <button type="submit" name="logout">Logout</button>
    </form>

    <h2>Add New TODO</h2>
    <form method="post" action="index.php">
        <input type="text" name="task" placeholder="Task" required><br>
        <button type="submit" name="add_todo">Add TODO</button>
    </form>

    <h2>TODO List</h2>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row["task"] . " 
                    <form method='post' action='edit_todo.php'>
                        <input type='hidden' name='todo_id' value='" . $row["id"] . "'>
                        <input type='text' name='task' value='" . $row["task"] . "' required>
                        <button type='submit' name='edit_todo'>Edit</button>
                    </form>
                    <a href='index.php?delete_todo=" . $row["id"] . "'>Delete</a>
                    </li>";
            }
        } else {
            echo "No todos found!";
        }
        ?>
    </ul>
</body>
</html>
