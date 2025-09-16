<?php
require_once __DIR__ . '/../models/User.php';

class RegisterController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function registerUser($post) {
        $errors = [];

        // ✅ Validate ID number format xxxx-xxxx
        if (!preg_match("/^\d{4}-\d{4}$/", $post['id_number'])) {
            $errors[] = "Invalid ID format (must be xxxx-xxxx)";
        }

        // ✅ Check duplicate ID
        if ($this->userModel->idExists($post['id_number'])) {
            $errors[] = "ID Number already exists!";
        }

        // ✅ Check duplicate username
        if ($this->userModel->usernameExists($post['username'])) {
            $errors[] = "Username already taken!";
        }

        // ✅ Validate names
        foreach (['first_name', 'last_name'] as $field) {
            if (!preg_match("/^[A-Z][a-z]+(?: [A-Z][a-z]+)*$/", $post[$field])) {
                $errors[] = ucfirst(str_replace("_", " ", $field)) . " is invalid! (e.g., Juan Carlo)";
            }
        }

        // ✅ Validate password confirmation
        if ($post['password'] !== $post['confirm_password']) {
            $errors[] = "Passwords do not match!";
        }

        // ✅ Compute age
        $birthdate = new DateTime($post['birthdate']);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;
        if ($age < 18) {
            $errors[] = "You must be at least 18 years old!";
        }
        $post['age'] = $age;

        // If no errors → Save
        if (empty($errors)) {
            if ($this->userModel->register($post)) {
                return ["success" => true, "message" => "Registration successful!"];
            } else {
                return ["success" => false, "message" => "Registration failed due to DB error."];
            }
        }

        return ["success" => false, "errors" => $errors];
    }
}
?>
