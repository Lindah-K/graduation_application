<?php
// ... (Database connection code)
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "graduation"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute a SQL query to fetch user data including role
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_role"] = $row["role"]; // Store user role in the session
            header("Location: dashboard.php"); // Redirect to the dashboard
            exit;
        } else {
            header("Location: login.php?error=invalid_credentials");
            exit;
        }
    } else {
        header("Location: login.php?error=user_not_found");
        exit;
    }

    $stmt->close();
}
// ... (Database close and error handling code)
?>
