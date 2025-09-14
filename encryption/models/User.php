<?php
class User {
    private $conn;

    public $id_number;
    public $username;
    public $password_hash;
    public $birthdate;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register new user (insert into users)
    public function register() {
        $sql = "INSERT INTO users (id_number, username, password, birthdate) 
                VALUES (:id_number, :username, :password, :birthdate)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id_number", $this->id_number);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password_hash);
        $stmt->bindParam(":birthdate", $this->birthdate);

        return $stmt->execute();
    }

    // Get user by username
    public function getUserByUsername() {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
