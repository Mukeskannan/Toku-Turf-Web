<?php
$servername = "localhost"; 
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "tokutoku"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username from the request
$tname = isset($_POST['tname']) ? trim($_POST['tname']) : "";

// Debugging: Log received data
file_put_contents("debug_log.txt", "Received tname: $tname\n", FILE_APPEND);

// Prepare SQL query to fetch booking details
$sql = "SELECT * FROM bookingdetails WHERE TRIM(LOWER(customer_name)) = TRIM(LOWER(?))";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tname);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

if (!empty($bookings)) {
    echo json_encode($bookings);
} else {
    echo json_encode(["error" => "No records found"]);
}

$stmt->close();
$conn->close();
?>
