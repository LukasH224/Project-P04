<?php
// Start the session
session_start();

// Define the email to send the contact form submissions to
$to_email = "your-email@example.com"; // Replace with your email address
$success_message = '';
$error_message = '';

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Simple form validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        $subject = "Contact Form Submission from $name";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        // Send email
        if (mail($to_email, $subject, $body, $headers)) {
            $success_message = "Thank you for contacting us! We'll get back to you soon.";
        } else {
            $error_message = "There was an error sending your message. Please try again later.";
        }
    } else {
        $error_message = "Please fill out all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
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
    <h1>Contact Us</h1>

    <?php if ($success_message): ?>
        <div class="success-message">
            <p><?php echo $success_message; ?></p>
        </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="error-message">
            <p><?php echo $error_message; ?></p>
        </div>
    <?php endif; ?>

    <form action="contact.php" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="message">Message</label>
        <textarea name="message" id="message" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</main>

<footer>
    <p>&copy; 2025 Our Online Store. All rights reserved.</p>
</footer>

</body>
</html>
