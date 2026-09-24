<?php
$host = 'localhost';
$dbname = 'student';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get president election results with the modified table structure
$sql = "SELECT 
            p.id,
            p.name,
            p.position,
            p.photo_path,
            COALESCE(SUM(p2.total_votes), 0) AS total_votes,
            ROUND(COALESCE(SUM(p2.total_votes), 0) * 100.0 / 
                NULLIF((
                    SELECT SUM(total_votes) 
                    FROM cultural2 
                    WHERE position = 'Cultural-Secretary'
                ), 0), 1) AS percentage
        FROM 
            cultural1 p
        LEFT JOIN 
            cultural2 p2 ON p.id = p2.candidate_id AND p.position = p2.position
        WHERE 
            p.position = 'Cultural-Secretary'
        GROUP BY 
            p.id, p.name, p.position, p.photo_path
        ORDER BY 
            total_votes DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the winner (first candidate in the sorted list)
$winner = !empty($candidates) ? $candidates[0] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>President Election Results | University Voting System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #278783;
      --primary-light: #5c7cfa;
      --secondary: #3f37c9;
      --accent: #f72585;
      --light: #f8f9fa;
      --dark: #2d3436;
      --gray: #636e72;
      --success: #4cc9f0;
      --warning: #f8961e;
      --danger: #ef233c;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f7ff;
      color: var(--dark);
      line-height: 1.6;
      overflow-x: hidden;
    }
    
    /* Preloader */
    #loading-screen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      color: white;
      transition: opacity 0.5s ease;
    }
    
    .loader-spinner {
      width: 70px;
      height: 70px;
      border: 5px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      border-top-color: white;
      animation: spin 1.2s ease-in-out infinite;
      margin-bottom: 25px;
    }
    
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    
    /* Header */
    .header {
      text-align: center;
      padding: 60px 20px 80px;
      background: linear-gradient(135deg,#278783, #1a5f5b);
      color: white;
      margin-bottom: -40px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
    }
    
    .header::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: linear-gradient(90deg, var(--accent), var(--warning), var(--success), var(--primary));
    }
    
    .header h1 {
      margin: 0;
      font-size: 2.8rem;
      position: relative;
      text-shadow: 0 2px 10px rgba(0,0,0,0.2);
      font-weight: 700;
      letter-spacing: -0.5px;
    }
    
    .header h1 i {
      margin-right: 15px;
      color: #ffd700;
    }
    
    .header p {
      max-width: 700px;
      margin: 15px auto 0;
      opacity: 0.9;
      font-weight: 300;
      font-size: 1.1rem;
    }
    
    /* Navigation */
    .navbar {
      position: absolute;
      top: 20px;
      left: 0;
      right: 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 40px;
      z-index: 100;
    }
    
    .logo {
      font-size: 1.5rem;
      font-weight: 700;
      color: white;
      text-decoration: none;
      display: flex;
      align-items: center;
    }
    
    .logo i {
      margin-right: 10px;
      color: var(--accent);
    }
    
    .nav-links {
      display: flex;
      gap: 25px;
    }
    
    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.95rem;
      transition: all 0.3s;
      padding: 5px 0;
      position: relative;
    }
    
    .nav-links a::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: white;
      transition: width 0.3s;
    }
    
    .nav-links a:hover::after {
      width: 100%;
    }
    
    /* Main Content */
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }
    
    .post-section {
      background: white;
      border-radius: 15px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.08);
      margin-bottom: 50px;
      position: relative;
      z-index: 1;
      padding: 40px;
      transform: translateY(-40px);
    }
    
    .post-section h2 {
      color: var(--primary);
      text-align: center;
      margin-bottom: 40px;
      font-size: 2.2rem;
      position: relative;
      padding-bottom: 15px;
    }
    
    .post-section h2::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 150px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
    }
    
    /* Winner Section */
    .winner-section {
      text-align: center;
      margin-bottom: 50px;
      padding: 40px;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(245, 247, 255, 0.9));
      border-radius: 15px;
      border-left: 5px solid var(--primary);
      position: relative;
      box-shadow: 0 10px 30px rgba(67, 97, 238, 0.1);
      overflow: hidden;
    }
    
    .winner-section::before {
      content: "🏆 WINNER";
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 0.9rem;
      font-weight: bold;
      color: var(--primary);
      background: rgba(67, 97, 238, 0.1);
      padding: 5px 10px;
      border-radius: 20px;
    }
    
    .winner-section::after {
      content: "";
      position: absolute;
      top: -50px;
      right: -50px;
      width: 150px;
      height: 150px;
      background: rgba(67, 97, 238, 0.05);
      border-radius: 50%;
    }
    
    .winner-section h3 {
      color: var(--primary);
      font-size: 2rem;
      margin: 20px 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
    }
    
    .winner-section h3 i {
      margin-right: 15px;
      color: #ffd700;
      font-size: 1.8rem;
    }
    
    .winner-photo {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      object-fit: cover;
      border: 5px solid #ffd700;
      box-shadow: 0 15px 35px rgba(255, 215, 0, 0.3);
      transition: all 0.4s ease;
    }
    
    .winner-photo:hover {
      transform: scale(1.05) rotate(5deg);
      box-shadow: 0 20px 40px rgba(255, 215, 0, 0.4);
    }
    
    .winner-votes {
      font-size: 1.3rem;
      margin-top: 20px;
      color: var(--gray);
    }
    
    .winner-votes span {
      font-weight: bold;
      color: var(--primary);
      font-size: 1.5rem;
    }
    
    .winner-badge {
      position: absolute;
      top: 20px;
      left: 20px;
      background: var(--accent);
      color: white;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    /* Candidates Grid */
    .candidates-section {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 30px;
      margin-top: 50px;
    }
    
    .candidate-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
      transition: all 0.4s ease;
      position: relative;
      border-top: 4px solid var(--primary-light);
    }
    
    .candidate-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .candidate-card .card-content {
      padding: 25px;
      text-align: center;
      position: relative;
    }
    
    .candidate-card .rank-badge {
      position: absolute;
      top: -15px;
      right: 20px;
      width: 40px;
      height: 40px;
      background: var(--primary);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 1.1rem;
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }
    
    .candidate-card .rank-badge.gold {
      background: linear-gradient(135deg, #ffd700, #ffaa00);
    }
    
    .candidate-card .rank-badge.silver {
      background: linear-gradient(135deg, #c0c0c0, #999999);
    }
    
    .candidate-card .rank-badge.bronze {
      background: linear-gradient(135deg, #cd7f32, #a05a2c);
    }
    
    .candidate-card img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid white;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }
    
    .candidate-card:hover img {
      transform: scale(1.05);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .candidate-card h3 {
      margin: 10px 0 5px;
      color: var(--dark);
      font-size: 1.4rem;
      font-weight: 600;
    }
    
    .candidate-position {
      color: var(--primary);
      font-size: 1rem;
      font-weight: 500;
      margin-bottom: 15px;
      letter-spacing: 0.5px;
    }
    
    .votes-count {
      font-size: 1.8rem;
      font-weight: bold;
      color: var(--primary);
      margin: 15px 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .votes-count i {
      margin-right: 8px;
      color: var(--accent);
    }
    
    .votes-percentage {
      color: var(--gray);
      font-size: 1rem;
      margin-bottom: 5px;
    }
    
    .progress-container {
      margin: 25px 0 15px;
    }
    
    .progress-bar {
      height: 10px;
      background: #e9ecef;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .progress {
      height: 100%;
      background: linear-gradient(90deg, var(--primary-light), var(--primary));
      border-radius: 5px;
      transition: width 1s ease;
      position: relative;
      overflow: hidden;
    }
    
    .progress::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(90deg, 
                  rgba(255,255,255,0.1) 0%, 
                  rgba(255,255,255,0.5) 50%, 
                  rgba(255,255,255,0.1) 100%);
      animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }
    
    /* Stats Section */
    .stats-section {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin: 40px 0;
    }
    
    .stat-card {
      background: white;
      border-radius: 10px;
      padding: 25px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .stat-card i {
      font-size: 2.5rem;
      margin-bottom: 15px;
      color: var(--primary);
    }
    
    .stat-card h3 {
      font-size: 1.8rem;
      color: var(--dark);
      margin-bottom: 5px;
    }
    
    .stat-card p {
      color: var(--gray);
      font-size: 0.9rem;
    }
    
    /* Buttons */
    .buttons {
      text-align: center;
      margin: 50px 0;
    }
    
    .btn {
      padding: 14px 35px;
      border-radius: 50px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      border: none;
      outline: none;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .btn i {
      margin-right: 10px;
    }
    
    .btn-primary {
      background: var(--primary);
      color: white;
    }
    
    .btn-primary:hover {
      background: var(--secondary);
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(67, 97, 238, 0.3);
    }
    
    .btn-outline {
      background: transparent;
      color: var(--primary);
      border: 2px solid var(--primary);
      margin-left: 15px;
    }
    
    .btn-outline:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-3px);
    }
    
    /* Footer */
    .footer {
      background: linear-gradient(135deg, var(--dark), #1a1a1a);
      color: white;
      padding: 60px 0 30px;
      margin-top: 80px;
      position: relative;
    }
    
    .footer::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: linear-gradient(90deg, var(--accent), var(--warning), var(--success), var(--primary));
    }
    
    .footer-content {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 40px;
      padding: 0 20px;
    }
    
    .footer-column h3 {
      font-size: 1.3rem;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .footer-column h3::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 3px;
      background: var(--primary);
    }
    
    .footer-column p {
      opacity: 0.8;
      margin-bottom: 15px;
      font-size: 0.95rem;
    }
    
    .footer-links {
      list-style: none;
    }
    
    .footer-links li {
      margin-bottom: 12px;
    }
    
    .footer-links a {
      color: white;
      text-decoration: none;
      opacity: 0.8;
      transition: all 0.3s;
      font-size: 0.95rem;
    }
    
    .footer-links a:hover {
      opacity: 1;
      padding-left: 5px;
    }
    
    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }
    
    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: rgba(255,255,255,0.1);
      border-radius: 50%;
      color: white;
      transition: all 0.3s;
    }
    
    .social-links a:hover {
      background: var(--primary);
      transform: translateY(-3px);
    }
    
    .footer-bottom {
      text-align: center;
      padding-top: 40px;
      margin-top: 40px;
      border-top: 1px solid rgba(255,255,255,0.1);
    }
    
    .footer-bottom p {
      opacity: 0.7;
      font-size: 0.9rem;
    }
    
    /* Animations */
    .fade-in {
      animation: fadeIn 0.8s ease-out forwards;
      opacity: 0;
    }
    
    @keyframes fadeIn {
      to { opacity: 1; }
    }
    
    .delay-1 { animation-delay: 0.2s; }
    .delay-2 { animation-delay: 0.4s; }
    .delay-3 { animation-delay: 0.6s; }
    .delay-4 { animation-delay: 0.8s; }
    
    /* Responsive */
    @media (max-width: 992px) {
      .header h1 {
        font-size: 2.4rem;
      }
      
      .post-section {
        padding: 30px;
      }
    }
    
    @media (max-width: 768px) {
      .header {
        padding: 50px 20px 70px;
      }
      
      .header h1 {
        font-size: 2rem;
      }
      
      .navbar {
        padding: 0 20px;
      }
      
      .post-section {
        padding: 25px;
      }
      
      .winner-section {
        padding: 30px;
      }
      
      .winner-photo {
        width: 150px;
        height: 150px;
      }
      
      .candidates-section {
        grid-template-columns: 1fr;
      }
      
      .btn {
        padding: 12px 25px;
      }
    }
    
    @media (max-width: 576px) {
      .header {
        padding: 40px 15px 60px;
      }
      
      .header h1 {
        font-size: 1.8rem;
      }
      
      .nav-links {
        display: none;
      }
      
      .post-section {
        padding: 20px;
      }
      
      .winner-section {
        padding: 25px 20px;
      }
      
      .winner-section h3 {
        font-size: 1.6rem;
      }
      
      .buttons {
        display: flex;
        flex-direction: column;
        gap: 15px;
      }
      
      .btn-outline {
        margin-left: 0;
      }
    }
    
    /* Print Styles */
    @media print {
      .buttons, #loading-screen, .navbar, .footer {
        display: none;
      }
      
      body {
        background: white;
        font-size: 12pt;
      }
      
      .header {
        background: white !important;
        color: var(--dark) !important;
        box-shadow: none !important;
        padding: 20px 0 !important;
      }
      
      .header h1 {
        color: var(--dark) !important;
        font-size: 18pt !important;
      }
      
      .post-section, .winner-section, .candidate-card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
        page-break-inside: avoid;
        transform: none !important;
        margin: 10px 0 !important;
        padding: 15px !important;
      }
      
      .winner-photo, .candidate-card img {
        width: 80px !important;
        height: 80px !important;
      }
      
      .candidates-section {
        grid-template-columns: repeat(2, 1fr) !important;
      }
    }
  </style>
