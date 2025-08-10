<?php
// Ensure JSON response
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);
ob_clean(); // Prevent unwanted output

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "tokutoku";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Retrieve POST data
$data = json_decode(file_get_contents("php://input"), true);

// Validate received data
if (!$data) {
    echo json_encode(["error" => "Invalid input data"]);
    exit();
}

// Extract data safely
$customer_name = $data["customer_name"] ?? '';
$customer_location = $data["customer_location"] ?? '';
$customer_email = $data["customer_email"] ?? '';
$customer_date = $data["customer_date"] ?? '';
$customer_start_time = $data["customer_start_time"] ?? '';
$customer_end_time = $data["customer_end_time"] ?? '';
$turf_name = $data["turf_name"] ?? '';
$turf_location = $data["turf_location"] ?? '';
$turf_contact = $data["turf_contact"] ?? '';
$turf_totaltime = $data["turf_totaltime"] ?? '';
$turf_ttid = $data["turf_ttid"] ?? '';
$digitalpin = $data["digitalpin"] ?? '';

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO bookingdetails 
    (customer_name, customer_location, customer_email, customer_date, customer_start_time, customer_end_time, turf_name, turf_location, turf_contact, turf_totaltime, turf_ttid, digitalpin) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssssss", 
    $customer_name, $customer_location, $customer_email, $customer_date, 
    $customer_start_time, $customer_end_time, $turf_name, 
    $turf_location, $turf_contact, $turf_totaltime, $turf_ttid, $digitalpin
);

if ($stmt->execute()) {
    echo json_encode(["message" => "Booking saved successfully"]);
} else {
    echo json_encode(["error" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
