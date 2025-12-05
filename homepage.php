<?php
session_start();
?>
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


header{
    background:#5E0766;
    border-bottom:3px solid #F5E9FF;
    padding:12px 24px;
}
.nav-container{
    max-width:1300px;
    margin:0 auto;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
}
.logo{
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:bold;
    font-size:20px;
}

.logo img{
    width:55px;
    height:55px;
}

/* search bar */
.search-bar{
    flex:1;
    display:flex;
    justify-content:center;
    gap:6px;
}
.search-bar input{
    width:360px;
    max-width:100%;
    padding:8px 10px;
    border-radius:999px;
    border:none;
    background:#F5E9FF;
    color:#32043A;
    font-size:14px;
}
.search-bar button{
    padding:8px 18px;
    border-radius:999px;
    border:none;
    background:#F5E9FF;
    color:#5E0766;
    font-weight:bold;
    cursor:pointer;
}

/* account icons + toggle */
.account-icons{
    display:flex;
    align-items:center;
    gap:10px;
}
.icon-btn{
    padding:8px 14px;
    border-radius:999px;
    border:2px solid #F5E9FF;
    background:transparent;
    color:#F5E9FF;
    cursor:pointer;
    text-decoration:none;
    font-size:14px;
    display:inline-flex;
    align-items:center;
    gap:6px;
}
.icon-btn i{
    font-size:14px;
}
#toggle.icon-btn{
    padding:8px 10px;
}

/* MAIN NAV BAR */
nav{
    background:#5E0766;
    border-top:1px solid rgba(245,233,255,0.15);
    padding:14px 0 20px;
}
.nav-links{
    max-width:900px;
    margin:0 auto;
    display:flex;
    justify-content:center;
    gap:18px;
}
.nav-links a{
    padding:8px 20px;
    border-radius:999px;
    border:2px solid #F5E9FF;
    color:#F5E9FF;
    text-decoration:none;
    font-weight:bold;
    font-size:14px;
}
.nav-links a.active{
    background:#F5E9FF;
    color:#32043A;
}


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
    margin-top:40px;
}

/* light mode tweaks */
.light-mode header,
.light-mode nav{
    background:#E4D8FF;
    border-color:#32043A;
}
.light-mode .nav-links a{
    border-color:#32043A;
    color:#32043A;
}
.light-mode .nav-links a.active{
    background:#32043A;
    color:#F5E9FF;
}
.light-mode .icon-btn{
    border-color:#32043A;
    color:#32043A;
}
.light-mode .search-bar input,
.light-mode .search-bar button{
    background:#ffffff;
    color:#32043A;
}
</style>
</head>
<body>

<header>
    <div class="nav-container">

         <div class="logo">
            <img src="gamehavenlogo.png" alt="Logo">
            <span>GAME HAVEN</span>
        </div>

        <form class="search-bar" onsubmit="return searchProduct(event)">
            <input id="searchBox" type="text" placeholder="Search products...">
            <button type="submit">Go</button>
        </form>

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
                <i class="fa-solid fa-cart-shopping"></i>
            </a>

            <button id="toggle" class="icon-btn">
                <i class="fa-solid fa-moon"></i>
            </button>
        </div>

    </div>
</header>

<nav>
    <div class="nav-links">
        <a href="homepage.php" class="active">HOME</a>
        <a href="products.php">PRODUCTS</a>
        <a href="About-Us.php">ABOUT</a>
        <a href="contact.php">CONTACT</a>
    </div>
</nav>

<section class="featured">
    <h2>Featured Gaming Deals</h2>
    <p>Next-gen consoles at unbeatable prices.</p>

    <div class="products">

        <div class="card">
            <img src="images/PS5.png" alt="PlayStation 5">
            <h3>PlayStation 5</h3>
            <p>£479.99</p>
            <a href="product.php?id=ps5">View Product</a>
        </div>

        <div class="card">
            <img src="images/PS5 PRO.png" alt="PlayStation 5 Pro">
            <h3>PlayStation 5 Pro</h3>
            <p>£699.99</p>
            <a href="product.php?id=ps5pro">View Product</a>
        </div>

        <div class="card">
            <img src="images/Xbox X.png" alt="Xbox Series X">
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
function searchProduct(e){
    e.preventDefault();
    const search=document.getElementById("searchBox").value.toLowerCase();
    const map={
        "ps5":"ps5",
        "playstation 5":"ps5",
        "ps5 pro":"ps5pro",
        "playstation 5 pro":"ps5pro",
        "xbox series x":"xbox",
        "xbox x":"xbox",
        "series x":"xbox"
    };
    if(map[search]){
        window.location="product.php?id="+map[search];
    }else{
        alert("Product not found");
    }
}

const toggleBtn=document.getElementById("toggle");
if(localStorage.getItem("theme")==="light"){
    document.body.classList.add("light-mode");
    toggleBtn.innerHTML='<i class="fa-solid fa-sun"></i>';
}
toggleBtn.addEventListener("click",()=>{
    document.body.classList.toggle("light-mode");
    if(document.body.classList.contains("light-mode")){
        toggleBtn.innerHTML='<i class="fa-solid fa-sun"></i>';
        localStorage.setItem("theme","light");
    }else{
        toggleBtn.innerHTML='<i class="fa-solid fa-moon"></i>';
        localStorage.setItem("theme","dark");
    }
});
</script>

</body>
</html>
