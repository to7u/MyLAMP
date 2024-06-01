<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php"); // ログインページにリダイレクト。必要に応じて変更。
exit();