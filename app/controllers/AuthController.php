<?php
require_once 'app/models/User.php';
require_once 'app/config/database.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->userModel = new User($db);
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $user = $this->userModel->login($username, $password);
            if ($user) {
                $_SESSION["user"] = $user;
                header("Location: /KT/KT_Php");
                exit();
            } else {
                $error = "Sai tài khoản hoặc mật khẩu!";
                include 'app/views/auth/login.php';
            }
        } else {
            include 'app/views/auth/login.php';
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /KT/KT_Php/login");
    }
}
