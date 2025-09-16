<?php
require_once __DIR__ . '/../config/db.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function idExists($id_number) {
        $stmt = $this->conn->prepare("SELECT id_number FROM users WHERE id_number = ?");
        $stmt->execute([$id_number]);
        return $stmt->fetch() ? true : false;
    }

    public function usernameExists($username) {
        $stmt = $this->conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch() ? true : false;
    }

    public function register($data) {
        $stmt = $this->conn->prepare("INSERT INTO users 
            (id_number, first_name, middle_name, last_name, extension, birthdate, age, username, password_hash) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        return $stmt->execute([
            $data['id_number'],
            $data['first_name'],
            $data['middle_name'],
            $data['last_name'],
            $data['extension'],
            $data['birthdate'],
            $data['age'],
            $data['username'],
            password_hash($data['password'], PASSWORD_BCRYPT)
        ]);
    }

    public function saveAddress($id_number, $address) {
        $stmt = $this->conn->prepare("INSERT INTO addresses 
            (id_number, purok_street, barangay, city_municipality, province, country, zip_code) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $id_number,
            $address['purok_street'],
            $address['barangay'],
            $address['city_municipality'],
            $address['province'],
            $address['country'],
            $address['zip_code']
        ]);
    }

    public function saveAuthAnswers($id_number, $answers) {
        $stmt = $this->conn->prepare("INSERT INTO user_auth_answers 
            (id_number, question_id, answer_hash) VALUES (?, ?, ?)");
        
        foreach ($answers as $q_id => $ans) {
            $stmt->execute([$id_number, $q_id, password_hash($ans, PASSWORD_BCRYPT)]);
        }
    }

    // Load default questions for dropdown
    public function getAuthQuestions() {
        $stmt = $this->conn->query("SELECT * FROM auth_questions");
        return $stmt->fetchAll();
    }
}
?>
