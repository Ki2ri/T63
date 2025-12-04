<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Check if empty
    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: contact.php");
        exit();
    }

    try {
        // Insert into database
        $sql = "INSERT INTO contact_submissions (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $subject, $message]);

        $_SESSION['success'] = "Thank you! Your message has been sent.";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error sending message. Please try again.";
    }

    header("Location: contact.php");
    exit();
}
?>