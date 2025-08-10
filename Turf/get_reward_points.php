<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "tokutoku";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Database Connection Failed"]));
}

// Get data from frontend
$data = json_decode(file_get_contents("php://input"), true);
$customerusername = $conn->real_escape_string($data['customerusername']);

// Query to fetch reward points
$sql = "SELECT point FROM rewardpoints WHERE customerusername = '$customerusername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(["success" => true, "point" => $row['point']]);
} else {
    echo json_encode(["success" => false, "point" => 0]);
}

$conn->close();
?>
