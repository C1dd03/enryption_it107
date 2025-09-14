<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../controllers/UserController.php";

$db = Database::getInstance()->getConnection();
$userController = new UserController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_number = trim($_POST['id_number']);
    $username  = trim($_POST['username']);
    $birthdate = trim($_POST['birthdate']);
    $password  = trim($_POST['password']);

    if ($userController->register($id_number, $username, $birthdate, $password)) {
        echo "✅ Registration successful! <a href='../views/login.php'>Login</a>";
    } else {
        echo "❌ Error: Could not register. ID or Username may already exist.";
    }
}
?>
