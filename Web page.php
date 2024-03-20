<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "realestate";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// User login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["username"] = $username;
        echo "Login successful";
    } else {
        echo "Invalid username or password";
    }
}

// Search functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $location = $_POST["location"];
    $budget = $_POST["budget"];

    // Perform search query and display results
    // Example: $sql = "SELECT * FROM properties WHERE location='$location' AND price<=$budget";
}

// Close connection
$conn->close();
?>
