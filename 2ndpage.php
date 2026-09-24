<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vote Sphere - Digital Voting Platform</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap">
  <link rel="stylesheet" href="2ndpage.css">
</head>
<body>

  <!-- Back Button -->
  <button id="back-btn">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" 
         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
      <polyline points="15 18 9 12 15 6" />
    </svg>
    Back
  </button>

  <div class="container">
    <h1 class="title">Vote Sphere</h1>
    <p class="tagline">Your trusted digital voting platform</p>
    <div class="handshake">🤝</div>

    <div class="button-group">
      <div class="btn-wrapper">
        <span class="dot"></span>
        <button class="btn" id="voter-btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
               viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="8.5" cy="7" r="4"></circle>
            <line x1="20" y1="8" x2="20" y2="14"></line>
            <line x1="23" y1="11" x2="17" y2="11"></line>
          </svg>
          Voter Registration
        </button>
      </div>

      <div class="btn-wrapper">
        <span class="dot"></span>
        <button class="btn" id="admin-btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
               viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
               stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="9" y1="3" x2="9" y2="21"></line>
            <line x1="14" y1="9" x2="21" y2="9"></line>
            <line x1="14" y1="15" x2="21" y2="15"></line>
          </svg>
          Admin Panel
        </button>
      </div>
    </div>

    <button class="result-btn" id="result-btn">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
           viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
           stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
      </svg>
      Sign Up / Login
    </button>

    <div class="footer">
      Secure • Transparent • Accessible
    </div>
  </div>

  <script src="2ndpage.js"></script>
</body>
</html>
