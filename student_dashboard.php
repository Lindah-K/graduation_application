<?php
// Start a session
session_start();

$fullname = "";

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

    // Retrieve the username based on the user ID
    $sql = "SELECT fullname FROM register WHERE username = '$username'";
    $result = $conn->query($sql);

    // ...
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $fullname = $row['fullname'];
        // Debugging: Output the fetched fullname
        // var_dump($fullname);
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
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>

    <link rel="shortcut icon" href="./assets/css/images/bara-logo-a2.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="./assets/css/css/student.css">
    <style>
        #fullname-container{
            text-align:center;
            margin: 90px auto 40px 70px;
            color: #061f3a;
            font-weight: 700;
            text-transform:uppercase;
            font-size: 30px;

        }
        .header{
            margin: 80px 0 100px 200px;
            overflow: hidden;
        }
        /* Sidebar styles for bigger screens */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #061f3a;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 150px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            margin: 10px 0;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #fff;
        }

        /* Profile icon styles for smaller screens */
        #profile-icon {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 999;
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .dropdown-content {
            display: none;
        }

        /* Sidebar styles for smaller screens */
        @media (max-width: 768px) {
            .sidebar {
                left: 0;
                width: 100%;
            }

            .sidebar.closed {
            left: -400px;
            }

            /* Show the profile icon for smaller screens */
            #profile-icon {
                display: block;
            }
                  /* Style adjustments for mobile view */
            .home-link{
                order: 1;
                margin-top: 100px; /* Adjust the margin to your preference */
            }

            /* Center the text in the profile icon button */
            #profile-icon {
                text-align: center;
            }
        }
    /* Your existing CSS rules */

/* Responsive styles for screens smaller than 768px (tablets and mobile) */
        @media (max-width: 768px) {
            /* Adjust your styles for smaller screens here */
            .header {
                margin: 80px 0 80px 0; /* Adjust margins */
            }
            .sidebar {
                width: 100%;
                padding-top: 60px; /* Adjust padding */
            }
            .logo-lg{
                max-width:100%;
                height:auto;
            }
            #fullname-container{
                text-align:center;
                margin-left:0;
            }
        }

    </style>
</head>
<body>
    <div class="header">
        <img src="./assets/css/images/bara-logo-a.png" alt="Logo" class="logo-lg">
        <div id="fullname-container">Student Name: <?php echo $fullname; ?></div>
    </div>
    <!-- Profile icon to toggle the sidebar on small screens -->
    <button id="profile-icon">&#9776;</button>

    <div class="sidebar open" id="sidebar">
        <ul>
            <li class="home-link" ><a href="student_dashboard.php">Home</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-btn">Graduation</a>
                <div class="dropdown-content">
                    <a href="gradform.php">Apply Graduation</a>
                    <a href="approvals.php">Check approvals</a>
                    <a href="#">Graduation Application Report</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-btn">Examinations</a>
                <div class="dropdown-content">
                    <a href="special_exam.php">Special exam</a>
                    <a href="supp_exam.php">Supplementary exam</a>
                    <a href="exam_report.php">Exam Application Report</a>
                </div>
            </li>
            <li><a href="index.php">Log Out</a></li>
        </ul>
    </div>

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
        // JavaScript to toggle the dropdown content on click
        const dropdownButtons = document.querySelectorAll('.dropdown-btn');

        dropdownButtons.forEach(button => {
            button.addEventListener('click', () => {
                const dropdownContent = button.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });
        });

        // JavaScript to toggle the sidebar using the profile icon
        const sidebar = document.getElementById('sidebar');
        const profileIcon = document.getElementById('profile-icon');

        profileIcon.addEventListener('click', () => {
            sidebar.classList.toggle('closed');
        });
        fetchFullname();
    </script>
    
</body>
</html>
