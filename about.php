<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
    <h1>About Us</h1>

    <p>Welcome to our online store! We are committed to providing the best products at the most affordable prices. Our team is passionate about helping you find the perfect items to meet your needs.</p>

    <h2>Our Mission</h2>
    <p>We aim to provide our customers with an exceptional shopping experience, offering high-quality products and excellent customer service. We believe in making shopping easier, faster, and more enjoyable for everyone!</p>

    <h2>Our Team</h2>
    <p>Our dedicated team works around the clock to ensure that our customers receive the best service possible. From product selection to delivery, we strive to provide the best experience for every customer.</p>
</main>

<footer>
    <p>&copy; 2025 Our Online Store. All rights reserved.</p>
</footer>

</body>
</html>
