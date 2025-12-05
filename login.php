<?php
session_start();
require_once "db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

   
    $stmt = $pdo->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    
    if ($user && password_verify($password, $user['password'])) {

        
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["full_name"];

        echo "<script>alert('Login successful!'); window.location='About-Us.php';</script>";
        exit();

    } else {
        echo "<script>alert('Incorrect email or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Haven - Login</title>
    <link rel="stylesheet" href="styles.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>




<header>
    <div class="nav-container">

        <div class="logo">
            <img src="gamehavenlogo.png" height="50px" width="50px" alt="Game Haven Logo">
            <span>GAME HAVEN</span>
        </div>

        <div class="search-bar">
            <input id="searchInput" type="text" placeholder="Search...">
            <a href="products.html"><button>Go</button></a>
        </div>

        <div class="account-icons">

            <?php if (isset($_SESSION["user_id"])): ?>

                <!-- Show welcome message -->
                <span class="welcome-text">Welcome, <?= htmlspecialchars($_SESSION["user_name"]); ?></span>

                <!-- Logout button -->
                <a href="logout.php" class="icon-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>

            <?php else: ?>

                <!-- Login button when user is NOT logged in -->
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
             <a href="product.php">PRODUCTS</a>
            <a href="About-Us.php">ABOUT</a>
            <a href="contact.php">CONTACT</a>
        
        
        </nav>

<div class="form-container">
    <h2>LOGIN</h2>

   <form action="login.php" method="POST">

    <label>Email</label>
    <input type="email" name="email" placeholder="Enter email" class="form-input" required>

    <label>Password</label>
    <input type="password" name="password" placeholder="Enter password" class="form-input" required>

    <div class="remember-me">
        <input type="checkbox" id="remember">
        <label for="remember">Remember Me</label>
    </div>

    <button type="submit" class="submit-btn">Log In</button>

    <a href="#" class="forgot">Forgot Password?</a>

    <p class="register-text">
        Don’t have an account? <a href="register.php">Register here</a>
    </p>

</form>

</div>

            
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