</head>
<body>

<!-- Loading Screen -->
<div id="loading-screen">
  <div class="loader-spinner"></div>
  <h2>Loading Election Results...</h2>
  <p>Please wait while we verify the data</p>
</div>

<!-- Navigation -->
<nav class="navbar">
  <a href="#" class="logo">
    <i class="fas fa-vote-yea"></i> VoteSphere
  </a>
  <div class="nav-links">
   <a href="1stpage.php"><i class="fas fa-home"></i> Home</a>
    <a href="presresults.php"><i class="fas fa-user"></i> President</a>
    <a href="vicresults.php"><i class="fas fa-user"></i> Vice-President</a>
    <a href="culresults.php"><i class="fas fa-user"></i> Cultural-Secreatary</a>
    <a href="sporesults.php"><i class="fas fa-user"></i> Sports-Secreatary</a>
  </div>
</nav>

<!-- Header -->
<header class="header">
  <h1><i class="fas fa-trophy"></i> Cultural-Secreatary Election Results</h1>
  <p>Official results for the 2025 University Student Union Cultural-Secreatary Election</p>
</header>

<!-- Main Content -->
<div class="container">
  <section class="post-section">
    <h2>🎓 Cultural-Secreatary Candidates</h2>

    <!-- Stats Section -->
    <div class="stats-section">
      <div class="stat-card fade-in delay-1">
        <i class="fas fa-users"></i>
        <h3><?php echo count($candidates); ?></h3>
        <p>Candidates</p>
      </div>
      <div class="stat-card fade-in delay-2">
        <i class="fas fa-vote-yea"></i>
        <h3><?php echo array_sum(array_column($candidates, 'total_votes')); ?></h3>
        <p>Total Votes</p>
      </div>
      <div class="stat-card fade-in delay-3">
        <i class="fas fa-percentage"></i>
        <h3><?php echo round(array_sum(array_column($candidates, 'percentage')) / count($candidates), 1); ?>%</h3>
        <p>Average Votes</p>
      </div>
      <div class="stat-card fade-in delay-4">
        <i class="fas fa-user-check"></i>
        <h3><?php echo $winner ? $winner['percentage'] : '0'; ?>%</h3>
        <p>Winner's Share</p>
      </div>
    </div>

    <!-- Winner Section -->
    <?php if ($winner): ?>
    <div class="winner-section fade-in">
      <div class="winner-badge">ELECTION WINNER</div>
      <h3 id="winnerName"><i class="fas fa-crown"></i> <?php echo htmlspecialchars($winner['name']); ?></h3>
      <img src="<?php echo htmlspecialchars($winner['photo_path']); ?>" alt="Winner Photo" class="winner-photo" id="winnerPhoto">
      <div class="winner-votes">
        Received <span><?php echo $winner['total_votes']; ?> votes</span> (<?php echo $winner['percentage']; ?>% of total)
      </div>
    </div>
    <?php endif; ?>

    <!-- All Candidates -->
    <h3 style="text-align: center; margin-top: 50px; color: var(--primary);">All Candidates</h3>
    <div class="candidates-section">
      <?php foreach ($candidates as $index => $candidate): ?>
      <div class="candidate-card fade-in delay-<?php echo ($index % 4) + 1; ?>">
        <div class="rank-badge <?php 
          echo $index === 0 ? 'gold' : 
               ($index === 1 ? 'silver' : 
               ($index === 2 ? 'bronze' : '')); 
        ?>">
          <?php echo $index + 1; ?>
        </div>
        <div class="card-content">
          <img src="<?php echo htmlspecialchars($candidate['photo_path']); ?>" alt="<?php echo htmlspecialchars($candidate['name']); ?>">
          <h3><?php echo htmlspecialchars($candidate['name']); ?></h3>
          <div class="candidate-position"><?php echo htmlspecialchars($candidate['position']); ?></div>
          <div class="votes-count"><i class="fas fa-vote-yea"></i> <?php echo $candidate['total_votes']; ?></div>
          <div class="votes-percentage"><?php echo $candidate['percentage']; ?>% of total votes</div>
          <div class="progress-container">
            <div class="progress-bar">
              <div class="progress" style="width: <?php echo $candidate['percentage']; ?>%;"></div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <div class="buttons">
    <button class="btn btn-primary" onclick="window.print()"><i class="fas fa-print"></i> Print Results</button>
  </div>
