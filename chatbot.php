<?php
session_start();
header('Content-Type: application/json');

require_once 'db.php';

$input = json_decode(file_get_contents("php://input"), true);
$message = trim(strtolower($input['message'] ?? ''));

if ($message === '') {
    echo json_encode(['reply' => 'Please type a message.']);
    exit;
}

function reply($text) {
    echo json_encode(['reply' => $text]);
    exit;
}

if (strpos($message, 'hello') !== false || strpos($message, 'hi') !== false) {
    reply("Hi, welcome to Game Haven. I can help you find products, prices, basket info, and checkout help.");
}

if (strpos($message, 'checkout') !== false || strpos($message, 'pay') !== false) {
    reply("To checkout, add products to your basket and then go to the basket page and click Proceed to Checkout.");
}

if (strpos($message, 'contact') !== false) {
    reply("You can contact us through the Contact Us page on the website.");
}

if (strpos($message, 'basket') !== false && isset($_SESSION['basket'])) {
    $count = array_sum($_SESSION['basket']);
    reply("You currently have {$count} item(s) in your basket.");
}

if (strpos($message, 'basket') !== false) {
    reply("Your basket is currently empty.");
}

try {
    $stmt = $pdo->query("SELECT id, name, price, category FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $products = [];
}

$matches = [];

foreach ($products as $product) {
    $name = strtolower($product['name']);
    $category = strtolower($product['category'] ?? '');

    if (strpos($message, $name) !== false || ($category && strpos($message, $category) !== false)) {
        $matches[] = $product;
    }
}

if (!empty($matches)) {
    $response = "Here’s what I found:\n";
    foreach (array_slice($matches, 0, 5) as $item) {
        $response .= "- " . $item['name'] . " for £" . number_format((float)$item['price'], 2) . "\n";
    }
    reply(trim($response));
}

$keywords = [
    'ps5' => '%ps5%',
    'playstation' => '%playstation%',
    'xbox' => '%xbox%',
    'switch' => '%switch%',
    'pc' => '%pc%',
    'controller' => '%controller%',
    'mug' => '%mug%',
    'fifa' => '%fc%',
    'call of duty' => '%call of duty%',
    'madden' => '%madden%'
];

foreach ($keywords as $key => $like) {
    if (strpos($message, $key) !== false) {
        try {
            $stmt = $pdo->prepare("SELECT id, name, price FROM products WHERE name LIKE ? LIMIT 5");
            $stmt->execute([$like]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                $response = "I found these products:\n";
                foreach ($results as $item) {
                    $response .= "- " . $item['name'] . " for £" . number_format((float)$item['price'], 2) . "\n";
                }
                reply(trim($response));
            }
        } catch (Exception $e) {
        }
    }
}

reply("I can help with products, prices, checkout, contact details, and basket questions. Try asking, for example, 'Show me PS5 products' or 'How do I checkout?'");
?>
