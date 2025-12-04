<?php
session_start();
require 'db.php';

$basketItems = [];
$total = 0;

// If basket is not empty, fetch product details from DB
if (!empty($_SESSION['basket'])) {
    // Get all product IDs from the session keys
    $ids = implode(',', array_keys($_SESSION['basket']));
    
    // Query DB for these specific products
    // Note: In a real app, use prepared statements for the IN clause to be safer
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $products = $stmt->fetchAll();

    // Combine DB data with Session Quantity
    foreach ($products as $product) {
        $qty = $_SESSION['basket'][$product['id']];
        $subtotal = $product['price'] * $qty;
        $total += $subtotal;
        
        $product['qty'] = $qty; // Add qty to the product array
        $product['subtotal'] = $subtotal;
        $basketItems[] = $product;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Basket - Game Haven</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px;}
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>

    <h1>Your Shopping Basket</h1>
    <a href="index.php">← Back to Shopping</a>

    <?php if (empty($basketItems)): ?>
        <p>Your basket is empty.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($basketItems as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>£<?= htmlspecialchars($item['price']) ?></td>
                        <td><?= $item['qty'] ?></td>
                        <td>£<?= number_format($item['subtotal'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Grand Total:</strong></td>
                    <td><strong>£<?= number_format($total, 2) ?></strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Placeholder Checkout Button -->
        <a href="#" class="btn">Proceed to Checkout</a>
    <?php endif; ?>

</body>
</html>