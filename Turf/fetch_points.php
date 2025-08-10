<?php
// Database connection variables
$servername = "localhost";  // Replace with your database host
$username = "root";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "tokutoku";       // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username from the GET request
$customerUsername = $_GET['customerusername'];

// Query to check if the username exists and fetch the points
$sql = "SELECT point FROM rewardpoints WHERE customerusername = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $customerUsername);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($points);

// Check if the username exists in the database
if ($stmt->num_rows > 0) {
    $stmt->fetch();  // Fetch the points for the username
    echo json_encode(["points" => $points]);
} else {
    echo json_encode(["points" => null, "message" => "Username not found"]);
}

// Close the connection
$stmt->close();
$conn->close();
?>
