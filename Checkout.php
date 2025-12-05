<?php
session_start();
require 'db.php';

$cart_items = [];
$subtotal = 0;
$shipping = 3.99;
$tax_rate = 0.08;

if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_items = $_SESSION['cart'];
} 

foreach($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$tax = $subtotal * $tax_rate;
$total = $subtotal + $shipping + $tax;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Check Out | Game Haven</title>
    <style>
        .checkout-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
        }
        
        .checkout-form {
            background: #5e0766;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        
        .order-summary {
            background: #5e0766;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            height: fit-content;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #4CAF50;
            color: #f5e9ff;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #f5e9ff;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .payment-method {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .payment-method:hover {
            border-color: #4CAF50;
        }
        
        .payment-method.active {
            border-color: #4CAF50;
            background: #f8fff8;
        }
        
        .payment-method i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #666;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .order-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #f5e9ff;
        }
        
        .item-price {
            color: white;
            font-weight: bold;
        }
        
        .item-quantity {
            font-size: 0.9rem;
            color: #ccc;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin: 0.5rem 0;
            padding: 0.5rem 0;
            color: #f5e9ff;
        }
        
        .summary-row.total {
            border-top: 2px solid rgba(255, 255, 255, 0.2);
            margin-top: 1rem;
            padding-top: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
        }
        
        .btn-checkout {
            width: 100%;
            padding: 1rem;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 1.5rem;
        }
        
        .btn-checkout:hover {
            background: #45a049;
        }
        
        .secure-checkout {
            text-align: center;
            margin-top: 1rem;
            color: #f5e9ff;
            font-size: 0.9rem;
        }
        
        .secure-checkout i {
            color: #4CAF50;
            margin-right: 0.5rem;
        }
        
        .empty-cart {
            text-align: center;
            padding: 3rem;
            color: #f5e9ff;
            background: #5e0766;
            border-radius: 10px;
            grid-column: 1 / -1;
        }
        
        .empty-cart i {
            font-size: 3rem;
            color: rgba(245, 233, 255, 0.3);
            margin-bottom: 1rem;
        }
        
        .cart-count {
            background: #ff4444;
            color: white;
            border-radius: 50%;
            padding: 0.2rem 0.6rem;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }
        
        .hidden {
            display: none;
        }
        
        @media (max-width: 768px) {
            .checkout-container {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <img src="GameHaven.png" height="50px" width="50px" alt="Game Haven Logo">
                <span>GAME HAVEN</span>
            </div>

            <div class="search-bar">
                <input id="searchInput" type="text" placeholder="Search...">
                <button onclick="performSearch()">Go</button>
            </div>

            <button id="toggle" class="icon-btn">
                <i class="fa-solid fa-moon"></i>
            </button>

            <div class="account-icons">
                <a href="#" class="icon-btn">
                    <i class="fa-solid fa-user"></i> Login
                </a>
                <a href="Basket.html" class="icon-btn">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <span id="cart-count" class="cart-count"></span>
                </a>
            </div>
        </div>
    </header>
    
    <nav>
        <a href="index.php">HOME</a>
        <a href="#" class="active">ABOUT US</a>
        <a href="#">CONSOLE/PC</a>
        <a href="#">GAMES</a>
        <a href="#">CONTACT US</a>
    </nav>
    
    <main>
        <div class="checkout-container">
            <div id="empty-cart-message" class="empty-cart hidden">
                <i class="fa-solid fa-cart-shopping"></i>
                <h2>Your cart is empty</h2>
                <p>Add some games to your cart before checking out!</p>
                <a href="products.php" style="display: inline-block; margin-top: 1rem; padding: 0.75rem 1.5rem; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Continue Shopping</a>
            </div>
            
            <div id="checkout-content" class="<?php echo empty($cart_items) ? 'hidden' : ''; ?>">
                <div class="order-summary">
                    <h2 class="section-title">Order Summary</h2>
                    
                    <div id="order-items-container" style="max-height: 300px; overflow-y: auto; margin-bottom: 1.5rem;">
                        <?php if(!empty($cart_items)): ?>
                            <?php foreach($cart_items as $item): ?>
                                <div class="order-item">
                                    <div class="item-details">
                                        <div class="item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                        <div class="item-quantity">Qty: <?php echo $item['quantity']; ?></div>
                                    </div>
                                    <div class="item-price">£<?php echo number_format($item['price'] * $item['quantity'], 2); ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div id="js-order-items">
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div id="order-summary-details">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="subtotal-display">£<?php echo number_format($subtotal, 2); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span id="shipping-cost">£<?php echo number_format($shipping, 2); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Tax (<?php echo ($tax_rate * 100); ?>%)</span>
                            <span id="tax-display">£<?php echo number_format($tax, 2); ?></span>
                        </div>
                        <div id="discount-row" class="summary-row" style="color: #4CAF50; display: none;">
                            <span>Discount</span>
                            <span id="discount-display">-£0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="total-amount">£<?php echo number_format($total, 2); ?></span>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem; padding: 1rem; background: rgba(76, 175, 80, 0.1); border-radius: 5px; border-left: 4px solid #4CAF50;">
                        <div style="font-weight: bold; color: #4CAF50; margin-bottom: 0.5rem;">
                            <i class="fa-solid fa-gift"></i> Order Benefits
                        </div>
                        <div style="font-size: 0.9rem; color: #f5e9ff;">
                            • Free return shipping within 30 days<br>
                            • UK-wide delivery
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <a href="Basket.html" style="display: block; text-align: center; color: #4CAF50; text-decoration: none;">
                            <i class="fa-solid fa-arrow-left"></i> Back to Basket
                        </a>
                    </div>
                </div>
                
                <div class="checkout-form">
                    <h1 class="section-title">Checkout Information</h1>
                    
                    <form action="process_order.php" method="POST" id="checkout-form">
                        <div class="form-group">
                            <h3 style="margin-bottom: 1rem; color: #f5e9ff;">Contact Information</h3>
                            <div class="form-row">
                                <div>
                                    <label for="firstName">First Name *</label>
                                    <input type="text" id="firstName" name="firstName" class="form-control" required>
                                </div>
                                <div>
                                    <label for="lastName">Last Name *</label>
                                    <input type="text" id="lastName" name="lastName" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div>
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div>
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <h3 style="margin-bottom: 1rem; color: #f5e9ff;">Shipping Address</h3>
                            <label for="addressLine1">Address Line 1 *</label>
                            <input type="text" id="addressLine1" name="addressLine1" class="form-control" required placeholder="House number and street name">
                            
                            <label for="addressLine2" style="margin-top: 1rem;">Address Line 2</label>
                            <input type="text" id="addressLine2" name="addressLine2" class="form-control" placeholder="Apartment, suite, unit, building, floor, etc.">
                            
                            <div class="form-row" style="margin-top: 1rem;">
                                <div>
                                    <label for="city">Town/City *</label>
                                    <input type="text" id="city" name="city" class="form-control" required placeholder="e.g. London, Manchester">
                                </div>
                                <div>
                                    <label for="county">County</label>
                                    <input type="text" id="county" name="county" class="form-control" placeholder="e.g. Greater London, Lancashire">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div>
                                    <label for="postcode">Postcode *</label>
                                    <input type="text" id="postcode" name="postcode" class="form-control" required placeholder="e.g. SW1A 1AA">
                                </div>
                                <div>
                                    <label for="country">Country</label>
                                    <input type="text" id="country" name="country" class="form-control" value="United Kingdom" readonly style="background-color: #f5f5f5;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <h3 style="margin-bottom: 1rem; color: white;">Payment Method</h3>
                            <div class="payment-methods" style="grid-template-columns: 1fr;">
                                <div class="payment-method active" data-method="credit">
                                    <i class="fa-solid fa-credit-card"></i>
                                    <div style="color: black;">Credit/Debit card</div>
                                </div>
                            </div>
                            
                            <div id="credit-card-form">
                                <div class="form-row">
                                    <div>
                                        <label for="nameOnCard">Name on Card *</label>
                                        <input type="text" id="nameOnCard" name="nameOnCard" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div>
                                        <label for="cardNumber">Card Number *</label>
                                        <input type="text" id="cardNumber" name="cardNumber" class="form-control" placeholder="1234 5678 9012 3456">
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div>
                                        <label for="expiry">Expiry Date *</label>
                                        <input type="text" id="expiry" name="expiry" class="form-control" placeholder="MM/YY">
                                    </div>
                                    <div>
                                        <label for="cvv">CVV *</label>
                                        <input type="text" id="cvv" name="cvv" class="form-control" placeholder="123">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <h3 style="margin-bottom: 1rem; color: #f5e9ff;">Shipping Method</h3>
                            <div style="border: 1px solid #ddd; border-radius: 5px; padding: 1rem;">
                                <div style="margin-bottom: 0.5rem;">
                                    <input type="radio" id="standard" name="shipping" value="standard" checked>
                                    <label for="standard" style="display: inline; margin-left: 0.5rem; color: #f5e9ff;">
                                        Royal Mail (3-5 business days) - £3.99
                                    </label>
                                </div>
                                <div style="margin-bottom: 0.5rem;">
                                    <input type="radio" id="nextday" name="shipping" value="nextday">
                                    <label for="nextday" style="display: inline; margin-left: 0.5rem; color: #f5e9ff;">
                                        Royal Mail  (1-2 business day) - £6.99
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" id="express" name="shipping" value="express">
                                    <label for="express" style="display: inline; margin-left: 0.5rem; color: #f5e9ff;">
                                        Royal Mail (Guaranteed next business day) - £9.99
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <h3 style="margin-bottom: 1rem; color: #f5e9ff;">Additional Options</h3>
                            <div style="margin-bottom: 0.5rem;">
                                <input type="checkbox" id="giftWrap" name="giftWrap">
                                <label for="giftWrap" style="display: inline; margin-left: 0.5rem; color: #f5e9ff;">
                                    Gift Wrap (+£2.99)
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" id="newsletter" name="newsletter">
                                <label for="newsletter" style="display: inline; margin-left: 0.5rem; color: #f5e9ff;">
                                    Subscribe to our newsletter for exclusive offers
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group" style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 1rem;">
                            <div>
                                <input type="checkbox" id="terms" name="terms" required>
                                <label for="terms" style="display: inline; margin-left: 0.5rem; color: #f5e9ff;">
                                    I agree to the <a href="#" style="color: #4CAF50;">Terms and Conditions</a> and <a href="#" style="color: #4CAF50;">Privacy Policy</a> *
                                </label>
                            </div>
                        </div>
                        
                        <input type="hidden" name="payment_method" id="payment_method" value="credit">
                        <input type="hidden" name="total_amount" id="total_amount_input" value="<?php echo number_format($total, 2); ?>">
                        <input type="hidden" name="country" value="United Kingdom">
                        <input type="hidden" name="basket_data" id="basket_data">
                        <input type="hidden" name="discount" id="discount_input">
                        <input type="hidden" name="promo_used" id="promo_used_input">
                        
                        <button type="submit" class="btn-checkout">
                            <i class="fa-solid fa-lock"></i> Place Order - £<span id="total-display"><?php echo number_format($total, 2); ?></span>
                        </button>
                        
                        <div class="secure-checkout">
                            <i class="fa-solid fa-shield-alt"></i>
                            Secure Checkout · Your payment information is encrypted
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <script>
function loadBasketFromLocalStorage() {
    const raw = localStorage.getItem('gamehaven_basket_state_v1');
    if (raw) {
        try {
            const basketData = JSON.parse(raw);
            const { basket, discount = 0, promoUsed = false, delivery = 3.99 } = basketData;
            
            if (basket && basket.length > 0) {
                let subtotal = 0;
                let itemCount = 0;
                
                const orderItemsContainer = document.getElementById('js-order-items') || document.getElementById('order-items-container');
                orderItemsContainer.innerHTML = '';
                
                basket.forEach(item => {
                    subtotal += item.price * item.quantity;
                    itemCount += item.quantity;
                    
                    const itemElement = document.createElement('div');
                    itemElement.className = 'order-item';
                    itemElement.innerHTML = `
                        <div class="item-details">
                            <div class="item-name">${item.name}</div>
                            <div class="item-quantity">Qty: ${item.quantity}</div>
                        </div>
                        <div class="item-price">£${(item.price * item.quantity).toFixed(2)}</div>
                    `;
                    orderItemsContainer.appendChild(itemElement);
                });
                
                document.getElementById('cart-count').textContent = basket.length;
                
                const taxRate = <?php echo $tax_rate; ?>;
                const tax = subtotal * taxRate;
                let shipping = delivery;
                let total = subtotal + shipping + tax - discount;
                
                document.getElementById('subtotal-display').textContent = '£' + subtotal.toFixed(2);
                document.getElementById('tax-display').textContent = '£' + tax.toFixed(2);
                document.getElementById('total-display').textContent = total.toFixed(2);
                document.getElementById('total-amount').textContent = '£' + total.toFixed(2);
                
                document.getElementById('total_amount_input').value = total.toFixed(2);
                document.getElementById('basket_data').value = JSON.stringify(basket);
                document.getElementById('discount_input').value = discount;
                document.getElementById('promo_used_input').value = promoUsed;
                
                const discountRow = document.getElementById('discount-row');
                if (discount > 0) {
                    discountRow.style.display = 'flex';
                    document.getElementById('discount-display').textContent = '-£' + discount.toFixed(2);
                } else {
                    discountRow.style.display = 'none';
                }
                
                document.getElementById('checkout-content').classList.remove('hidden');
                document.getElementById('empty-cart-message').classList.add('hidden');
                
                return { subtotal, shipping, tax, total, discount, basket };
            } else {
                showEmptyCart();
            }
        } catch (error) {
            console.error('Error parsing basket data:', error);
            showEmptyCart();
        }
    } else {
        showEmptyCart();
    }
}

function showEmptyCart() {
    document.getElementById('checkout-content').classList.add('hidden');
    document.getElementById('empty-cart-message').classList.remove('hidden');
    document.getElementById('cart-count').textContent = '';
}

function updateTotal() {
    const subtotalText = document.getElementById('subtotal-display').textContent;
    const subtotal = parseFloat(subtotalText.replace('£', '')) || 0;
    
    const discountRow = document.getElementById('discount-row');
    let discount = 0;
    if (discountRow.style.display !== 'none') {
        const discountText = document.getElementById('discount-display').textContent;
        discount = parseFloat(discountText.replace('-£', '')) || 0;
    }
    
    const shippingText = document.getElementById('shipping-cost').textContent;
    const shippingCost = parseFloat(shippingText.replace('£', '')) || 3.99;
    
    const giftWrapCheckbox = document.getElementById('giftWrap');
    const giftWrapCost = giftWrapCheckbox.checked ? 2.99 : 0;
    
    const taxRate = <?php echo $tax_rate; ?>;
    const tax = (subtotal + giftWrapCost) * taxRate;
    const total = subtotal + shippingCost + tax + giftWrapCost - discount;
    
    document.getElementById('tax-display').textContent = '£' + tax.toFixed(2);
    document.getElementById('total-display').textContent = total.toFixed(2);
    document.getElementById('total-amount').textContent = '£' + total.toFixed(2);
    document.getElementById('total_amount_input').value = total.toFixed(2);
}

document.querySelectorAll('input[name="shipping"]').forEach(radio => {
    radio.addEventListener('change', function() {
        let shippingCost = 3.99;
        if(this.value === 'nextday') {
            shippingCost = 6.99;
        } else if(this.value === 'express') {
            shippingCost = 9.99;
        }
        
        document.getElementById('shipping-cost').textContent = '£' + shippingCost.toFixed(2);
        
        updateTotal();
    });
});

document.getElementById('giftWrap').addEventListener('change', function(e) {
    updateTotal();
});
        
document.addEventListener('DOMContentLoaded', function() {
    loadBasketFromLocalStorage();
    
    const raw = localStorage.getItem('gamehaven_basket_state_v1');
    if (raw) {
        try {
            const basketData = JSON.parse(raw);
            const { discount = 0, promoUsed = false } = basketData;
            
            if (discount > 0) {
                const subtotalText = document.getElementById('subtotal-display').textContent;
                const subtotal = parseFloat(subtotalText.replace('£', '')) || 0;
                
                const shippingText = document.getElementById('shipping-cost').textContent;
                const shipping = parseFloat(shippingText.replace('£', '')) || 3.99; 
                
                const taxRate = <?php echo $tax_rate; ?>;
                const tax = subtotal * taxRate;
                const total = subtotal + shipping + tax - discount;
                
                document.getElementById('total-display').textContent = total.toFixed(2);
                document.getElementById('total-amount').textContent = '£' + total.toFixed(2);
                document.getElementById('total_amount_input').value = total.toFixed(2);
                
                document.getElementById('discount_input').value = discount;
                document.getElementById('promo_used_input').value = promoUsed;
                
                const discountRow = document.getElementById('discount-row');
                discountRow.style.display = 'flex';
                document.getElementById('discount-display').textContent = '-£' + discount.toFixed(2);
            } else {
                document.getElementById('discount_input').value = discount;
                document.getElementById('promo_used_input').value = promoUsed;
            }
        } catch (error) {
            console.error('Error parsing basket data:', error);
        }
    }
    
    updateTotal();
});
        
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    const cardNumber = document.getElementById('cardNumber').value;
    const expiry = document.getElementById('expiry').value;
    const cvv = document.getElementById('cvv').value;
    const nameOnCard = document.getElementById('nameOnCard').value;
    
    const postcode = document.getElementById('postcode').value;
    const postcodeRegex = /^[A-Z]{1,2}[0-9][A-Z0-9]? ?[0-9][A-Z]{2}$/i;
    if(!postcodeRegex.test(postcode)) {
        e.preventDefault();
        alert('Please enter a valid UK postcode (e.g., SW1A 1AA, M1 1AA, EH12 1AA).');
        return false;
    }
    
    if(!nameOnCard) {
        e.preventDefault();
        alert('Please enter the name on card.');
        return false;
    }
    
    if(!cardNumber || !expiry || !cvv) {
        e.preventDefault();
        alert('Please fill in all credit card details.');
        return false;
    }
    
    if(cardNumber.replace(/\s/g, '').length !== 16) {
        e.preventDefault();
        alert('Please enter a valid 16-digit card number.');
        return false;
    }
    
    const expiryRegex = /^(0[1-9]|1[0-2])\/([0-9]{2})$/;
    if(!expiryRegex.test(expiry)) {
        e.preventDefault();
        alert('Please enter a valid expiry date in MM/YY format.');
        return false;
    }
    
    if(!/^\d{3,4}$/.test(cvv)) {
        e.preventDefault();
        alert('Please enter a valid 3 or 4 digit CVV.');
        return false;
    }
    
    if(!document.getElementById('terms').checked) {
        e.preventDefault();
        alert('You must agree to the Terms and Conditions.');
        return false;
    }
});

document.getElementById('cardNumber').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    let matches = value.match(/\d{4,16}/g);
    let match = matches && matches[0] || '';
    let parts = [];
    
    for(let i=0, len=match.length; i<len; i+=4) {
        parts.push(match.substring(i, i+4));
    }
    
    if(parts.length) {
        e.target.value = parts.join(' ');
    } else {
        e.target.value = value;
    }
});

document.getElementById('expiry').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    
    if(value.length >= 2) {
        value = value.substring(0,2) + '/' + value.substring(2,4);
    }
    
    e.target.value = value;
});

document.getElementById('postcode').addEventListener('blur', function(e) {
    e.target.value = e.target.value.toUpperCase().trim();
});
</script>
</html>