<?php
// Start the session to access the approval status
session_start();

$fullname = "";
$approvalStatus = "pending"; // Default status if not set
$d_approvalstatus = "pending";
$r_approvalstatus = "pending";


// Check if the approval status is set in the session
if (isset($_SESSION['approval_status']) && isset($_SESSION['d_approvalstatus']) && isset($_SESSION['r_approvalstatus'])) {
    $approvalStatus = $_SESSION['approval_status'];
    $d_approvalstatus = $_SESSION['d_approvalstatus'];
    $r_approvalstatus = $_SESSION['r_approvalstatus'];
    
    // Check if the user is logged in (user ID is stored in a session variable)
    if (isset($_SESSION['username'])) {
        // Database configuration (replace with your actual database credentials)
        $servername = "localhost"; 
        $hostname = "root"; 
        $password = ""; 
        $dbname = "graduation"; 
    
        $conn = new mysqli($servername, $hostname, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Get the user ID from the session
        $username = $_SESSION['username'];
    
        $sql = "SELECT approval_status, d_approvalstatus, r_approvalstatus, fullname FROM graduation_data WHERE username = '$username'";
        $result = $conn->query($sql);

        // ...
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $approvalStatus = $row['approval_status'];
            $d_approvalstatus = $row['d_approvalstatus'];
            $r_approvalstatus = $row['r_approvalstatus'];
            $fullname = $row['fullname'];
        } else {
            // Handle the case where no user with the stored user ID is found
            $fullname = "User not found";
        }
    // ...
    
        // Close the database connection
        $conn->close();
    }
    // } else {
    //     // Handle the case where the user is not logged in
    //     echo "User not logged in";
    // }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/css/images/bara-logo-a2.png" type="image/x-icon">
    <title>Approval Status</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
        }

        th, td {
            border: 1px solid  #061f3a;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color:  #061f3a;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Approval Status: <?php echo $fullname; ?></h1>

    <table border="1">
        <tr>
            <th>HOD</th>
            <th>School Dean</th>
            <th>Registrar</th>
        </tr>
        <tr>
            <td>
                <?php
                // Display the approval status
                echo $approvalStatus;
                ?>
            </td>
            <td>
                <?php
                // Display the approval status
                echo $d_approvalstatus;
                ?>
            </td>
            <td>
                <?php
                // Display the approval status
                echo $r_approvalstatus;
                ?>
            </td>
        </tr>
    </table>
    <script>
         async function fetchFullname() {
            try {
                const response = await fetch('register.php'); // Replace with your server URL
                if (response.ok) {
                    const data = await response.json();
                    // const fullnameContainer = document.getElementById('fullname-container');
                    // fullnameContainer.textContent = "Full Name: " + data.fullname; // Display the fullname
                    const fullnameContainer = document.getElementById('fullname-container');
                    fullnameContainer.textContent = "Full Name: " + data.fullname; // Display the fullname

                } else {
                    console.error('Failed to fetch fullname');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
</body>
</html>
