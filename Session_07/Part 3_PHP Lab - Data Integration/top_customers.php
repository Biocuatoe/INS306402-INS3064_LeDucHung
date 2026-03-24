<?php
require_once 'Database.php';
$db = Database::getInstance()->getConnection();

// 1. Prepare and execute the SQL query
$sql = "SELECT u.name, u.email, SUM(o.total_amount) AS total_spent
        FROM users u
        JOIN orders o ON u.id = o.user_id
        GROUP BY u.id, u.name, u.email
        ORDER BY total_spent DESC
        LIMIT 3";
$stmt = $db->query($sql);

// 2. Fetch the results
$top_customers = $stmt->fetchAll();
?>
<!-- HTML Table Structure -->
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Total Spent</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($top_customers as $customer): ?>
            <tr>
                <td><?= htmlspecialchars($customer['name']) ?></td>
                <td><?= htmlspecialchars($customer['email']) ?></td>
                <td>$<?= number_format($customer['total_spent'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>