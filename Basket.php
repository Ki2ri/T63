<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>GameHaven Basket</title>
<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root{
  --bg:#19021C;
  --purple:#5E0766;
  --panel:#2A0A33;
  --accent:#F5E9FF;
  --muted:#9EA3A8;
}

body {
  font-family: 'Segoe UI', Arial, sans-serif;
  background: var(--bg);
  color: var(--accent);
  margin: 0;
}

header {
  background: var(--purple);
  padding: 14px 20px;
}

.nav-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.logo {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 1.4rem;
  font-weight: bold;
}

.logo img { height: 50px; }

.search-bar { display: flex; gap: 8px; }
.search-bar input {
  padding: 8px;
  background: rgba(255,255,255,0.1);
  border-radius: 6px;
  border: none;
  color: var(--accent);
}
.search-bar button {
  padding: 8px 12px;
  background: var(--accent);
  color: var(--bg);
  font-weight: bold;
  border-radius: 6px;
  cursor: pointer;
}

.account-icons {
  display: flex;
  align-items: center;
  gap: 12px;
}

.icon-btn {
  padding: 8px 12px;
  border-radius: 6px;
  border: 2px solid var(--accent);
  background: var(--purple);
  color: var(--accent);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
  font-weight: bold;
}

nav {
  background: var(--bg);
  padding: 14px 0;
  text-align: center;
}

nav a {
  margin: 0 14px;
  color: var(--accent);
  text-decoration: none;
  font-weight: bold;
}
nav a:hover {
  padding: 4px 8px;
  background: var(--accent);
  color: var(--bg);
  border-radius: 6px;
}

.container {
  max-width: 1300px;
  margin: 40px auto;
  padding: 0 20px;
}

.page-title { font-size: 1.7rem; margin-bottom: 20px; }

.grid {
  display: grid;
  grid-template-columns: 1fr 360px;
  gap: 28px;
}

table {
  width: 100%;
  background: var(--purple);
  border-radius: 10px;
  border-collapse: collapse;
  overflow: hidden;
}

thead th {
  background: var(--bg);
  padding: 14px;
}

tbody td {
  background: var(--panel);
  padding: 12px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

.suggestions-title { margin: 30px 0 12px; }

.suggestions {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px,1fr));
  gap: 18px;
}

.suggestion-item {
  background: var(--panel);
  padding: 12px;
  text-align: center;
  border-radius: 8px;
}

.suggestion-item img {
  width: 100%;
  height: 110px;
  object-fit: cover;
  border-radius: 6px;
}

.side-panel {
  background: rgba(46,9,53,0.6);
  padding: 18px;
  border-radius: 12px;
}

.summary-row, .summary-total {
  display: flex;
  justify-content: space-between;
  margin: 10px 0;
}

.summary-total {
  border-top: 1px dashed rgba(255,255,255,0.3);
  padding-top: 12px;
  font-weight: bold;
}

.checkout-btn {
  width: 100%;
  padding: 12px;
  background: var(--purple);
  color: var(--accent);
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
}
.checkout-btn:hover {
  background: var(--accent);
  color: var(--bg);
}
</style>
</head>

<body>

<header>
  <div class="nav-container">

    <div class="logo">
      <a href="index.php">
        <img src="gamehavenlogo.png" alt="Game Haven Logo">
      </a>
      <span>GAME HAVEN</span>
    </div>

    <div class="search-bar">
      <input type="text" placeholder="Search products...">
      <a href="products.php"><button>Search</button></a>
    </div>

    <div class="account-icons">

      <?php if(isset($_SESSION["user_id"])): ?>
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
      </a>

    </div>

  </div>
</header>

<nav>
  <a href="index.php">Home</a>
  <a href="products.php">Products</a>
  <a href="About-Us.php">About</a>
  <a href="contact.php">Contact</a>
  <a href="Basket.php">Basket</a>
</nav>

<div class="container">
  <h2 class="page-title">Your Basket</h2>

  <div class="grid">
    <section>
      <table>
        <thead>
          <tr>
            <th>Product</th><th>Category</th><th>Price</th><th>Qty</th><th>Subtotal</th><th>Remove</th>
          </tr>
        </thead>
        <tbody id="basketBody">
          <tr><td colspan="6" style="text-align:center; padding:20px;">No items in basket</td></tr>
        </tbody>
      </table>

      <h3 class="suggestions-title">You Might Also Like</h3>
      <div class="suggestions" id="suggestionsContainer"></div>
    </section>

    <aside class="side-panel">
      <div class="summary-row"><span>Subtotal</span><span>£0.00</span></div>
      <div class="summary-row"><span>Discount</span><span>£0.00</span></div>
      <div class="summary-row"><span>Delivery</span><span>£3.99</span></div>
      <div class="summary-total"><span>Total</span><span>£0.00</span></div>
      <button class="checkout-btn">Proceed to Checkout</button>
    </aside>
  </div>
</div>

<script>
let suggestions=[
  {name:"DualSense Controller",price:59.99,image:"images/controller.jpg"},
  {name:"Razer Kraken Headset",price:89.99,image:"images/headset.jpg"},
  {name:"PS5 Charging Dock",price:29.99,image:"images/chargingdock.jpg"},
  {name:"Xbox Wireless Controller",price:54.99,image:"images/xboxcontroller.jpg"}
];

function escapeHtml(s){ return String(s).replace(/</g,"&lt;"); }

function renderSuggestions(){
  const c=document.getElementById("suggestionsContainer");
  c.innerHTML="";
  suggestions.forEach(s=>{
    c.innerHTML+=`
      <div class="suggestion-item">
        <img src="${s.image}">
        <h4>${escapeHtml(s.name)}</h4>
        <p>£${s.price.toFixed(2)}</p>
      </div>`;
  });
}

document.addEventListener("DOMContentLoaded",renderSuggestions);
</script>

</body>
</html>
