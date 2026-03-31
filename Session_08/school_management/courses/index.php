<?php
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();
$courses = $db->fetchAll('SELECT * FROM courses ORDER BY created_at DESC');

$successMessage = '';
if (isset($_GET['success'])) $successMessage = 'Thêm thành công!';
elseif (isset($_GET['updated'])) $successMessage = 'Cập nhật thành công!';
elseif (isset($_GET['deleted'])) $successMessage = 'Xóa thành công!';
?>
<!DOCTYPE html>
<html lang="vi">
<head><title>Quản lý khóa học</title></head>
<body>
    <h1>Quản lý khóa học</h1>
    <a href="../index.php" style="display:inline-block; padding: 8px 15px; background: #555; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px;">⬅ Quay lại Menu Chính</a>
    <?php if ($successMessage): ?><p style="color: green;"><?= $successMessage ?></p><?php endif; ?>
    <p><a href="create.php">+ Thêm khóa học</a></p>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr><th>ID</th><th>Tên khóa học</th><th>Mô tả</th><th>Hành động</th></tr>
        <?php foreach ($courses as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['title']) ?></td>
                <td><?= htmlspecialchars($c['description']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $c['id'] ?>">Sửa</a> | 
                    <a href="delete.php?id=<?= $c['id'] ?>" onclick="return confirm('Xóa khóa học này?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>