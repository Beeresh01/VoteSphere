<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate USN format and range
function isValidUSN($usn) {
    // Convert to uppercase to handle case insensitivity
    $usn = strtoupper($usn);
    
    // Check general format (2BUYYXXNNN)
    if (!preg_match('/^2BU([2-9][0-9])(CS|AD)([0-9]{3})$/', $usn, $matches)) {
        return false;
    }
    
    $year = $matches[1]; // YY part (20-24)
    $dept = $matches[2]; // Department (CS or AD)
    $num = (int)$matches[3]; // Number part
    
    // Validate year range (20-24)
    if ($year < '20' || $year > '24') {
        return false;
    }
    
    // Validate number range based on department
    if ($dept === 'CS') {
        return ($num >= 1 && $num <= 200);
    } elseif ($dept === 'AD') {
        return ($num >= 1 && $num <= 180);
    }
    
    return false;
}

// Get form data
$usn = strtoupper($_POST['usn']); // Convert to uppercase for consistency
$name = $_POST['name'];
$branch = $_POST['branch'];
$gender = $_POST['gender'];
$semester = $_POST['semester'];
$mobile = $_POST['mobile'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Validate USN before proceeding
if (!isValidUSN($usn)) {
    die("<script>
            alert('Invalid USN, Please enter a valid USN.');
            window.history.back();
         </script>");
}

// Check if USN already exists
$checkStmt = $conn->prepare("SELECT usn FROM voter WHERE usn = ?");
$checkStmt->bind_param("s", $usn);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    $checkStmt->close();
    die("<script>
            alert('This USN is already registered.');
            window.history.back();
         </script>");
     header("Location:votlog.php");
}
$checkStmt->close();

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO voter (usn, name, branch, gender, semester, mobile, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $usn, $name, $branch, $gender, $semester, $mobile, $password);

// Execute the statement
if ($stmt->execute()) {
    // Registration successful
    echo "<script>
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('successMessage').style.display = 'block';
          </script>";
          header("location: votlog.php");

} else {
    // Error handling
    echo "<script>
            alert('Error: " . addslashes($stmt->error) . "');
            window.history.back();
         </script>";
}

// Close connections
$stmt->close();
$conn->close();
?>