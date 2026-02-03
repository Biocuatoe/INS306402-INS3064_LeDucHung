<?php
session_start();
// Access Control
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['user'];
$file = 'users.json';
$users = json_decode(file_get_contents($file), true);
$msg = "";

// Handle Profile Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update Bio
    if (isset($_POST['bio'])) {
        $users[$username]['bio'] = htmlspecialchars($_POST['bio']);
    }

    // Handle File Upload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $allowed = ['image/jpeg', 'image/png'];
        if (in_array($_FILES['avatar']['type'], $allowed)) {
            if ($_FILES['avatar']['size'] <= 2 * 1024 * 1024) { // 2MB
                $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $filename = "uploads/" . $username . "_" . time() . "." . $ext;
                
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $filename)) {
                    $users[$username]['avatar'] = $filename;
                } else {
                    $msg = "Error moving file.";
                }
            } else {
                $msg = "File too large (>2MB).";
            }
        } else {
            $msg = "Invalid file type. JPG/PNG only.";
        }
    }
    
    // Save changes
    file_put_contents($file, json_encode($users));
    if (!$msg) $msg = "Profile Updated!";
}

// Get current data
$userData = $users[$username];
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Welcome, <?= htmlspecialchars($username) ?></h2>
    <a href="logout.php">Logout</a>
    
    <?php if($msg) echo "<p style='color:blue'>$msg</p>"; ?>

    <div style="border:1px solid #ccc; padding:10px; margin-top:20px;">
        <h3>Your Profile</h3>
        <?php if (!empty($userData['avatar'])): ?>
            <img src="<?= $userData['avatar'] ?>" width="100"><br>
        <?php else: ?>
            <p>No avatar uploaded.</p>
        <?php endif; ?>
        
        <p><strong>Bio:</strong> <?= $userData['bio'] ?></p>
    </div>

    <h3>Edit Profile</h3>
    <form method="POST" enctype="multipart/form-data">
        <label>Update Bio:</label><br>
        <textarea name="bio"><?= $userData['bio'] ?></textarea><br><br>
        
        <label>Upload Avatar (JPG/PNG, Max 2MB):</label><br>
        <input type="file" name="avatar"><br><br>
        
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>