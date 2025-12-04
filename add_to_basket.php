<?php
session_start(); // Start the session to store basket data

// Check if product_id was sent
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Initialize basket array if it doesn't exist
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
    }

    // Logic: If item exists, add to count. If not, create new entry.
    if (isset($_SESSION['basket'][$productId])) {
        $_SESSION['basket'][$productId] += $quantity;
    } else {
        $_SESSION['basket'][$productId] = $quantity;
    }
}

// Redirect back to the products page so they can keep shopping
header('Location: index.php');
exit();
?>