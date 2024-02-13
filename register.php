<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    // $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $role = $_POST["role"];
    $password = $_POST["password"];

    $prefix = '';
    switch ($role) {
        case 'student':
            $prefix = 'S';
            break;
        case 'registrar':
            $prefix = 'R';
            break;
        case 'dean':
            $prefix = 'D';
            break;
            case 'hod':
            $prefix = 'H';
            break;
        // Add more cases for other roles if needed
    }
    $username = generateUniqueUserID($prefix);

        // ... (Database connection code)
        $servername = "localhost"; 
        $hostname = "root"; 
        $password = ""; 
        $dbname = "graduation"; 

        $conn = new mysqli($servername, $hostname, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Hash the password for security (you should use a more secure hashing method)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO register (username,fullname,role, password) VALUES (?,?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $fullname, $role, $hashed_password);

        if ($stmt->execute()) {
            $successMessage = "Registration successful. Redirecting to login page...";

            $_SESSION["autogeneratedUsername"] = $username;

            // Set the variable to indicate redirection from registration
            $_SESSION["redirectedFromRegistration"] = true;


    
            // Clear input fields
            // $username = "";
            $role = "";
    
            // Redirect to the login page after a brief delay
            header("refresh:0;url=index.php" . urlencode($autogeneratedUsername));
            // header("refresh:0;url=index.php");

            exit; // Stop script execution
        } else {
            $successMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
         // Close the database connection
        $stmt->close();
        $conn->close();
    }
    // function generateUniqueUserID($prefix) {
    //     $unique_id = uniqid();
    //     $user_id = $prefix . $unique_id;
    //     return $user_id;
    // }
    function generateUniqueUserID($prefix) {
        // Generate a random character (A to Z)
        $randomChar = chr(rand(65, 90));
            // Define an array of special characters
        $specialCharacters = array("@", "#", "$", "%", "&", "!");
        
        // Select a random special character from the array
        $randomSpecialChar = $specialCharacters[array_rand($specialCharacters)];

        // Generate 3 random unique numbers
        $uniqueNumbers = generateUniqueNumbers(3);
    
        // Combine the prefix, random character, and unique numbers
        $user_id = $prefix . $randomSpecialChar . $uniqueNumbers;
    
        return $user_id;
    }
    
    function generateUniqueNumbers($length) {
        $uniqueNumbers = '';
    
        while (strlen($uniqueNumbers) < $length) {
            $randNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
            if (strpos($uniqueNumbers, $randNumber) === false) {
                $uniqueNumbers .= $randNumber;
            }
        }
    
        return $uniqueNumbers;
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="./assets/css/images/bara-logo-a2.png" type="image/x-icon">
    <title>UserRegistration</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/css/reg.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form id="registrationForm" action=" " method="post" onsubmit="return validateForm()">
            <!-- <div class="input-container">
                <label for="username">UserID<span>*</span></label> -->
                <!-- <input type="text" name="username" id="username" required> -->
                <!-- <input type="hidden" name="username" id="username" value="<?php echo $username; ?>">
            </div> -->
              <div class="input-container">
                <label for="fullname">Full Name<span>*</span></label>
                <input type="text" name="fullname" id="fullname" required>
            </div>
            <label for="role">Role<span>*</span></label>
                <select name="role" id="role" required>
                    <option value="student">Student</option>
                    <option value="hod">Hod</option>
                    <option value="dean">Dean</option>
                    <option value="registrar">Registrar</option>
                </select>
            <div class="input-container">
                <label for="password">Password<span>*</span></label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="input-container">
                <label for="confirm_password">Confirm Password<span>*</span></label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="input-container">
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>

    <script>

        function validateForm() {
          var username = document.getElementById("username").value;
          var password = document.getElementById("password").value;
          var confirmPassword = document.getElementById("confirm_password").value;
        
          // Check if the password and confirm password fields match
          if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return false;
          }
        
          return true;
        }
        </script>
</body>
</html>
