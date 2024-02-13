<?php
// Start a session

    // Database configuration (replace with your actual database credentials)
    $servername = "localhost"; 
    $hostname = "root"; 
    $password = ""; 
    $dbname = "graduation"; 

    $conn = new mysqli($servername, $hostname, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Extract form data
        $fullname = $_POST["fullname"];
        $student_id = $_POST["student_id"];
        $degree = $_POST["degree"];
        $supp_date = $_POST["supp"];
    
        // Insert form data into the database
        $sql = "INSERT INTO supp_data (name, student_id, degree, exam_date) VALUES ('$fullname', '$student_id', '$degree', '$supp_date')";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    $conn->close();
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="./assets/css/images/bara-logo-a2.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/css/form.css">
    <title>Supplementary Exam</title>
</head>
<body>
    <form method="post" action="" class="form" >
    <img id="logo" src="./assets/css/images/bara-logo-a.png" alt="bara-logo-a">
    <h4 align="center">OFFICE OF REGISTRAR</h4>
    <h2>SUPPLEMENTARY EXAM FORM</h2>

        <label for="fullname">Name:</label>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required><br><br>

        <label for="degree">Degree Major:</label>
        <input type="text" id="degree" name="degree" required><br><br>

        <label for="supp">Date of supplementary exam:</label>
        <input type="date" id="supp" name="supp" required><br><br>

        <p>I request to sit for a supplementary exam for the following courses. I understand i have to pay the supplementary exam fee of 1/3 cost per credit for each supplementary each supplementary exam i takebefore taking the exam. I also understrand that if i pass the supplementary exam, my final grade for the class will be no higher than C+.</p>
        <table border="1">
            <thead>
                <tr>
                    <th>Course code</th>
                    <th>Title</th>
                    <th>Credits</th>
                    <th>Semester Taken</th>
                    <th>Cat grade</th>
                    <th>Final exam grade</th>
                    <th>Final grade</th>
                    <th>Lecturer name </th>
                    <th>Lecturer signature</th>
                    <th>Date signed</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < 3; $i++) {
                    echo "<tr>";
                    echo "<td><input type='text' name='special_exam'></td>";
                    echo "<td><input type='text' name='special_exam'></td>";
                    echo "<td><input type='text' name='special_exam'></td>";
                    echo "<td><input type='text' name='special_exam'></td>";
                    echo "<td><input type='text' name='special_exam'></td>";
                    echo "<td><input type='text' name='special_exam'></td>";
                    echo "<td><input type='text' name='special_exam'></td>";
                    echo "<td><input type='text' name='special_exam'></td>";
                    echo "<td><input type='text' name='special_exam' readonly></td>";
                    echo "<td><input type='text' name='special_exam' readonly></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table><br><br>
        <h5 style="font-weight: 700;">I CERTIFY THE INFORMATION GIVEN ABOVE IS CORRECT TO THE BEST OF MY KNOWLEDGE.</h5>

        <label for="name">Student Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="sign">Signature:</label>
        <input type="text" id="sign" name="sign" required><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="chair">Chairperson:</label>
        <input type="text" id="chair" name="chair" readonly value=""><br><br>

        <label for="dean">Dean:</label>
        <input type="text" id="dean" name="dean" readonly value=""><br><br>

         <label for="finance">Student Finance:</label>
        <input type="text" id="finance" name="finance" readonly value=""><br><br>

        <label for="reg">Registrar:</label>
        <input type="text" id="reg" name="reg" readonly value=""><br><br>

        <button type="submit">SUBMIT</button>
    </form>
</body>
</html>