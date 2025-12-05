<?php
session_start();

if (!isset($_SESSION["basket"])) {
    $_SESSION["basket"] = [];
}

if (isset($_POST["add"])) {
    $id = $_POST["product_id"];
    $_SESSION["basket"][] = $id;
    header("Location: Basket.php");
    exit;
}

$products = [
    "ps5" => ["PlayStation 5","£479.99","images/PS5.png","Fast SSD, ray tracing & haptic feedback."],
    "ps5pro" => ["PlayStation 5 Pro","£699.99","images/PS5 PRO.png","Enhanced GPU & 120Hz performance."],
    "xbox" => ["Xbox Series X","£449.99","images/Xbox X.png","True 4K gaming & Game Pass support."],
    "xboxs" => ["Xbox Series S","£249.99","images/Xbox S.png","Compact next-gen console."],
    "switch2" => ["Nintendo Switch 2","£329.99","images/Nintendo switch 2.png","Hybrid play & improved performance."],
    "bo7" => ["Call of Duty: Black Ops 7","£69.99","images/BO7.png","Tactical action & multiplayer."],
    "fifa25" => ["EA Sports FC 25","£69.99","images/EA Sports FC 25.png","Realistic gameplay & leagues."],
    "fifa24" => ["EA Sports FC 24","£89.99","images/EA Sports FC 25.png","Ultimate edition upgrade."],
    "dbs" => ["Dragon Ball Sparking Zero","£59.99","images/DBS.png","Explosive arena battles."],
    "undisputed" => ["Undisputed Boxing","£49.99","images/Undisputed.png","Licensed fighters & realism."],
    "nfl" => ["Madden NFL 26","£59.99","images/NFL.png","Improved mechanics & franchise mode."],
    "ps5controller" => ["PS5 DualSense Controller","£59.99","images/PS5con.png","Haptic feedback & adaptive triggers."],
    "ps5merch" => ["PS5 Mug","£39.99","images/PS5Merch.png","Official PS5 mug merch."],
    "pcgaming" => ["Gaming PC Tower","£999.99","images/PC.png","High-performance RGB PC."]
];

$id = $_GET["id"] ?? "";
$p = $products[$id] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Game Haven | Product</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{background:#32043A;color:#F5E9FF;margin:0;font-family:Arial,Helvetica,sans-serif}
header{background:#5E0766;border-bottom:4px solid #F5E9FF;padding:15px 25px}
.nav-container{display:flex;justify-content:space-between;align-items:center}
.logo{display:flex;align-items:center}
.logo img{width:50px;height:50px;margin-right:10px}
.search-bar input{padding:7px;border-radius:6px;border:2px solid #32043A;width:220px}
.search-bar button{padding:7px 12px;background:white;color:#32043A;border:none;border-radius:6px;font-weight:bold;cursor:pointer}
.account-icons a{color:white;text-decoration:none;font-weight:bold}
nav{display:flex;justify-content:center;gap:25px;background:#5E0766;padding:12px 25px}
nav a{text-decoration:none;color:#F5E9FF;font-weight:bold}
.single{display:flex;justify-content:center;align-items:center;gap:40px;padding:40px;flex-wrap:wrap}
.box{background:#5E0766;border:2px solid #F5E9FF;padding:25px;border-radius:12px;text-align:center;width:360px}
.box img{width:100%;height:260px;object-fit:contain;border:2px solid #F5E9FF;border-radius:10px}
.price{font-size:22px;font-weight:bold;margin-top:10px}
.buy{background:#F5E9FF;color:#32043A;font-weight:bold;padding:10px 16px;border-radius:6px;margin-top:12px;text-decoration:none;display:inline-block;border:none;cursor:pointer}
.light-mode{background:white;color:black}
.light-mode nav,.light-mode header{background:#E6E6E6;border-color:black}
.light-mode .box{background:white;border-color:black;color:black}
</style>
</head>
<body>

<header>
    <div class="nav-container">
        <div class="logo">
            <img src="images/logo.png">
        </div>

        <div class="search-bar">
            <input id="searchInput" type="text" placeholder="Search...">
            <button onclick="performSearch()">Go</button>
        </div>

        <button id="toggle" class="icon-btn"><i class="fa-solid fa-moon"></i></button>

        <div class="account-icons">
            <a href="#">Login</a>
            <a href="Basket.php"><i class="fa-solid fa-basket-shopping"></i></a>
        </div>
    </div>
</header>

<nav>
    <a href="homepage.php">HOME</a>
    <a href="products.php">PRODUCTS</a>
    <a href="About-Us.php">ABOUT US</a>
    <a href="contact.php">CONTACT US</a>
</nav>

<section class="single">
<?php if($p): ?>
    <div class="box">
        <img src="<?= $p[2] ?>">
        <h2><?= $p[0] ?></h2>
        <p class="price"><?= $p[1] ?></p>
        <p><?= $p[3] ?></p>

        <form method="POST">
            <input type="hidden" name="product_id" value="<?= $id ?>">
            <button type="submit" name="add" class="buy">Add to Basket</button>
        </form>
    </div>
<?php else: ?>
    <h2>Product Not Found</h2>
<?php endif; ?>
</section>

<script>
function performSearch(){}
const toggleBtn=document.getElementById("toggle");
if(localStorage.getItem("theme")==="light"){document.body.classList.add("light-mode");toggleBtn.innerHTML='<i class="fa-solid fa-sun"></i>'}
toggleBtn.addEventListener("click",()=>{document.body.classList.toggle("light-mode");
if(document.body.classList.contains("light-mode")){toggleBtn.innerHTML='<i class="fa-solid fa-sun"></i>';localStorage.setItem("theme","light")}
else{toggleBtn.innerHTML='<i class="fa-solid fa-moon"></i>';localStorage.setItem("theme","dark")}})
</script>

</body>
</html>
