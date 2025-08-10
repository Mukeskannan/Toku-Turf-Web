<?php
header("Content-Type: application/json");

$servername = "localhost"; // Change if needed
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "tokutoku"; // Database name

// Connect to Database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed!"]));
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);
$user = $data['username'];

// Check if user exists in rewardpoints table
$sql = "SELECT point FROM rewardpoints WHERE customerusername = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $points = $row['point'];

    if ($points >= 100) {
        // Deduct 100 points
        $new_points = $points - 100;
        $update_sql = "UPDATE rewardpoints SET point = ? WHERE customerusername = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("is", $new_points, $user);
        $update_stmt->execute();

        echo json_encode(["success" => true, "message" => "Points deducted successfully!", "remainingPoints" => $new_points]);
    } else {
        echo json_encode(["success" => false, "message" => "Not enough points!"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "User not found!"]);
}

$conn->close();
?>
