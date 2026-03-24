<?php
require_once 'Database.php';
$db = Database::getInstance()->getConnection();

// Fetch categories for the dropdown
$stmtCat = $db->query("SELECT id, category_name FROM categories");
$categories = $stmtCat->fetchAll();

// Capture search parameters securely
$search_name = $_GET['search_name'] ?? '';
$search_category = $_GET['search_category'] ?? '';

// Build the dynamic SQL query
// Note: We use LEFT JOIN to ensure products without categories still appear.
$sql = "SELECT p.id, p.name, p.price, c.category_name, p.stock 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE 1=1";

$params =[];

// Apply Name Filter (using LIKE and Placeholder)
if (!empty($search_name)) {
    $sql .= " AND p.name LIKE :name";
    $params[':name'] = '%' . $search_name . '%';
}

// Apply Category Filter (using = and Placeholder)
if (!empty($search_category)) {
    $sql .= " AND p.category_id = :category_id";
    $params[':category_id'] = $search_category;
}

// Prepare and execute the secure statement
$stmt = $db->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .filter-form { background: #f4f4f4; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #ddd; }
        /* Visual Alert requirement */
        .low-stock { background-color: #ffcccc; color: #990000; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Product Administration</h2>

    <!-- Filter Form -->
    <div class="filter-form">
        <form method="GET" action="index.php">
            <label for="search_name">Search Name:</label>
            <input type="text" name="search_name" id="search_name" value="<?= htmlspecialchars($search_name) ?>">

            <label for="search_category">Category:</label>
            <select name="search_category" id="search_category">
                <option value="">-- All Categories --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($search_category == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Filter Products</button>
            <a href="index.php"><button type="button">Reset</button></a>
        </form>
    </div>

    <!-- Data Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Stock Level</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <!-- Add "low-stock" class conditionally if stock < 10 -->
                    <tr class="<?= ($product['stock'] < 10) ? 'low-stock' : '' ?>">
                        <td><?= htmlspecialchars($product['id']) ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td>$<?= number_format($product['price'], 2) ?></td>
                        <td><?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?></td>
                        <td><?= htmlspecialchars($product['stock']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No products found matching your criteria.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>