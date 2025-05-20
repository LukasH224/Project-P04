<?php
session_start();
require_once 'db_connection.php';

// Check if the shoe ID is passed in the URL
if (isset($_GET['id'])) {
    $shoe_id = $_GET['id'];

    // Fetch product details from the database
    $query = "SELECT * FROM shoes WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$shoe_id]);
    $product = $stmt->fetch();

    // If product not found, redirect to home page
    if (!$product) {
        header('Location: home.php');
        exit();
    }
} else {
    // If no ID is passed, redirect to home page
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['type']); ?> - Product Details</title>
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
    <h1><?php echo htmlspecialchars($product['type']); ?> - Product Details</h1>

    <section class="product-details">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($product['image']); ?>" alt="<?php echo htmlspecialchars($product['type']); ?>" width="400">
        
        <h2>Description</h2>
        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
        
        <h2>Price</h2>
        <p><?php echo htmlspecialchars($product['price']); ?> USD</p>
        
        <!-- Add any additional details you want here -->

        <a href="home.php">Back to Products</a>
    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Online Store. All rights reserved.</p>
</footer>

</body>
</html>
