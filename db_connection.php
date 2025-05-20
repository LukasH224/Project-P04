<?php
// Database connection settings
$host = 'localhost';        // Your database host (usually 'localhost')
$dbname = 'shoes';   // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Creating a new PDO instance and setting error mode to exception for error handling
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error handling
} catch (PDOException $e) {
    // Displaying a custom error message if connection fails
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
?>
