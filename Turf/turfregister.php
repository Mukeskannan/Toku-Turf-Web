<?php

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$turfName     = $_POST['turfName'];
$turfLocation = $_POST['turfLocation'];
$turfAddress  = $_POST['turfAddress'];
$turfContact  = $_POST['turfContact'];
$turfType     = $_POST['turfType'];
$turfSize     = $_POST['turfSize'];
$turfSoilType = $_POST['turfSoilType'];
$turfUsage    = $_POST['turfUsage'];
$turfrules    = $_POST['turfrules'];
$adminuse    = $_POST['adminuse'];

// Handle file uploads
$turfPhotos   = $_FILES['turfPhotos'];
$turfPhoto1   = $_FILES['turfPhoto1'];
$turfPhoto2   = $_FILES['turfPhoto2'];
$turfPhoto3   = $_FILES['turfPhoto3'];
$turfVideo    = isset($_FILES['turfVideo']) ? $_FILES['turfVideo'] : null;



// Function to check if a file was uploaded successfully
function isFileUploaded($file) {
    return isset($file) && $file['error'] === UPLOAD_ERR_OK;
}

// Read file contents
$turfPhotosData = file_get_contents($turfPhotos['tmp_name']);
$turfPhoto1Data = file_get_contents($turfPhoto1['tmp_name']);
$turfPhoto2Data = file_get_contents($turfPhoto2['tmp_name']);
$turfPhoto3Data = file_get_contents($turfPhoto3['tmp_name']);






if (
    !empty($turfName) && 
    !empty($turfLocation) && 
    !empty($turfAddress) && 
    !empty($turfContact) && 
    !empty($turfType) && 
    !empty($turfSize) && 
    !empty($turfSoilType) && 
    !empty($turfUsage) && 
    !empty($turfrules) &&
    !empty($adminuse)&&
    isFileUploaded($turfPhotos) &&
    isFileUploaded($turfPhoto1) &&
    isFileUploaded($turfPhoto2) &&
    isFileUploaded($turfPhoto3) 
    
    ){
        $host = "localhost";
        $dbusername="root";
        $dbpassword="";
        $dbname="tokutoku";


    // Create a new mysqli connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // Check if turfContact already exists
    $SELECT = "SELECT turfContact FROM turfdetails WHERE turfContact = ?";
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("i", $turfContact);
    $stmt->execute();
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    $stmt->close();

        
    if ($rnum == 0) {
        // Build the INSERT statement dynamically
        $columns = [
            'turfName',
            'turfLocation',
            'turfAddress',
            'turfContact',
            'turfType',
            'turfSize',
            'turfSoilType',
            'turfUsage',
            'turfPhotos',
            'turfPhoto1',
            'turfPhoto2',
            'turfPhoto3',
            'turfrules',
            'adminuse'
        ];
        // Define $null before using it
$null = null;

        $placeholders = array_fill(0, count($columns), '?');
        $types = 'ssssssssbbbbss';
        $params = [
            $turfName,
            $turfLocation,
            $turfAddress,
            $turfContact,
            $turfType,
            $turfSize,
            $turfSoilType,
            $turfUsage,
            $null, // turfPhotos
            $null, // turfPhoto1
            $null, // turfPhoto2
            $null, // turfPhoto3
            $turfrules,
            $adminuse
        ];


        $columnsList = implode(', ', $columns);
        $placeholdersList = implode(', ', $placeholders);

        $INSERT = "INSERT INTO turfdetails ($columnsList) VALUES ($placeholdersList)";
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

        // Map column names to parameter indices for BLOB data
        $blobColumns = ['turfPhotos', 'turfPhoto1', 'turfPhoto2', 'turfPhoto3'];
        $blobData = [
            'turfPhotos' => $turfPhotosData,
            'turfPhoto1' => $turfPhoto1Data,
            'turfPhoto2' => $turfPhoto2Data,
            'turfPhoto3' => $turfPhoto3Data,
            
        ];

        $blobIndices = [];
        $paramIndex = 0;
        foreach ($columns as $col) {
            if (in_array($col, $blobColumns)) {
                $blobIndices[$col] = $paramIndex;
            }
            $paramIndex++;
        }

        // Send BLOB data
        foreach ($blobIndices as $col => $index) {
            $insertStmt->send_long_data($index, $blobData[$col]);
        }

        // Execute the statement
        if ($insertStmt->execute()) {
            echo "NEW RECORD INSERTED SUCCESSFULLY";
        } else {
            die('Execute failed: ' . htmlspecialchars($insertStmt->error));
        }
        $insertStmt->close();
    } else {
        echo "SOMEONE ALREADY REGISTERED USING THIS CONTACT NUMBER";
    }
    $conn->close();
} else {
    echo "All required fields must be filled and files uploaded.";
    die();
}
?>    
        <!-- // if ($insertStmt->execute()) { 
        //     echo "<script>alert('NEW RECORD INSERTED SUCCESSFULLY'); window.location.href='your_redirect_page.php';</script>";
        // } else { 
        //     echo "<script>alert('Execute failed: " . htmlspecialchars($insertStmt->error) . "'); window.history.back();</script>";
        // }
        // $insertStmt->close();
        // } else { 
        //     echo "<script>alert('SOMEONE ALREADY REGISTERED USING THIS CONTACT NUMBER'); window.history.back();</script>";
        // }
        // $conn->close();
        // } else { 
        //     echo "<script>alert('All required fields must be filled and files uploaded.'); window.history.back();</script>";
        //     die();
        // }
        // ?> -->
    