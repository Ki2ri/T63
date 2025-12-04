<?php
require 'db.php';

// Initialize variables
$search = $_GET['search'] ?? '';
$category_id = $_GET['category'] ?? '';

// Build the SQL query
$sql = "SELECT products.*, categories.name as category_name 
        FROM products 
        JOIN categories ON products.category_id = categories.id 
        WHERE 1=1";
$params = [];

if ($search) {
    $sql .= " AND (products.name LIKE ? OR products.description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($category_id) {
    $sql .= " AND category_id = ?";
    $params[] = $category_id;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

// Get categories for dropdown
$catStmt = $pdo->query("SELECT * FROM categories");
$categories = $catStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Haven - Product Search</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .product-card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; }
        .search-bar { margin-bottom: 20px; padding: 15px; background: #f4f4f4; border-radius: 8px; }
        input, select, button { padding: 8px; margin-right: 10px; }
    </style>
</head>
<body>

    <h1>Game Haven Catalogue</h1>

    <div class="search-bar">
        <form method="GET">
            <input type="text" name="search" placeholder="Search games..." value="<?= htmlspecialchars($search) ?>">
            <select name="category">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $category_id == $cat['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Search</button>
            <a href="index.php">Clear</a>
        </form>
    </div>

<div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><strong>Category:</strong> <?= htmlspecialchars($product['category_name']) ?></p>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p><strong>Price:</strong> £<?= htmlspecialchars($product['price']) ?></p>
                
                <!-- Updated Form for Add to Basket -->
                <form action="add_to_basket.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <label>Qty:</label>
                    <input type="number" name="quantity" value="1" min="1" style="width: 50px;">
                    <button type="submit">Add to Basket</button>
                </form>
            </div>
        <?php endforeach; ?>
        
        <?php if (empty($products)): ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>

</body>
</html>