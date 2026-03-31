<?php
// teachers/edit.php
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/ValidationException.php';

$db = Database::getInstance();
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) { header('Location: index.php'); exit; }

$course = $db->fetch('SELECT * FROM teachers WHERE id = ?', [$id]);
if (!$course) { header('Location: index.php'); exit; }

$errors = [];
$title = $course['title'];
$description = $course['description'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    try {
        $valErrors =[];
        if ($title === '') $valErrors['title'] = 'Vui lòng nhập tên khóa học.';
        elseif (mb_strlen($title) < 3) $valErrors['title'] = 'Tên khóa học phải từ 3 ký tự.';
        
        if (!empty($valErrors)) throw new ValidationException($valErrors);

        $db->update('teachers',['title' => $title, 'description' => $description], 'id = ?', [$id]);
        header('Location: index.php?updated=1'); exit;

    } catch (ValidationException $e) {
        $errors = $e->getErrors();
    } catch (Exception $e) {
        $errors['general'] = "Lỗi hệ thống: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Sửa khóa học</h1>
    <?php if (!empty($errors['general'])): ?><p style="color:red;"><?= $errors['general'] ?></p><?php endif; ?>
    <form method="post">
        Tên: <input type="text" name="title" value="<?= htmlspecialchars($title) ?>">
        <span style="color:red;"><?= $errors['title'] ?? '' ?></span><br><br>
        Mô tả: <textarea name="description"><?= htmlspecialchars($description) ?></textarea><br><br>
        <button type="submit">Cập nhật</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>