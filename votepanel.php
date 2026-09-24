<?php
session_start();

// Redirect to homepage if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: 1stpage.php");
    exit();
}
$db = new mysqli('localhost', 'root', '', 'student');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vote Now | Election System</title>
  <link rel="stylesheet" href="panel.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  

  <header>
    <nav class="navbar">
      <a href="#" class="logo">
        <span class="logo-icon"><i class="fas fa-vote-yea"></i></span>
        <span>VoteSphere</span>
      </a>
      <div class="nav-links">
        <a href="1stpage.php"><i class="fas fa-home"></i> Home</a>
        <a href="logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </nav>
  </header>

  <main class="main-content">
    <div class="page-header">
      <h1>CAST YOUR VOTE</h1>
      <p class="page-description">
        Please select the post you would like to vote for. 
        You will be directed to the list of candidates for that post.
      </p>
    </div>

    <div class="button-grid">
      <button class="role-button" onclick="voteForPost('President')">
        <i class="fas fa-landmark" style="margin-right: 10px;"></i> President
      </button>
      <button class="role-button" onclick="voteForPost('Vice-President')">
        <i class="fas fa-user-friends" style="margin-right: 10px;"></i> Vice-President
      </button>
      <button class="role-button" onclick="voteForPost('Cultural Secretary')">
        <i class="fas fa-music" style="margin-right: 10px;"></i> Cultural Secretary
      </button>
      <button class="role-button" onclick="voteForPost('Sport Secretary')">
        <i class="fas fa-running" style="margin-right: 10px;"></i> Sport Secretary
      </button>
    </div>
  </main>

  <footer>
    <div class="footer-content">
      <div class="footer-links">
        <a href="#"><i class="fas fa-envelope"></i> Contact</a>
      </div>
      <p class="copyright">
        &copy; VoteSphere. All rights reserved.
      </p>
    </div>
  </footer>

  <script src="panel.js"></script>
</body>
</html>