<?php
// Database configuration
session_start();

$servername = "localhost"; 
$hostname = "root"; 
$password = ""; 
$dbname = "graduation"; 

$conn = new mysqli($servername, $hostname, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$approvalStatus = "";
$d_approvalstatus = "";
$r_approvalstatus = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize user inputs
    function sanitize($conn, $input) {
        return mysqli_real_escape_string($conn, $input);
    }
    $date = sanitize($conn, $_POST["date"]);
    $fullname = sanitize($conn, $_POST["fullname"]);
    $student_id = sanitize($conn, $_POST["student_id"]);
    $degree = sanitize($conn, $_POST["degree"]);
    $bulletin = sanitize($conn, $_POST["bulletin"]);

    // Process data for the first semester/trimester
    $first_semester_course = $_POST["first_semester_course"];
    $first_semester_number = $_POST["first_semester_number"];
    $first_semester_title = $_POST["first_semester_title"];
    $first_semester_sem_crs = $_POST["first_semester_sem_crs"];

    for ($i = 0; $i < count($first_semester_course); $i++) {
        $course = sanitize($conn, $first_semester_course[$i]);
        $number = sanitize($conn, $first_semester_number[$i]);
        $title = sanitize($conn, $first_semester_title[$i]);
        $sem_crs = sanitize($conn, $first_semester_sem_crs[$i]);

        $sql = "INSERT INTO first_sem (course, number, title, sem_crs) VALUES ('$course', '$number', '$title', '$sem_crs')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Process data for the second semester/trimester
    $second_semester_course = $_POST["second_semester_course"];
    $second_semester_number = $_POST["second_semester_number"];
    $second_semester_title = $_POST["second_semester_title"];
    $second_semester_sem_crs = $_POST["second_semester_sem_crs"];

    for ($i = 0; $i < count($second_semester_course); $i++) {
        $course = sanitize($conn, $second_semester_course[$i]);
        $number = sanitize($conn, $second_semester_number[$i]);
        $title = sanitize($conn, $second_semester_title[$i]);
        $sem_crs = sanitize($conn, $second_semester_sem_crs[$i]);

        $sql = "INSERT INTO second_sem (course, number, title, sem_crs) VALUES ('$course', '$number', '$title', '$sem_crs')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Process data for the inter-semester/third trimester
    $third_semester_course = $_POST["third_semester_course"];
    $third_semester_number = $_POST["third_semester_number"];
    $third_semester_title = $_POST["third_semester_title"];
    $third_semester_sem_crs = $_POST["third_semester_sem_crs"];

    for ($i = 0; $i < count($third_semester_course); $i++) {
        $course = sanitize($conn, $third_semester_course[$i]);
        $number = sanitize($conn, $third_semester_number[$i]);
        $title = sanitize($conn, $third_semester_title[$i]);
        $sem_crs = sanitize($conn, $third_semester_sem_crs[$i]);

        $sql = "INSERT INTO inter_sem (course, number, title, sem_crs) VALUES ('$course', '$number', '$title', '$sem_crs')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

        // Insert data into the database
        $sql = "INSERT INTO graduation_data (date, fullname, student_id, degree, bulletin, approval_status, d_approvalstatus, r_approvalstatus) VALUES ('$date', '$fullname', '$student_id', '$degree', '$bulletin', '$approvalStatus', '$d_approvalstatus', '$r_approvalstatus')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $_SESSION['approvalStatus'] = $approvalStatus;
        $_SESSION['d_approvalstatus'] = $d_approvalstatus;
        $_SESSION['r_approvalstatus'] = $r_approvalstatus;

        header("Location: student_dashboard.php");
        exit();
        
        // Close the database connection
        $conn->close();
}
else {
    $_SESSION['approvalStatus'] = "pending";
    $_SESSION['d_approvalstatus'] = "pending";
    $_SESSION['r_approvalstatus'] = "pending";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="./assets/css/images/bara-logo-a2.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/css/form.css">
    <title>GraduationForm</title>
</head>
<body>
    <form method="post" action="gradform.php" class="form" >
    <img id="logo" src="./assets/css/images/bara-logo-a.png" alt="bara-logo-a">
    <h2>UNDERGRADUATE GRADUATION APPLICATION FORM</h2>
        <label for="year">YEAR : 2024</label><br><br>
        
        <label for="date">Date of Application:</label>
        <input type="date" id="date_appli" name="date" required><br><br>
        
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required><br><br>

        <label for="degree">Degree and Major:</label>
        <input type="text" id="degree" name="degree" required><br><br>

        <label for="bulletin">Bulletin used:</label>
        <select name="bulletin" id="bulletin" required>
            <option value="2024-2028">2024-2028</option>
            <option value="2020-2024">2020-2024</option>
            <option value="2016-2020">2016-2020</option>
        </select>

        <h3>Courses yet to be completed at UEAB</h3><br>
        <table border="1">
            <caption>First Semester/Trimester</caption>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>No</th>
                    <th>Course Title</th>
                    <th>Sem.Crs</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < 3; $i++) {
                    echo "<tr>";
                    echo "<td><input type='text' name='first_semester_course[]'></td>";
                    echo "<td><input type='text' name='first_semester_number[]'></td>";
                    echo "<td><input type='text' name='first_semester_title[]'></td>";
                    echo "<td><input type='text' name='first_semester_sem_crs[]'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table><br><br>

        <table border="1">
            <caption>Second Semester/Trimester</caption>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>No</th>
                    <th>Course Title</th>
                    <th>Sem.Crs</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < 3; $i++) {
                    echo "<tr>";
                    echo "<td><input type='text' name='second_semester_course[]'></td>";
                    echo "<td><input type='text' name='second_semester_number[]'></td>";
                    echo "<td><input type='text' name='second_semester_title[]'></td>";
                    echo "<td><input type='text' name='second_semester_sem_crs[]'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table><br><br>

        <table border="1">
            <caption>Inter-Semester/Third Trimester</caption>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>No</th>
                    <th>Course Title</th>
                    <th>Sem.Crs</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < 3; $i++) {
                    echo "<tr>";
                    echo "<td><input type='text' name='third_semester_course[]'></td>";
                    echo "<td><input type='text' name='third_semester_number[]'></td>";
                    echo "<td><input type='text' name='third_semester_title[]'></td>";
                    echo "<td><input type='text' name='third_semester_sem_crs[]'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table><br><br>
        <label for="advisor_name">Major Advisor</label>
        <p>I have checked the courses against the student's check sheet. If these courses are completed successfully, this will meet all the requirements for this major.</p>
        <input type="text" id="advisor_name" name="advisor_name" readonly value="<?php echo isset($_SESSION['approvalStatus']) ?    $_SESSION['approvalStatus'] : ''; ?>"><br><br>

        <!-- <label for="Major">Major</label> -->
        <!-- <input type="date" id="date of signature" name="date of graduation" required><br><br> -->
        <label for="dean">School Dean</label>
        <p>I approve this arrangement of the student to cover the courses as recorded.</p>
        <input type="text" id="dean" name="dean" readonly><br><br>

        <label for="reg">Registrar</label>
        <input type="text" id="reg" name="reg" readonly><br><br>
        <button type="submit">SUBMIT</button>
    </form>
</body>
</html>
