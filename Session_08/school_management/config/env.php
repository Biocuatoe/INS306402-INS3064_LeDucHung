<?php
// config/env.php

// Thay đổi thành 'production' khi đưa lên server thực tế
define('ENVIRONMENT', 'development'); 

if (ENVIRONMENT === 'development') {
    // Môi trường Dev: Hiện tất cả lỗi lên màn hình
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
} else {
    // Môi trường Prod: Ẩn lỗi, chỉ ghi vào file log
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    // Đảm bảo thư mục logs/ đã được tạo và cấp quyền ghi
    ini_set('error_log', __DIR__ . '/../logs/app_errors.log'); 
}