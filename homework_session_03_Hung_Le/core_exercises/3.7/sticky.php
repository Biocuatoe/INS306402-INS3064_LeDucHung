<?php
$msg = "";
$name_val = "";
$email_val = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_val = $_POST['name'] ?? '';
    $email_val = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    
    if (strlen($pass) < 6) {
        $msg = "Error: Password too short (min 6 chars). Other fields retained.";
    } else {
        $msg = "Success! Data processed.";
        // Reset values on success if desired, or keep them.
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h3 style="color:<?= strpos($msg, 'Error') !== false ? 'red' : 'green' ?>"><?= $msg ?></h3>
    
    <form method="POST">
        Name: <input type="text" name="name" value="<?= htmlspecialchars($name_val) ?>"><br>
        Email: <input type="text" name="email" value="<?= htmlspecialchars($email_val) ?>"><br>
        Password: <input type="password" name="password"><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>