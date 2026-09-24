<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Candidates | Election System</title>
  <link rel="stylesheet" href="addcandidate.css" />
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
        <a href="1stpage.php"><i class="fas fa-home"></i> Dashboard</a>
      </div>
    </nav>
  </header>

  <main class="main-content">
    <div class="page-header">
      <h1>ADD CANDIDATES</h1>
      <p class="page-description">
        Select the position for which you want to add a new candidate. 
        You'll be redirected to a form where you can enter the candidate's details.
      </p>
    </div>

    <div class="button-grid">
      <button class="role-button" onclick="addCandidate('President')">
        <i class="fas fa-landmark" style="margin-right: 10px;"></i> President
      </button>
      <button class="role-button" onclick="addCandidate('Vice-President')">
        <i class="fas fa-user-friends" style="margin-right: 10px;"></i> Vice-President
      </button>
      <button class="role-button" onclick="addCandidate('Cultural Secretary')">
        <i class="fas fa-music" style="margin-right: 10px;"></i> Cultural Secretary
      </button>
      <button class="role-button" onclick="addCandidate('Sport Secretary')">
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

  <script src="addcandidate.js"></script>
</body>
</html>
