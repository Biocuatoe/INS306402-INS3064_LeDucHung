<?php
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/ValidationException.php';

$errors = [];
$title = '';
$description = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    try {
        $validationErrors =[];
        if ($title === '') {
            $validationErrors['title'] = 'Vui lòng nhập tên khóa học.';
        } elseif (mb_strlen($title) < 3) {
            $validationErrors['title'] = 'Tên khóa học phải từ 3 ký tự trở lên.';
        }

        if (!empty($validationErrors)) {
            throw new ValidationException($validationErrors); // Ném Exception
        }

        $db = Database::getInstance();
        $db->insert('courses',[
            'title' => $title,
            'description' => $description
        ]);
        header('Location: index.php?success=1');
        exit;

    } catch (ValidationException $e) {
        $errors = $e->getErrors(); // Bắt lỗi Form
    } catch (Exception $e) {
        $errors['general'] = 'Lỗi hệ thống: ' . $e->getMessage(); // Bắt lỗi DB
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<body>
    <h1>Thêm khóa học</h1>
    <?php if (!empty($errors['general'])): ?><p style="color:red;"><?= $errors['general'] ?></p><?php endif; ?>
    <form method="post">
        Tên khóa học: <input type="text" name="title" value="<?= htmlspecialchars($title) ?>">
        <span style="color:red;"><?= $errors['title'] ?? '' ?></span><br><br>
        
        Mô tả: <textarea name="description"><?= htmlspecialchars($description) ?></textarea><br><br>
        
        <button type="submit">Lưu</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>