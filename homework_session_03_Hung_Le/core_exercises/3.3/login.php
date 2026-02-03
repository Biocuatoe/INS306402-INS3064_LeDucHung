<!-- File: core_exercises/ex03_login/login.php -->
<?php
// Bắt đầu session để lưu biến đếm số lần sai
session_start();

// Khởi tạo biến đếm nếu chưa có
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

$message = "";
$messageType = ""; // success hoặc error

// Xử lý khi người dùng ấn Submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hardcode credentials (theo đề bài)
    if ($username === 'admin' && $password === '123456') {
        $message = "Login Successful! Welcome Admin.";
        $messageType = "success";
        // Reset biến đếm khi đăng nhập thành công
        $_SESSION['attempts'] = 0;
    } else {
        // Đăng nhập sai
        $_SESSION['attempts']++; // Tăng biến đếm
        $message = "Invalid Credentials.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Login</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; }
        .login-box { border: 1px solid #ccc; padding: 20px; border-radius: 8px; width: 300px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .info { color: gray; margin-top: 10px; font-size: 0.9em; }
        input { width: 100%; margin-bottom: 10px; padding: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 8px; cursor: pointer; background: #007bff; color: white; border: none; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <!-- Hiển thị thông báo kết quả -->
    <?php if ($message): ?>
        <p class="<?php echo $messageType; ?>">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <!-- Hiển thị số lần sai nếu > 0 -->
    <?php if ($_SESSION['attempts'] > 0 && $messageType !== 'success'): ?>
        <p class="error">Failed Attempts: <?php echo $_SESSION['attempts']; ?></p>
    <?php endif; ?>

    <!-- Form tự gửi dữ liệu về chính file này (action để trống hoặc dùng PHP_SELF) -->
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required placeholder="admin">
        
        <label>Password:</label>
        <input type="password" name="password" required placeholder="123456">
        
        <button type="submit">Login</button>
    </form>
    
    <div class="info">
        Hint: User: admin | Pass: 123456
    </div>
</div>

</body>
</html>