<?php
session_start();
include 'db_connection.php';

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
    <div class="logo-container">
        <h1 class="logo">Shoes R Us</h1>
    </div>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
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
        <?php foreach ($products as $product): ?>
            <div class="items">
                <h3><?php echo htmlspecialchars($product['type']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>

                <?php
                $image = $product['image'];
                $base64Image = base64_encode($image);
                ?>
                <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="<?php echo htmlspecialchars($product['type']); ?>" onError="this.onerror=null;this.src='images/default.jpg';">

                <a href="index.php?id=<?php echo $product['id']; ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    </section>
</main>

<footer>
    <p>&copy; 2025 Our Online Store. All rights reserved.</p>
</footer>

</body>
</html>
