<?php
session_start(); // Start session

// Database connection
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "tokutoku";

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from form
$tusername = $_POST["tusername"] ?? '';
$tpassword = $_POST["tpassword"] ?? '';

// Validate input
if (empty($tusername) || empty($tpassword)) {
    echo "<script type='text/javascript'>alert('Username or Password cannot be empty!');</script>";
    exit();
}

// Check if tusername exists in the "register" table
$sql = "SELECT * FROM register WHERE tusername = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tusername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verify tpassword
    if ($tpassword == $row['tpassword']) { // Use password_verify() if passwords are hashed
        $_SESSION["tusername"] = $tusername; // Store session
        $_SESSION["tuseremail"] = $row["tuseremail"];
        $_SESSION["tusernumber"] = $row["tusernumber"];
        $_SESSION["tuserlocation"] = $row["tuserlocation"];
        $_SESSION["age"] = $row["age"];
        echo "<script type='text/javascript'>alert('Login successful! Redirecting...');</script>";
        echo "<script>window.location.href = '../toku.php';</script>"; // Correct way to redirect in PHP + JavaScript
        exit();
    } else {
        echo "<script type='text/javascript'>alert('Invalid Password!');</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('User not found!');</script>";
}

$stmt->close();
$conn->close();
?>
