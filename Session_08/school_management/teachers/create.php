<?php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/ValidationException.php';

$errors =[];
$name = $email = $phone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    try {
        $valErrors = [];
        if ($name === '') $valErrors['name'] = 'Vui lòng nhập tên.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $valErrors['email'] = 'Email sai định dạng.';

        if (!empty($valErrors)) throw new ValidationException($valErrors);

        $db = Database::getInstance();
        if ($db->fetch('SELECT id FROM teachers WHERE email = ?',[$email])) {
            throw new ValidationException(['email' => 'Email đã tồn tại.']);
        }

        $db->insert('teachers',['name' => $name, 'email' => $email, 'phone' => $phone]);
        header('Location: index.php?success=1'); exit;

    } catch (ValidationException $e) {
        $errors = $e->getErrors();
    } catch (Exception $e) {
        $errors['general'] = "Lỗi: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Thêm Giảng viên</h1>
    <form method="POST">
        Tên: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
        <span style="color:red"><?= $errors['name'] ?? '' ?></span><br><br>
        
        Email: <input type="text" name="email" value="<?= htmlspecialchars($email) ?>">
        <span style="color:red"><?= $errors['email'] ?? '' ?></span><br><br>
        
        Phone: <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>"><br><br>
        
        <button type="submit">Lưu</button>
    </form>
</body>
</html>