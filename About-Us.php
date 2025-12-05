<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Game Haven</title>
    <link rel="stylesheet" href="styles.css">

   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>


<header>
    <div class="nav-container">

        <div class="logo">
         <a href="index.php">
            <img src="gamehavenlogo.png" height="50px" width="50px" alt="Game Haven Logo">
             </a>
            <span>GAME HAVEN</span>
        </div>

        <div class="search-bar">
            <input id="searchInput" type="text" placeholder="Search...">
            <a href="products.html"><button>Go</button></a>
        </div>

        <button id="toggle" class="icon-btn">
            <i class="fa-solid fa-moon"></i>
        </button>

        <div class="account-icons">

            <?php if (isset($_SESSION["user_id"])): ?>
                
                <!-- Show welcome text -->
                <span class="welcome-text">Welcome, <?= htmlspecialchars($_SESSION["user_name"]); ?></span>

                <!-- Logout button -->
                <a href="logout.php" class="icon-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>

            <?php else: ?>

           
                <a href="login.php" class="icon-btn">
                    <i class="fa-solid fa-user"></i> Login
                </a>

            <?php endif; ?>

            <a href="Basket.html" class="icon-btn">
                <i class="fa-solid fa-basket-shopping"></i>
            </a>

        </div>

    </div>
</header>
<nav>
            <a href="index.php">HOME</a>
             <a href="product.html">PRODUCTS</a>
            <a href="About-Us.html" class="active">ABOUT</a>
            <a href="contact.php">CONTACT</a>
        </nav>

<section class="about-section">
    <h2>Our Mission</h2>
    <img src="PS5PRO.png" height="200px" width="200px">
    <img src="Familygaming.png" height="200px" width="200px">
    <img src="Expedition33.png" height="200px" width="200px">
    <p>
        GameHaven’s mission is to empower gamers of all levels by providing easy access to high-quality gaming technology and reliable advice. We strive to create a seamless shopping experience that combines clear navigation, detailed product information, and personalized content, helping customers make informed choices. Our goal is to be more than just a store—we aim to be a trusted companion for the gaming community, offering the latest gear, expert guidance, and a platform that evolves with the needs of today’s gamers.
    </p>
</section>
<br><br>

<section class="about-section">
    <h2>What we sell</h2>
    <p>We offer a carefully selected collection of tech for gamers and performance enthusiasts, all designed to enhance your play, creativity, and connections. You'll find the newest consoles, like PlayStation, Xbox, and Nintendo, plus limited editions and exclusive bundles you won't easily find elsewhere. For those seeking serious power, we have custom-built gaming PCs, high-performance pre-builts, and top-of-the-line components – graphics cards, processors, RAM, SSDs, cooling systems, and motherboards – so you can build your ultimate gaming rig from scratch.

To complete your setup, we also carry essential accessories: controllers, headsets, keyboards, gaming mice, capture cards, VR gear, and display upgrades that elevate visuals and responsiveness. Whether you're a casual console gamer, a competitive PC player, or a creator who needs top-tier specs, we have the gear for peak performance and guaranteed quality. Our aim is simple: provide you with the tools to play better, stream smoother, and enjoy gaming the way it should be – without compromise.</p>
</section>
<br><br>
<section class="about-section">
    <h2>Your Values</h2>
  <p>
    We are committed to honesty, quality, and player-first service. Gamers deserve trustworthy tech. That's why we rigorously test every console, component, and custom PC. We offer fair prices, transparent specs, and genuine customer support. You won't get automated responses or guesswork. Our team is passionate about gaming. We respect our community. We are dedicated to providing equipment that performs as promised. Our values are the same for casual players, streamers, and esports pros. These values are reliability, innovation, and the best gaming experience.
  </p>
  <br><br>
  <p>
    No matter if you're building your first gaming setup or upgrading a pro-level rig, we're dedicated to the same principles: dependability, openness, providing fair access to top-tier hardware, and helping every gamer reach their full potential. We offer more than just equipment; we're here to support your gaming experience, celebrate the community, and strive to make high-performance gaming available to everyone.
  </p>
</section>



<script src="script.js"></script>
<script>
  function toggleDetails(header) {
    const content = header.nextElementSibling;
    content.classList.toggle('show');
  }
 
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
    } 
   
    else {
        toggleBtn.innerHTML = '<i class="fa-solid fa-moon"></i>';
        localStorage.setItem("theme", "dark");
    }
});

</script>
</body>
</html>



