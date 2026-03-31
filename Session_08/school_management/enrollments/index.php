<?php
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

// 1. Nhận tham số Lọc & Phân trang
$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page);
$limit = 10;
$offset = ($page - 1) * $limit;

// 2. Xây dựng điều kiện WHERE
$where = "1=1";
$params =[];
if ($course_id > 0) {
    $where .= " AND e.course_id = ?";
    $params[] = $course_id;
}

// 3. Đếm tổng số bản ghi để tính số trang
$sqlCount = "SELECT COUNT(*) as total FROM enrollments e WHERE $where";
$totalRow = $db->fetch($sqlCount, $params);
$total = $totalRow['total'] ?? 0;
$totalPages = ceil($total / $limit);

// 4. Lấy dữ liệu (Phân trang OFFSET)
$sql = "SELECT e.id, s.name AS student_name, c.title AS course_title, e.enrolled_at
        FROM enrollments e
        JOIN students s ON e.student_id = s.id
        JOIN courses c ON e.course_id = c.id
        WHERE $where
        ORDER BY e.enrolled_at DESC
        LIMIT $limit OFFSET $offset";
$enrollments = $db->fetchAll($sql, $params);

// Lấy danh sách khóa học cho Dropdown filter
$courses = $db->fetchAll("SELECT id, title FROM courses ORDER BY title");
?>
<!DOCTYPE html>
<html lang="vi">
<body>
    <h1>Danh sách đăng ký học</h1>
    <a href="../index.php" style="display:inline-block; padding: 8px 15px; background: #555; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px;">⬅ Quay lại Menu Chính</a>
    <a href="create.php">+ Thêm đăng ký</a>
    
    <!-- Form Lọc -->
    <form method="get" style="margin: 20px 0;">
        <label>Lọc theo khóa học:</label>
        <select name="course_id">
            <option value="0">Tất cả</option>
            <?php foreach ($courses as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $course_id === $c['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['title']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Lọc</button>
    </form>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr><th>ID</th><th>Sinh viên</th><th>Khóa học</th><th>Ngày ĐK</th><th>Hành động</th></tr>
        <?php foreach ($enrollments as $en): ?>
            <tr>
                <td><?= $en['id'] ?></td>
                <td><?= htmlspecialchars($en['student_name']) ?></td>
                <td><?= htmlspecialchars($en['course_title']) ?></td>
                <td><?= $en['enrolled_at'] ?></td>
                <td><a href="delete.php?id=<?= $en['id'] ?>" onclick="return confirm('Xóa?');">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Hiển thị phân trang -->
    <div style="margin-top: 20px;">
        Trang: 
        <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?course_id=<?= $course_id ?>&page=<?= $i ?>" 
               style="<?= $i === $page ? 'font-weight:bold; color:red;' : '' ?>">
               [<?= $i ?>]
            </a>
        <?php endfor; ?>
    </div>
</body>
</html>