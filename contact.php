<?php
// Start the session so I can use session variables for success/error messages
session_start();
// Connect to the database
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Game Haven</title>
    <style>
        /* Base page styling - going for a dark theme */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212; 
            color: #ffffff;
        }

        /* Navigation bar styling */
        .header {
            display: flex;
            align-items: center;
            padding: 20px 40px;
            background-color: #1f1f1f;
            box-shadow: 0 2px 5px rgba(0,0,0,0.5);
        }

        /* This pushes the nav links to the right side */
        .logo-container {
            flex: 1; 
        }

        /* Styling for the brand name and logo area */
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #bb86fc; /* Using the main accent purple */
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo img {
            height: 40px; 
        }

        /* Menu link styles */
        .nav-links a {
            color: #e0e0e0;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #bb86fc;
        }

        /* Main wrapper for the split layout */
        .container {
            display: flex;
            max-width: 1200px;
            margin: 50px auto;
            background-color: #1f1f1f;
            border-radius: 10px;
            overflow: hidden; /* This stops the image from poking out of the rounded corners */
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }

        /* Left side - Decorative image */
        .image-section {
            flex: 1;
            background-image: url('path/to/your/image.jpg'); /* Need to update this path later */
            background-size: cover;
            background-position: center;
            min-height: 500px; /* Keeps the height consistent even if the image loads slowly */
        }

        /* Right side - The contact form inputs */
        .form-section {
            flex: 1;
            padding: 40px;
        }

        h1 {
            color: #bb86fc;
            margin-top: 0;
        }

        p.description {
            color: #b0b0b0; /* Slightly lighter grey for the sub-text */
            margin-bottom: 30px;
        }

        /* Input field styling */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #e0e0e0;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            background-color: #2c2c2c;
            border: 1px solid #3d3d3d;
            border-radius: 5px;
            color: white;
            box-sizing: border-box; /* Important: keeps padding inside the width calculation */
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #bb86fc;
        }

        /* Submit button styles */
        button {
            width: 100%;
            padding: 12px;
            background-color: #bb86fc;
            color: #121212;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #9a67ea;
        }

        /* Alert message styling */
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .success { background-color: rgba(40, 167, 69, 0.2); color: #28a745; border: 1px solid #28a745; }
        .error { background-color: rgba(220, 53, 69, 0.2); color: #dc3545; border: 1px solid #dc3545; }

        /* Mobile adjustments */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Stack them vertically on phones */
                margin: 20px;
            }
            .image-section {
                height: 200px; /* Shorten the image so the form is visible without too much scrolling */
                min-height: auto;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo-container">
            <a href="index.php" class="logo">
                <img src="Game Haven logo.png" alt="Logo"> 
                GAME HAVEN
            </a>
        </div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="products.php">Shop</a>
            <a href="basket.php">Basket</a>
            <a href="contact.php">Contact</a>
        </div>
    </div>

    <div class="container">
        
        <div class="image-section">
            </div>

        <div class="form-section">
            <h1>Get in Touch</h1>
            <p class="description">Have a question about an order or a game? Send us a message and our team will get back to you.</p>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="message success">
                    <?= $_SESSION['success']; ?>
                    <?php unset($_SESSION['success']); // clear message after showing it ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="message error">
                    <?= $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); // clear message after showing it ?>
                </div>
            <?php endif; ?>

            <form action="process_contact.php" method="POST">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="What is this regarding?" required>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Type your message here..." required></textarea>
                </div>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>

</body>
</html>