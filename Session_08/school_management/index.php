<?php
// Require môi trường ngay từ đầu để quản lý lỗi
require_once __DIR__ . '/config/env.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ Thống Quản Lý Trường Học</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .menu { display: flex; justify-content: center; gap: 20px; margin-top: 30px; }
        .menu-item { 
            padding: 20px 40px; 
            background-color: #4CAF50; 
            color: white; 
            text-decoration: none; 
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
        }
        .menu-item:hover { background-color: #45a049; }
    </style>
</head>
<body>

    <h1>Chào mừng đến với Hệ Thống Quản Lý</h1>
    <p>Vui lòng chọn chức năng bên dưới:</p>

    <div class="menu">
        <a href="students/index.php" class="menu-item">👨‍🎓 Quản lý Sinh viên</a>
        <a href="courses/index.php" class="menu-item">📚 Quản lý Khóa học</a>
        <a href="enrollments/index.php" class="menu-item">📝 Quản lý Đăng ký học</a>
        <a href="teachers/index.php" class="menu-item">👨‍🏫 Quản lý Giảng viên</a>
    </div>

</body>
</html>