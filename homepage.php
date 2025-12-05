<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Game Haven | Home</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
    background:#32043A;
    color:#F5E9FF;
    margin:0;
    font-family:Arial,Helvetica,sans-serif;
    transition:0.3s;
}

.light-mode{
    background:#F5E9FF;
    color:#32043A;
}

/* HEADER NAV  */

header{
    background:#5E0766;
    border-bottom:3px solid #F5E9FF;
    padding:15px;
}

.nav-container{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo img{
    width:55px;
    height:55px;
}

/* SEARCH BAR */

.search-bar input{
    padding:6px;
    border-radius:6px;
    border:2px solid #32043A;
    width:210px;
}

.search-bar button{
    padding:6px 12px;
    background:white;
    border-radius:6px;
    border:none;
    font-weight:bold;
    cursor:pointer;
}

/* ICON BUTTONS */
.icon-btn{
    background:none;
    border:none;
    color:white;
    cursor:pointer;
    font-size:18px;
}

/* MAIN NAV */

nav{
    display:flex;
    justify-content:center;
    gap:40px;
    background:#5E0766;
    padding:12px 0;
}

nav a{
    text-decoration:none;
    color:#F5E9FF;
    font-weight:bold;
    font-size:16px;
}

.light-mode nav a{
    color:#32043A;
}

/* FEATURED PRODUCTS */

.featured{
    text-align:center;
    padding:40px 0;
}

.products{
    display:flex;
    justify-content:center;
    gap:30px;
    flex-wrap:wrap;
}

.card{
    background:#5E0766;
    width:300px;
    border:2px solid #F5E9FF;
    border-radius:10px;
    padding:10px;
    text-align:center;
}

.light-mode .card{
    background:#E6D5FF;
    border:2px solid #32043A;
}

.card img{
    width:100%;
    height:200px;
    object-fit:contain;
}

.card a{
    display:inline-block;
    background:#F5E9FF;
    color:#32043A;
    padding:8px 12px;
    font-weight:bold;
    text-decoration:none;
    border-radius:6px;
    margin-top:10px;
}

.light-mode .card a{
    background:#32043A;
    color:#F5E9FF;
}

footer{
    text-align:center;
    padding:20px;
    background:#5E0766;
    border-top:3px solid #F5E9FF;
}

</style>

</head>
<body>

<header>
    <div class="nav-container">

        <div class="logo">
            <img src="images/GameHaven.png">
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Search products...">
            <button>Go</button>
        </div>

        <div class="account-icons">
            <a class="icon-btn"><i class="fa-solid fa-cart-shopping"></i></a>
            <a class="icon-btn" href="login.php"><i class="fa-solid fa-user"></i></a>

            <button id="toggle" class="icon-btn">
                <i class="fa-solid fa-moon"></i>
            </button>
        </div>

    </div>
</header>

<<nav>
    <a href="homepage.php">HOME</a>
    <a href="products.php">PRODUCTS</a>
    <a href="About-Us.php">ABOUT US</a>
    <a href="contact.php">CONTACT US</a>
</nav>

<section class="featured">
    <h2>Featured Gaming Deals</h2>
    <p>Next-gen consoles at unbeatable prices.</p>

    <div class="products">

        <div class="card">
            <img src="images/PS5.png">
            <h3>PlayStation 5</h3>
            <p>£479.99</p>
            <a href="product.php?id=ps5">View Product</a>
        </div>

        <div class="card">
            <img src="images/PS5 PRO.png">
            <h3>PlayStation 5 Pro</h3>
            <p>£699.99</p>
            <a href="product.php?id=ps5pro">View Product</a>
        </div>

        <div class="card">
            <img src="images/Xbox X.png">
            <h3>Xbox Series X</h3>
            <p>£449.99</p>
            <a href="product.php?id=xbox">View Product</a>
        </div>

    </div>
</section>

<footer>
    © 2025 Game Haven. All rights reserved.
</footer>

<script>
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