</div>

<!-- Footer -->
<footer class="footer">
  <div class="footer-content">
    <div class="footer-column">
      <h3>About VoteSphere</h3>
      <p>VoteSphere is the official student election system of the university, providing transparent and secure voting for all student government elections.</p>
      <div class="social-links">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com/sgbit_official?igsh=MzUzb2traG9yMnIw"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
    <div class="footer-column">
      <h3>Quick Links</h3>
      <ul class="footer-links">
        <li><a href="#">Current Elections</a></li>
        <li><a href="#">Past Results</a></li>
        <li><a href="#">Election Calendar</a></li>
        <li><a href="#">Candidate Guidelines</a></li>
        <li><a href="#">Voter Information</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>Contact Us</h3>
      <p><i class="fas fa-map-marker-alt"></i> Student Union Building, Room 1110</p>
      <p><i class="fas fa-phone"></i> 9741207665</p>
      <p><i class="fas fa-envelope"></i> elections@sgbit.edu</p>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 University Student Elections. All rights reserved.</p>
    <p>Results verified by the VoteSphere Committee on <?php echo date('F j, Y'); ?></p>
  </div>
</footer>

<script>
  // Hide loading screen when page is fully loaded
  window.addEventListener('load', function() {
    setTimeout(function() {
      document.getElementById('loading-screen').style.opacity = '0';
      setTimeout(function() {
        document.getElementById('loading-screen').style.display = 'none';
      }, 500);
      
      // Animate progress bars
      document.querySelectorAll('.progress').forEach(progress => {
        const width = progress.style.width;
        progress.style.width = '0';
        setTimeout(() => {
          progress.style.width = width;
        }, 300);
      });
      
      // Add staggered animation to candidate cards
      const cards = document.querySelectorAll('.candidate-card');
      cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
      });
    }, 1000);
  });
</script>

</body>
</html>