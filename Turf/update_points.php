<?php
$host = "localhost";
$user = "root"; // Change if needed
$pass = ""; // Change if needed
$dbname = "tokutoku";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['customerusername'];

    // Check if user exists
    $sql = "SELECT point FROM rewardpoints WHERE customerusername = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // User exists, increment points
        $stmt->bind_result($point);
        $stmt->fetch();
        $newPoint = $point + 1;
        $update_sql = "UPDATE rewardpoints SET point = ? WHERE customerusername = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("is", $newPoint, $username);
        $update_stmt->execute();
        echo "Points updated successfully!";
    } else {
        // User does not exist, insert new record
        $insert_sql = "INSERT INTO rewardpoints (customerusername, point) VALUES (?, 1)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("s", $username);
        $insert_stmt->execute();
        echo "New user added and point initialized!";
    }
}
$conn->close();
?>
