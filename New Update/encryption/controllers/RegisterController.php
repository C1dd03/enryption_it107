<?php
require_once __DIR__ . '/../models/User.php';

class RegisterController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showRegisterForm($errors = [], $success = null) {
        $questions = $this->userModel->getAuthQuestions();
        include __DIR__ . '/../views/register.php';
    }

    public function processRegistration($post) {
        $errors = [];

        // ✅ ID number format
        if (!preg_match("/^\d{4}-\d{4}$/", $post['id_number'])) {
            $errors[] = "Invalid ID format (must be xxxx-xxxx)";
        }

        if ($this->userModel->idExists($post['id_number'])) {
            $errors[] = "ID Number already exists!";
        }

        if ($this->userModel->usernameExists($post['username'])) {
            $errors[] = "Username already taken!";
        }

        // ✅ Names
        foreach (['first_name', 'last_name'] as $field) {
            if (!preg_match("/^[A-Z][a-z]+(?: [A-Z][a-z]+)*$/", $post[$field])) {
                $errors[] = ucfirst(str_replace("_", " ", $field)) . " is invalid! (e.g., Juan Carlo)";
            }
        }

        // ✅ Password match
        if ($post['password'] !== $post['confirm_password']) {
            $errors[] = "Passwords do not match!";
        }

        // ✅ Age
        $birthdate = new DateTime($post['birthdate']);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;
        if ($age < 18) {
            $errors[] = "You must be at least 18 years old!";
        }
        $post['age'] = $age;

        // ✅ Address validation
        $address = [
            'purok_street' => trim($post['purok_street']),
            'barangay' => trim($post['barangay']),
            'city_municipality' => trim($post['city_municipality']),
            'province' => trim($post['province']),
            'country' => trim($post['country']),
            'zip_code' => trim($post['zip_code']),
        ];
        foreach ($address as $key => $value) {
            if (empty($value)) {
                $errors[] = ucfirst(str_replace("_", " ", $key)) . " is required.";
            }
        }

        // ✅ Authentication answers
        $answers = [];
        for ($i = 1; $i <= 3; $i++) {
            $q_id = $post["question_$i"];
            $ans  = trim($post["answer_$i"]);
            if (empty($ans)) {
                $errors[] = "Answer for Question $i is required.";
            } else {
                $answers[$q_id] = $ans;
            }
        }

        // ✅ Save if no errors
        if (empty($errors)) {
            if ($this->userModel->register($post)) {
                $this->userModel->saveAddress($post['id_number'], $address);
                $this->userModel->saveAuthAnswers($post['id_number'], $answers);
                $success = "Registration successful!";
                $this->showRegisterForm([], $success);
                return;
            } else {
                $errors[] = "Database error: failed to register.";
            }
        }

        $this->showRegisterForm($errors, null);
    }
}
?>
