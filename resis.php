<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Voter Registration</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="voterRigistration.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <!-- Back Button in top-left -->
  <button type="button" class="back-btn" onclick="window.history.back()">
    <i class="fas fa-arrow-left"></i>
  </button>

  <form action="connection.php" method="POST">
    <div class="container">
      <div class="form-section">
        <h2>Voter Registration</h2>
        <div class="form-group">
          <label for="usn">USN</label>
          <input type="text" id="usn" placeholder="Enter your USN" name="usn" required>
        </div>
        <div class="form-group">
          <label for="name">FULL NAME</label>
          <input type="text" id="name" placeholder="Enter your full name" name="name" required>
        </div>
        <div class="form-group">
          <label for="branch">Branch</label>
          <input type="text" id="branch" placeholder="Enter your branch" name="branch" required>
        </div>
        <div class="form-group">
          <label>Gender</label>
          <div class="gender-options">
            <div class="gender-option">
              <input type="radio" id="male" name="gender" value="Male">
              <label for="male">Male</label>
            </div>
            <div class="gender-option">
              <input type="radio" id="female" name="gender" value="Female">
              <label for="female">Female</label>
            </div>
            <div class="gender-option">
              <input type="radio" id="other" name="gender" value="Other">
              <label for="other">Other</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="semester">Semester</label>
          <input type="text" id="semester" placeholder="Enter current semester" name="semester" required>
        </div>
        <div class="form-group">
          <label for="mobile">Mobile Number</label>
          <input type="tel" pattern="[0-9]{10}" maxlength="10" id="mobile" placeholder="10-digit mobile number" name="mobile" required>
        </div>
        <div class="form-group password-container">
          <label for="password">Create Password</label>
          <input type="password" maxlength="20" id="password" placeholder="Create a secure password" name="password" required>
          <i class="fas fa-eye toggle-password" id="togglePassword"></i>
        </div>
        <button type="submit" class="submit-btn">REGISTER NOW</button>
      </div>
      <div class="image-section">
        <img src="https://media.istockphoto.com/id/1348940066/vector/register-online-to-vote-_-banner.jpg?s=612x612&w=0&k=20&c=PnBwyuwqpO4_0EehjCZqHJym2-wQzTWmMWZtmtFHcPQ=" alt="Voting illustration">
      </div>
    </div>

    <div class="overlay" id="overlay"></div>

    <div class="success-message" id="successMessage">
      <div class="checkmark">✓</div>
      <h3>Registration Successful!</h3>
      <p id="successText">Thank you for registering to vote.</p>
      <button class="submit-btn" onclick="closeSuccess()">Continue</button>
    </div>

    <script>
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');

      togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
      });
    </script>
    <script src="voterRigistration.js"></script>
  </form>
</body>
</html>
