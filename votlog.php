<?php
// login.php - This will handle the login verification

// Database configuration
$db_host = 'localhost'; // Your database host
$db_username = 'root'; // Your database username
$db_password = ''; // Your database password
$db_name = 'student'; // Your database name

// Start the session
session_start();

// Check if user is already logged in, redirect to dashboard if true
if (isset($_SESSION['user_id']) && isset($_SESSION['usn'])) {
    header("Location: votepanel.php");
    
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $usn = isset($_POST['usn']) ? trim($_POST['usn']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    // Validate inputs
    if (empty($usn) || empty($password)) {
        $error = "Please enter both USN and password.";
    } else {
        // Create database connection
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Prepare SQL to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, password FROM voter WHERE usn = ?");
        $stmt->bind_param("s", $usn);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verify password (assuming passwords are hashed in the database)
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['usn'] = $usn;
                $_SESSION['logged_in'] = true;
                $_SESSION['last_activity'] = time(); // Set last activity time
                
                // Set session expiration (e.g., 1 hour = 3600 seconds)
                $_SESSION['expire_time'] = 3600;
                
                // Redirect to dashboard or home page
                header("Location: votepanel.php");
                exit();
            } else {
                $error = "Invalid USN or password.";
            }
        } else {
            $error = "Invalid USN or password.";
        }
        
        // Close connections
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="voterLogin.css">
</head>
<body>
    <div class="container">
        <a href="2ndpage.php" class="back-link">← Back</a>
        <h1>Login</h1>
        
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form action="votlog.php" method="POST">
            <div class="input-group">
                <label for="usn">Enter your USN</label>
                <input type="text" id="usn" name="usn" placeholder="USN" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" id="loginBtn">Login</button>
            
            <div class="register-link">
                Don't have an account? <a href="resis.php">Register here</a>
            </div>
        </form>
    </div>
</body>
</html>