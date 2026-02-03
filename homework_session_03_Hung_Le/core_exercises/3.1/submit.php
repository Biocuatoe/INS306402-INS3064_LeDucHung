<!-- File: core_exercises/ex01_contact_form/submit.php -->
<?php
// Bật báo lỗi để dễ debug (Yêu cầu trong Section 1.1)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kiểm tra xem có phải request POST không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Lấy dữ liệu và xử lý khoảng trắng thừa
    $fullname = trim($_POST['fullname'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $message  = trim($_POST['message'] ?? '');

    // Validation: Kiểm tra dữ liệu rỗng
    if (empty($fullname) || empty($email) || empty($message)) {
        echo "<h3 style='color:red'>Error: Missing Data!</h3>";
        echo "<p>Please fill in Name, Email and Message.</p>";
        echo "<a href='contact.html'>Go Back</a>";
        exit; // Dừng chạy code
    }

    // Hiển thị dữ liệu (Acceptance Criteria: Structured HTML List)
    // Dùng htmlspecialchars để chống lỗi bảo mật XSS
    echo "<h2>Submission Received</h2>";
    echo "<ul>";
    echo "<li><strong>Name:</strong> " . htmlspecialchars($fullname) . "</li>";
    echo "<li><strong>Email:</strong> " . htmlspecialchars($email) . "</li>";
    echo "<li><strong>Phone:</strong> " . htmlspecialchars($phone) . "</li>";
    echo "<li><strong>Message:</strong> " . htmlspecialchars($message) . "</li>";
    echo "</ul>";

} else {
    // Nếu truy cập trực tiếp vào file submit.php mà không qua form
    echo "Invalid Request.";
}
?>