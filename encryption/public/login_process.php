<?php
session_start();
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../controllers/UserController.php";

$db = Database::getInstance()->getConnection();
$userController = new UserController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user = $userController->login($username, $password);

    if ($user) {
        $_SESSION['id_number'] = $user['id_number'];
        $_SESSION['username']  = $user['username'];

        echo "Welcome " . htmlspecialchars($user['username']) . "! You are logged in.";
    } else {
        echo "❌ Invalid login. <a href='../views/login.php'>Try again</a>";
    }
}
?>
