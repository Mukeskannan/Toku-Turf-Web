<?php
session_start();

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$tusername     = $_POST['tusername'];
$tuseremail = $_POST['tuseremail'];
$tusernumber  = $_POST['tusernumber'];
$tuserlocation  = $_POST['tuserlocation'];
$tpassword = $_POST['tuserpassword'];
$age     = $_POST['age'];


if (
    !empty($tusername) && 
    !empty($tuseremail) && 
    !empty($tusernumber) && 
    !empty($tuserlocation) && 
    !empty($tpassword) && 
    !empty($age)
    
    ){
        $host = "localhost";
        $dbusername="root";
        $dbpassword="";
        $dbname="tokutoku";


    // Create a new mysqli connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // Check if turfContact already exists
    $SELECT = "SELECT tuseremail FROM register WHERE tuseremail = ?";
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $tuseremail);
    $stmt->execute();
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    $stmt->close();

        
    if ($rnum == 0) {
        // Build the INSERT statement dynamically
        $columns = [
            'tusername',
            'tuseremail',
            'tusernumber',
            'tuserlocation',
            'tpassword',  
            'age'
        ];
        
    
$null = null;

        $placeholders = array_fill(0, count($columns), '?');
        $types = 'sssssi';
        $params = [
            $tusername,
            $tuseremail,
            $tusernumber,
            $tuserlocation,
            $tpassword,  
            $age
        ];
        

        $columnsList = implode(', ', $columns);
        $placeholdersList = implode(', ', $placeholders);

        $INSERT = "INSERT INTO register ($columnsList) VALUES ($placeholdersList)";
        $insertStmt = $conn->prepare($INSERT);

        if ($insertStmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Bind parameters dynamically
        $bindParams = array_merge([$types], $params);
        $bindParamsReferences = [];

        foreach ($bindParams as $key => $value) {
            $bindParamsReferences[$key] = &$bindParams[$key];
        }

        call_user_func_array([$insertStmt, 'bind_param'], $bindParamsReferences);

    

        // Execute the statement
        if ($insertStmt->execute()) {
            echo "<script type='text/javascript'>alert('NEW RECORD INSERTED SUCCESSFULLY')</script>";
        } else {
            die('Execute failed: ' . htmlspecialchars($insertStmt->error));
        }
        $insertStmt->close();
    } else {
        echo "<script type='text/javascript'>alert('SOMEONE ALREADY REGISTERED USING THIS CONTACT NUMBER')</script>";
    }
    $conn->close();
} else {
    echo  "<script type='text/javascript'>alert('All required fields must be filled and files uploaded.')</script>";
    die();
}
?>