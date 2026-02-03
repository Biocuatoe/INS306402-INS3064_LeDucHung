<?php
$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    if (empty($name)) $errors[] = "Name is required.";
    if (empty($email)) $errors[] = "Email is required.";
    
    if (empty($errors)) {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <?php if ($success): ?>
        <h2 style="color:green">Thank You, <?= htmlspecialchars($name) ?>!</h2>
        <p>We have received your email: <?= htmlspecialchars($email) ?></p>
        <a href="contact_self.php">Send another</a>
    <?php else: ?>
        <h2>Contact Us</h2>
        <?php foreach($errors as $err) echo "<p style='color:red'>$err</p>"; ?>
        
        <form method="POST">
            Name: <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"><br><br>
            Email: <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"><br><br>
            <button type="submit">Submit</button>
        </form>
    <?php endif; ?>
</body>
</html>