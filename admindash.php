<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admindashboard.css">
</head>
<body>
  <header class="dashboard-header">
    <div class="header-title">Admin Dashboard</div>
    <div class="header-buttons">
      <button class="header-btn" onclick="navigateToPage('about.html')">About</button>
      <button class="header-btn" onclick="navigateToPage('adminlogin.php')" >Logout</button>
    </div>
  </header>

  <div class="main-content">
    <div class="card-wrapper">
      <!-- Add Candidate Card -->
      <div class="card" onclick="navigateToPage('addcandidate.php')">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Add Candidate Icon">
        <h2>Add Candidate's</h2>
      </div>

      <!-- View Voters Card -->
      <div class="card" onclick="navigateToPage('voterlist.php')">
        <img src="https://cdn-icons-png.flaticon.com/512/9128/9128444.png" alt="View Voters Icon">
        <h2>View Voter's List</h2>
      </div>
    </div>
  </div>

  <script src="admindashboard.js"></script>
</body>
</html>