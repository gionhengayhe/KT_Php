<?php
session_start();
require_once('app/controllers/NhanVienController.php');
require_once('app/controllers/AuthController.php');

// Lấy URL từ REQUEST_URI
$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Nếu truy cập /KT/KT_Php
if ($request == "KT/KT_Php" || $request == "KT/KT_Php/") {
    if (isset($_SESSION["user"])) {
        // Nếu có session đăng nhập → gọi ProductController (hoặc NhanVienController)
        $controller = new NhanVienController();
        $controller->index();
        exit;
    } else {
        // Nếu chưa đăng nhập → chuyển hướng đến /login
        header("Location: /KT/KT_Php/login");
        exit;
    }
}

// Nếu truy cập /KT/KT_Php/login
if ($request == "KT/KT_Php/login") {
    $controller = new AuthController();
    $controller->login();
    exit;
}

if ($request == "KT/KT_Php/logout") {
    $controller = new AuthController();
    $controller->logout();
    exit;
}
// Xử lý các route khác
$urlSegments = explode('/', str_replace('KT/KT_Php/', '', $request));
$controller = new NhanVienController();
$action = $urlSegments[0] ?? 'index';
$params = array_slice($urlSegments, 1);

if (method_exists($controller, $action)) {
    call_user_func_array([$controller, $action], $params);
} else {
    echo "404 - Không tìm thấy trang.";
}
