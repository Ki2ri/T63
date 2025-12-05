<?php
session_start();
require 'db.php';

if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Order Complete | Game Haven</title>
    <style>
        .order-complete-container {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 20px;
        }
        
        .success-card {
            background: #5e0766;
            border-radius: 15px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 5px 25px rgba(0,0,0,0.2);
            border: 2px solid #4CAF50;
        }
        
        .success-icon {
            font-size: 5rem;
            color: #4CAF50;
            margin-bottom: 1.5rem;
            animation: bounce 1s ease infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .success-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #f5e9ff;
        }
        
        .success-message {
            font-size: 1.2rem;
            color: #f5e9ff;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .order-details {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .order-number {
            font-size: 1.3rem;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .order-number i {
            font-size: 1.5rem;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #f5e9ff;
        }
        
        .detail-row:last-child {
            border-bottom: none;
            font-weight: bold;
            color: #fff;
            font-size: 1.1rem;
        }
        
        .detail-label {
            color: #ccc;
        }
        
        .detail-value {
            font-weight: 600;
        }
        
        .order-summary {
            margin-top: 2rem;
            padding: 1.5rem;
            background: rgba(76, 175, 80, 0.1);
            border-radius: 10px;
            border-left: 4px solid #4CAF50;
        }
        
        .summary-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 1rem;
        }
        
        .summary-text {
            color: #f5e9ff;
            line-height: 1.6;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }
        
        .btn-primary, .btn-secondary {
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #4CAF50;
            color: white;
        }
        
        .btn-primary:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #f5e9ff;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .contact-info {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #ccc;
            font-size: 0.9rem;
        }
        
        .contact-info a {
            color: #4CAF50;
            text-decoration: none;
        }
        
        .contact-info a:hover {
            text-decoration: underline;
        }
        
        .nav-container {
            background: #5e0766;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }
        
        .logo img {
            border-radius: 5px;
        }
        
        .icon-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }
        
        .account-icons {
            display: flex;
            gap: 1.5rem;
        }
        
        nav {
            background: #4a0450;
            padding: 1rem 2rem;
            display: flex;
            gap: 2rem;
            justify-content: center;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        nav a:hover, nav a.active {
            background: rgba(255, 255, 255, 0.1);
        }
        
        body.light-mode {
            background-color: #f8f9fa;
            color: #333;
        }
        
        body.light-mode .nav-container {
            background: #e9ecef;
            color: #333;
        }
        
        body.light-mode .logo {
            color: #333;
        }
        
        body.light-mode .icon-btn {
            color: #333;
        }
        
        body.light-mode nav {
            background: #dee2e6;
        }
        
        body.light-mode nav a {
            color: #333;
        }
        
        body.light-mode nav a:hover, 
        body.light-mode nav a.active {
            background: rgba(0, 0, 0, 0.1);
            color: #000;
        }
        
        body.light-mode .success-card {
            background: #ffffff;
            color: #333;
            border: 2px solid #4CAF50;
        }
        
        body.light-mode .success-title,
        body.light-mode .success-message,
        body.light-mode .detail-row,
        body.light-mode .summary-text,
        body.light-mode .contact-info {
            color: #333;
        }
        
        body.light-mode .order-details {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        
        body.light-mode .detail-label {
            color: #666;
        }
        
        body.light-mode .detail-value {
            color: #333;
        }
        
        body.light-mode .order-summary {
            background: rgba(76, 175, 80, 0.15);
            border-left: 4px solid #4CAF50;
        }
        
        body.light-mode .btn-secondary {
            background: #f8f9fa;
            color: #333;
            border: 2px solid #dee2e6;
        }
        
        body.light-mode .btn-secondary:hover {
            background: #e9ecef;
        }
        
        body.light-mode .contact-info {
            color: #666;
            border-top: 1px solid #dee2e6;
        }
        
        body.light-mode .contact-info a {
            color: #4CAF50;
        }
        
        @media (max-width: 768px) {
            .success-card {
                padding: 2rem;
            }
            
            .success-title {
                font-size: 2rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-primary, .btn-secondary {
                width: 100%;
                justify-content: center;
            }
            
            nav {
                flex-wrap: wrap;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
    <div class="nav-container">
        
        <div class="logo">
            <a href="index.php">
                <img src="gamehavenlogo.png" height="50" width="50" alt="Game Haven Logo">
            </a>
            <span>GAME HAVEN</span>
        </div>

        <div style="display:flex; align-items:center; gap:15px;">
            <button id="toggle" class="icon-btn">
                <i class="fa-solid fa-moon"></i>
            </button>

            <div class="account-icons">
                <?php if (isset($_SESSION["user_id"])): ?>
                    <span>Welcome, <?= htmlspecialchars($_SESSION["user_name"]) ?></span>
                    <a href="logout.php" class="icon-btn">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="login.php" class="icon-btn">
                        <i class="fa-solid fa-user"></i> Login
                    </a>
                <?php endif; ?>

                <a href="Basket.php" class="icon-btn">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <span id="cart-count" class="cart-count">0</span>
                </a>
            </div>
        </div>

    </div>
</header>
    
    <nav>
        <a href="homepage.php">HOME</a>
        <a href="About-Us.php">ABOUT US</a>
        <a href="products.php">PRODUCTS</a>
        <a href="contact.php">CONTACT US</a>
    </nav>
    
    <main>
        <div class="order-complete-container">
            <div class="success-card">
                <div class="success-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                
                <h1 class="success-title">Order Confirmed!</h1>
                
                <p class="success-message">
                    Thank you for your purchase! Your order has been successfully placed and is being processed.
                    You will receive a confirmation email with your order details shortly.
                </p>
                
                <div class="order-details">
                    <div class="order-number">
                        <i class="fa-solid fa-receipt"></i>
                        Order #GH<?php echo rand(100000, 999999); ?>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Order Date:</span>
                        <span class="detail-value"><?php echo date('F j, Y'); ?></span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Payment Method:</span>
                        <span class="detail-value">Credit/Debit Card</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Shipping Method:</span>
                        <span class="detail-value">Royal Mail</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Order Total:</span>
                        <span class="detail-value">£<?php echo isset($_GET['total']) ? htmlspecialchars($_GET['total']) : '0.00'; ?></span>
                    </div>
                </div>
                
                <div class="order-summary">
                    <div class="summary-title">
                        <i class="fa-solid fa-circle-info"></i> What happens next?
                    </div>
                    <div class="summary-text">
                        <p>1. You'll receive an order confirmation email within the next hour.</p>
                        <p>2. Your order will be processed and prepared for shipment.</p>
                        <p>3. You'll receive a shipping confirmation with tracking details.</p>
                        <p>4. Your order will be delivered within 3-5 business days.</p>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="homepage.php" class="btn-primary">
                        <i class="fa-solid fa-home"></i> Back to Home
                    </a>
                    <a href="products.php" class="btn-secondary">
                        <i class="fa-solid fa-gamepad"></i> Continue Shopping
                    </a>
                </div>
                
                <div class="contact-info">
                    <p>Need help with your order? <a href="contact.php">Contact our support team</a> or call us at <strong>0121 123 4567</strong></p>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            localStorage.removeItem('gamehaven_basket_state_v1');
            document.getElementById('cart-count').textContent = '0';
            
            const urlParams = new URLSearchParams(window.location.search);
            const orderTotal = urlParams.get('total');
            
            if (orderTotal) {
                const totalElement = document.querySelector('.detail-row:last-child .detail-value');
                if (totalElement) {
                    totalElement.textContent = '£' + parseFloat(orderTotal).toFixed(2);
                }
            }
        });
        
        const toggleBtn = document.getElementById("toggle");
        
        if (localStorage.getItem("theme") === "light") {
            document.body.classList.add("light-mode");
            toggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i>';
        }
        
        toggleBtn.addEventListener("click", () => {
            document.body.classList.toggle("light-mode");
            
            if (document.body.classList.contains("light-mode")) {
                toggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i>';
                localStorage.setItem("theme", "light");
            } else {
                toggleBtn.innerHTML = '<i class="fa-solid fa-moon"></i>';
                localStorage.setItem("theme", "dark");
            }
        });
    </script>
</body>
</html>