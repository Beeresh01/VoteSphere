<?php
session_start();

// Redirect to homepage if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: votlog.php");
    exit();
}

$db = new mysqli('localhost', 'root', '', 'student');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Handle vote submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['candidate_id'])) {
    $candidate_id = (int)$_POST['candidate_id'];
    $position = "Sports-Secreatary"; // Set the position you're voting for
    $user_id = $_SESSION['user_id'];
    
    // Check if user has already voted for this position
    $check_vote = $db->prepare("SELECT id FROM sports3 WHERE user_id = ? AND position = ?");
    $check_vote->bind_param("is", $user_id, $position);
    $check_vote->execute();
    
    if ($check_vote->get_result()->num_rows > 0) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'You have already voted for this position']);
        exit;
    }
    
    // Check if candidate exists
    $check = $db->prepare("SELECT id FROM sports WHERE id = ?");
    $check->bind_param("i", $candidate_id);
    $check->execute();
    
    if ($check->get_result()->num_rows > 0) {
        // Record that this user has voted
        $record_vote = $db->prepare("INSERT INTO sports3 (user_id, candidate_id, position) VALUES (?, ?, ?)");
        $record_vote->bind_param("iis", $user_id, $candidate_id, $position);
        $record_vote->execute();
        
        // Check if vote record already exists
        $vote_check = $db->prepare("SELECT id FROM sports2 WHERE candidate_id = ? AND position = ?");
        $vote_check->bind_param("is", $candidate_id, $position);
        $vote_check->execute();
        $result = $vote_check->get_result();
        
        if ($result->num_rows > 0) {
            // Update existing vote count
            $stmt = $db->prepare("UPDATE sports2 SET total_votes = total_votes + 1 WHERE candidate_id = ? AND position = ?");
            $stmt->bind_param("is", $candidate_id, $position);
        } else {
            // Insert new vote record
            $stmt = $db->prepare("INSERT INTO sports2 (candidate_id, position, total_votes) VALUES (?, ?, 1)");
            $stmt->bind_param("is", $candidate_id, $position);
        }
        
        $stmt->execute();
        
        // Return success response with updated vote count
        $count_query = $db->prepare("SELECT total_votes FROM sports2 WHERE candidate_id = ? AND position = ?");
        $count_query->bind_param("is", $candidate_id, $position);
        $count_query->execute();
        $count_result = $count_query->get_result();
        $vote_count = $count_result->fetch_assoc()['total_votes'];
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'candidate_id' => $candidate_id
        ]);
        exit;
    }
    
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid candidate']);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cast Your Vote!</title>
    <link rel="stylesheet" href="votpres.css">
</head>
<body>
    <div class="container">
        <a href="votepanel.php" class="back-button">← Back</a>
        <h1>Cast Your Vote!</h1>
        <p class="subtitle">Which candidate should be our next Sports Secreatary?</p>
        <p style="color: white; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);"><b>Logged in as: <?php echo $_SESSION['usn']; ?></b></p>
        
        <div class="candidates">
            <?php
            $query = "SELECT * FROM sports";
            $result = $db->query($query);
            
            // Check if user has already voted for this position
            $user_id = $_SESSION['user_id'];
            $position = "sports-secreatary";
            $check_vote = $db->prepare("SELECT id FROM sports3 WHERE user_id = ? AND position = ?");
            $check_vote->bind_param("is", $user_id, $position);
            $check_vote->execute();
            
            $has_voted = $check_vote->get_result()->num_rows > 0;
            
            while ($row = $result->fetch_assoc()) {
                echo '<div class="candidate" data-id="'.$row['id'].'">';
                echo '<div class="candidate-image"><img src="'.$row['photo_path'].'" alt="'.$row['name'].'"></div>';
                echo '<h2>'.$row['name'].'</h2>';
                echo '<p>'.$row['department'].'</p>';
                echo '<p>'.$row['semester'].'</p>';
                
                if ($has_voted) {
                    echo '<button class="vote-btn" disabled>Already Voted</button>';
                } else {
                    echo '<button class="vote-btn" type="submit">Vote Now</button>';
                }
                
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="votspo.js"></script>
</body>
</html>