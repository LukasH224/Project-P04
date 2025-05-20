<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
$sucess;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET email = ?, password = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email, $password, $_SESSION['user_id']]);
        $sucess = "your password has been updates!";
    } else {
        $query = "UPDATE users SET email = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email, $_SESSION['user_id']]);
    }

    header('Location: profile.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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



<h2>Welcome, <?php echo htmlspecialchars($user['username']); ?></h2>

<form action="profile.php" method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
    
    <label>New Password:</label><br>
    <input type="password" name="password" placeholder="Leave blank to keep current password"><br>

    <button type="submit" name="update">Update Profile</button>
</form>

<?php
if (isset($sucess)){
    echo $sucess;
}

?>

</body>
</html>
