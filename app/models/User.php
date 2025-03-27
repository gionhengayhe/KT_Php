<?php
require_once 'app/config/database.php';

class User
{
    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Hàm kiểm tra đăng nhập
    public function login($username, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username and password = :password LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        }
        return false;
    }
}
