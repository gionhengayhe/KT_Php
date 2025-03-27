<?php
require_once('app/controllers/NhanVienController.php');

// Lấy URL từ REQUEST_URI
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request = trim($request, '/');

// Nếu URL rỗng hoặc là `/6/2/` thì gọi ProductController mặc định
if ($request == "KT/KT_Php" || $request == "KT/KT_Php/") {
    $controller = new NhanVienController();
    $controller->index();
    exit;
}

// Nếu có URL khác, bạn có thể dùng code route trước đó
$urlSegments = explode('/', str_replace('KT/KT_Php', '', $request));
$controller = new NhanVienController();
$action = $urlSegments[0] ?? 'index';
$params = array_slice($urlSegments, 1);

if (method_exists($controller, $action)) {
    call_user_func_array([$controller, $action], $params);
} else {
    echo "404 - Không tìm thấy trang.";
}
