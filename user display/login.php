<?php

session_start();

$servername = "localhost";
$username = "root";
$password = ""; // Assuming you have no password set for the root user
$dbname = "mytest";

// Create connection
$connection = new mysqli("localhost","root","","mytest");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize user input to prevent SQL Injection
    $email = $connection->real_escape_string($email);

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $connection->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: landing.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "User not found";
    }
}

// Close connection
$connection->close();
?>
?>