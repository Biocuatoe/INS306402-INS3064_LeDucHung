<?php
require_once __DIR__ . '/../classes/Database.php';
$db = Database::getInstance();
$teachers = $db->fetchAll('SELECT * FROM teachers ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="vi">
<body>
    <h1>Quản lý Giảng viên</h1>
    <a href="../index.php" style="display:inline-block; padding: 8px 15px; background: #555; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px;">⬅ Quay lại Menu Chính</a>
    <a href="create.php">+ Thêm Giảng viên</a>
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top:20px;">
        <tr><th>ID</th><th>Tên</th><th>Email</th><th>Phone</th><th>Hành động</th></tr>
        <?php foreach($teachers as $t): ?>
            <tr>
                <td><?= $t['id'] ?></td>
                <td><?= htmlspecialchars($t['name']) ?></td>
                <td><?= htmlspecialchars($t['email']) ?></td>
                <td><?= htmlspecialchars($t['phone']) ?></td>
                <td><a href="delete.php?id=<?= $t['id'] ?>">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>