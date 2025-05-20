<?php
session_start();
require_once 'db_connection.php';

// Fetch products from the database
$query_products = "SELECT * FROM shoes";
$products = $pdo->query($query_products)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <h1>Welcome to Our Online Store</h1>

    <section class="products">
        <h2>Products</h2>
        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <h3><?php echo htmlspecialchars($product['type']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <a href="product_details.php?id=<?php echo $product['id']; ?>">View Details</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Online Store. All rights reserved.</p>
</footer>

</body>
</html>
