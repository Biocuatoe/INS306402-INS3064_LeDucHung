<?php
// Capture Step 1 Data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bio'])) {
    // Final Submission
    echo "<h2>Registration Complete</h2>";
    echo "User: " . htmlspecialchars($_POST['username']) . "<br>";
    echo "Bio: " . htmlspecialchars($_POST['bio']) . "<br>";
    echo "Location: " . htmlspecialchars($_POST['location']);
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Step 2: Profile Info</h2>
    <form method="POST">
        <!-- Pass Step 1 data as Hidden Fields -->
        <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
        <input type="hidden" name="password" value="<?= htmlspecialchars($password) ?>">
        
        Bio: <textarea name="bio"></textarea><br>
        Location: <input type="text" name="location"><br>
        <button type="submit">Finish</button>
    </form>
</body>
</html>