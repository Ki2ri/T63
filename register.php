<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST["full_name"];
    $email     = $_POST["email"];
    $password  = $_POST["password"];
    $confirm   = $_POST["confirm"];

    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$full_name, $email, $hashed]);

            echo "<script>alert('Account created!'); window.location='login.php';</script>";
            exit();

        } catch (PDOException $e) {
            echo "<script>alert('Email already exists');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Game Haven - Register</title>
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

        <button id="toggle" class="icon-btn">
            <i class="fa-solid fa-moon"></i>
        </button>

        <div class="account-icons">

            <?php if (isset($_SESSION["user_id"])): ?>

                <span class="welcome-text">Welcome, <?= htmlspecialchars($_SESSION["user_name"]); ?></span>

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
    <a href="About-Us.php">ABOUT</a>
    <a href="contact.php">CONTACT</a>
</nav>

<div class="form-container">
    <h2>Create an Account</h2>

    <form action="register.php" method="POST">

        <label>Full Name</label>
        <input type="text" name="full_name" class="form-input" placeholder="Enter your full name" required>

        <label>Email</label>
        <input type="email" name="email" class="form-input" placeholder="Enter your email" required>

        <label>Password</label>
        <input type="password" name="password" class="form-input" placeholder="Create a password" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm" class="form-input" placeholder="Confirm your password" required>

        <button type="submit" class="submit-btn">Register</button>

        <p class="register-text">
            Already have an account? <a href="login.php">Login here</a>
        </p>

    </form>

</div>

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
