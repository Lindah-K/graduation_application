<?php
// Your database connection code here
session_start();

$servername = "localhost"; 
$hostname = "root"; 
$password = ""; 
$dbname = "graduation"; 

$conn = new mysqli($servername, $hostname, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['accept'])) {
    // Get the student ID from the form
    $student_id = $_POST['student_id'];
    
    // Update the database with the approval status
    $update_sql = "UPDATE `graduation_data` SET r_approvalstatus = 'approved' WHERE student_id = '$student_id'";
    
    // Execute the query
    $update_result = mysqli_query($conn, $update_sql);
    
    if ($update_result) {
        // // The approval was successful
        echo '<script type="text/javascript"> alert("Approved") </script>';

        // Update the approval status in the session
        $_SESSION['r_approvalstatus'] = "Approved";

        $r_approvalstatus = "Approved";
        // header("Location: hod_dashboard.php");

        echo '<script type="text/javascript">
        window.location.href = "registrar_dashboard.php?student_id=' . $student_id . '";
        </script>';
        
        // echo '<script type="text/javascript"> 
        //     var row = document.getElementById("row_' . $student_id . '");
        //     if (row) {
        //         row.remove();
        //     }
        // </script>';

    } else {
        // Handle the case where the update failed
        echo "Declined";
    }
$conn->close();
}
?>
