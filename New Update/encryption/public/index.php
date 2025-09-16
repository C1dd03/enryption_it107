<?php
// Front Controller (router)
$page = isset($_GET['page']) ? $_GET['page'] : 'register';

switch ($page) {
    case 'register':
        require_once __DIR__ . '/../controllers/RegisterController.php';
        $controller = new RegisterController();
        $controller->showRegisterForm();
        break;

    case 'register_submit':
        require_once __DIR__ . '/../controllers/RegisterController.php';
        $controller = new RegisterController();
        $controller->processRegistration($_POST);
        break;

    default:
        echo "404 Page Not Found";
        break;
}
