<?php
header('Content-Type: application/json');

// Database configuration
$dbHost = 'localhost';
$dbName = 'student';
$dbUser = 'root';
$dbPass = '';

// Connect to database
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);
    $semester = filter_input(INPUT_POST, 'semester', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
    
    if (!$name || !$department || !$semester) {
        die(json_encode(['success' => false, 'message' => 'All fields are required']));
    }
    
    // Handle file upload
    $photoPath = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/candidates/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Validate file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['photo']['tmp_name']);
        
        if (!in_array($fileType, $allowedTypes)) {
            die(json_encode(['success' => false, 'message' => 'Only JPG, PNG, and GIF images are allowed']));
        }
        
        // Generate unique filename
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('candidate_') . '.' . $extension;
        $destination = $uploadDir . $filename;
        
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $destination)) {
            $photoPath = $destination;
        } else {
            die(json_encode(['success' => false, 'message' => 'Failed to upload photo']));
        }
    }
    
    try {
        // Insert into database
        $stmt = $pdo->prepare("
            INSERT INTO vicepresident (name, department, semester, position, photo_path)
            VALUES (:name, :department, :semester, :position, :photo_path)
        ");
        
        $stmt->execute([
            ':name' => $name,
            ':department' => $department,
            ':semester' => $semester,
            ':position' => $position,
            ':photo_path' => $photoPath
        ]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Candidate saved successfully',
            'candidateId' => $pdo->lastInsertId()
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}