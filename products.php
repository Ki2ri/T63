<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Game Haven | Products</title>

<style>

body{
    background:#32043A;
    color:#F5E9FF;
    margin:0;
    font-family:Arial,Helvetica,sans-serif;
}

header{
    background:#5E0766;
    border-bottom:4px solid #F5E9FF;
    padding:15px 25px;
}

.nav-container{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    display:flex;
    align-items:center;
}

.logo img{
    width:55px;
    height:55px;
    margin-right:10px;
}

.search-bar input{
    padding:7px;
    border-radius:6px;
    border:2px solid #32043A;
    width:220px;
}

.search-bar button{
    padding:7px 12px;
    background:white;
    color:#32043A;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
}

nav{
    display:flex;
    gap:25px;
    justify-content:center;
    background:#5E0766;
    padding:12px 25px;
}

nav a{
    text-decoration:none;
    color:#F5E9FF;
    font-weight:bold;
}

.filter-buttons{
    text-align:center;
    padding:20px;
}

.filter-buttons button{
    background:#F5E9FF;
    color:#32043A;
    border:none;
    padding:10px 15px;
    font-weight:bold;
    margin:5px;
    cursor:pointer;
    border-radius:6px;
}

.products{
    display:flex;
    gap:25px;
    justify-content:center;
    flex-wrap:wrap;
    padding:20px;
}

.card{
    background:#5E0766;
    width:260px;
    padding:15px;
    border:2px solid #F5E9FF;
    border-radius:12px;
    text-align:center;
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
    text-decoration:none;
    font-weight:bold;
    border-radius:6px;
    margin-top:8px;
}

.hidden{
    display:none;
}

</style>
</head>
<body>

<header>
    <div class="nav-container">
        <div class="logo">
            <img src="images/logo.png" alt="Game Haven">
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button>Go</button>
        </div>
    </div>
</header>

<nav>
    <a href="homepage.php">HOME</a>
    <a href="products.php">PRODUCTS</a>
    <a href="About-Us.php">ABOUT US</a>
    <a href="contact.php">CONTACT US</a>
</nav>


<div class="filter-buttons">
    <button onclick="filter('all')">Show All</button>
    <button onclick="filter('console')">Consoles</button>
    <button onclick="filter('game')">Games</button>
    <button onclick="filter('accessory')">Accessories</button>
    <button onclick="filter('merch')">Merchandise</button>
    <button onclick="filter('pc')">PC Hardware</button>
</div>

<section class="products">

    <div class="card console">
        <img src="images/PS5.png">
        <h3>PlayStation 5</h3>
        <p>£479.99</p>
        <a href="product.php?id=ps5">View Product</a>
    </div>

    <div class="card console">
        <img src="images/PS5 PRO.png">
        <h3>PlayStation 5 Pro</h3>
        <p>£699.99</p>
        <a href="product.php?id=ps5pro">View Product</a>
    </div>

    <div class="card console">
        <img src="images/Xbox X.png">
        <h3>Xbox Series X</h3>
        <p>£449.99</p>
        <a href="product.php?id=xbox">View Product</a>
    </div>

    <div class="card console">
        <img src="images/Xbox S.png">
        <h3>Xbox Series S</h3>
        <p>£249.99</p>
        <a href="product.php?id=xboxs">View Product</a>
    </div>

    <div class="card console">
        <img src="images/Nintendo switch 2.png">
        <h3>Nintendo Switch 2</h3>
        <p>£329.99</p>
        <a href="product.php?id=switch2">View Product</a>
    </div>


    <div class="card game">
        <img src="images/BO7.png">
        <h3>Call of Duty BO7</h3>
        <p>£69.99</p>
        <a href="product.php?id=bo7">View Product</a>
    </div>

    <div class="card game">
        <img src="images/EA Sports FC 25.png">
        <h3>EA Sports FC 25</h3>
        <p>£69.99</p>
        <a href="product.php?id=fifa25">View Product</a>
    </div>

    <div class="card game">
        <img src="images/NFL.png">
        <h3>Madden NFL 26</h3>
        <p>£89.99</p>
        <a href="product.php?id=nfl">View Product</a>
    </div>


    <div class="card accessory">
        <img src="images/PS5con.png">
        <h3>PS5 Controller</h3>
        <p>£59.99</p>
        <a href="product.php?id=ps5controller">View Product</a>
    </div>

    <div class="card merch">
        <img src="images/PS5Merch.png">
        <h3>PS Mug</h3>
        <p>£19.99</p>
        <a href="product.php?id=ps5merch">View Product</a>
    </div>

    <div class="card pc">
        <img src="images/PC.png">
        <h3>Gaming PC Tower</h3>
        <p>£999.99</p>
        <a href="product.php?id=pcgaming">View Product</a>
    </div>

</section>

<script>

function filter(type){
    let items=document.querySelectorAll(".card");
    items.forEach(card=>{
        card.classList.remove("hidden");
        if(type!=="all" && !card.classList.contains(type)){
            card.classList.add("hidden");
        }
    });
}

</script>

</body>
</html>
