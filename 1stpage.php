<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>VoteSphere - College Voting System</title>
    <link rel="stylesheet" href="1stpage.css" />
</head>
<body>
    <header>
        <div class="logo">VoteSphere</div>
        <nav>
            <ul>
                <li><a href="retimer.php"> <button class="nav-btn" id="resultsBtn">Results</button></a></li>
                <li><a href="about.html"> <button class="nav-btn" id="aboutBtn">About</button></a></li>
                <li><a href="privacy and policy.html"><button class="nav-btn" id="privacyBtn">Privacy & Policy</button></a></li>
                <li><a href="contact.html"><button class="nav-btn" id="contactBtn">Contact</button></a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h1>College Voting Platform</h1>
        <p>Participate in your campus elections and make your voice heard in important college decisions</p>
        
        <div style="display: flex; gap: 1rem; justify-content: center;"> <!-- Added container for buttons -->
            <button class="login-btn" id="loginBtn">🔑 Login</button>
            <button class="login-btn" id="voteBtn">Vote</button> <!-- New Vote button -->
        </div>

        <div class="voting-images">
            <div class="voting-card">
                <a href="vote.html">
                <img src="https://www.adl.org/sites/default/files/2020-08/hands-hold-a-message-your-vote-matters-over-a-crowded-street-background-istock-1176084497.jpg" alt="Student voting"></a>
            </div>
            <div class="voting-card">
                <a href="https://www.eci.gov.in/etpbs">
                <img src="https://images.cointelegraph.com/images/1200_aHR0cHM6Ly9zMy5jb2ludGVsZWdyYXBoLmNvbS91cGxvYWRzLzIwMjAtMTIvNWIzMzAwMGEtZTI4OS00N2E2LTkyYzMtZTJlM2I1ZTA4ZTc4LmpwZw==.jpg" alt="Ballot box"></a>
            </div>
            <div class="voting-card">
                <a href="https://voters.eci.gov.in/">
                <img src="https://miro.medium.com/v2/resize:fit:1358/1*YU9ZJi_a1HrA--UIu1Z7iw.jpeg" alt="Campus decisions"></a>
            </div>
        </div>
    </main>
    
    <footer>
        &copy; 2025 VoteSphere - Secure College Voting Platform
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if user is logged in (you'll need to implement actual authentication)
            // For this example, we'll use sessionStorage to simulate login state
            const isLoggedIn = sessionStorage.getItem('isLoggedIn') === 'true';
            
            // Get the buttons
            const loginBtn = document.getElementById('loginBtn');
            const voteBtn = document.getElementById('voteBtn');
            
            // Login button redirects to login page
            loginBtn.addEventListener('click', function() {
                window.location.href = '2ndpage.php'; // Replace with your login page URL
            });
            
            // Vote button behavior
            voteBtn.addEventListener('click', function() {
                if (isLoggedIn) {
                    // Redirect to voting page if logged in
                    window.location.href = 'votepanel.php'; // Replace with your voting page URL
                } else {
                    // Redirect to login page if not logged in
                    window.location.href = 'votlog.php'; // Replace with your login page URL
                }
            });
            
            // For demonstration: Simulate login/logout (you'll need actual auth in production)
            // This would normally be handled in your login page
            if (window.location.search.includes('login=success')) {
                sessionStorage.setItem('isLoggedIn', 'true');
                alert('Login successful! You can now vote.');
            }
            if (window.location.search.includes('logout=true')) {
                sessionStorage.setItem('isLoggedIn', 'false');
                alert('Logged out successfully.');
            }
        });
    </script>
</body>
</html>