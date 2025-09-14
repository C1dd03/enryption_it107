<?php
require_once __DIR__ . "/../models/User.php";

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Handle registration
    public function register($id_number, $username, $birthdate, $password) {
        $user = new User($this->db);
        $user->id_number = $id_number;
        $user->username = $username;
        $user->birthdate = $birthdate;
        $user->password_hash = password_hash($password, PASSWORD_BCRYPT);

        return $user->register();
    }

    // Handle login
    public function login($username, $password) {
        $user = new User($this->db);
        $user->username = $username;

        $row = $user->getUserByUsername();
        if ($row && password_verify($password, $row['password'])) {
            return $row; // success
        }
        return false;
    }
}
?>
