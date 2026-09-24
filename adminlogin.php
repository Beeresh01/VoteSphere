<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Portal | Election System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="adminlogin.css">
</head>
<body>
  <a href="javascript:history.back()" class="back-button"><i class="fas fa-arrow-left"></i></a>
  <div class="login-container">
    <h1 class="title">ADMIN PORTAL</h1>

    <div class="input-group">
      <label for="adminId">Admin ID</label>
      <div class="input-field">
        <i class="fas fa-user input-icon"></i>
        <input type="text" id="adminId" placeholder="Enter your admin ID">
      </div>
      <div class="error-message" id="adminId-error">Please enter a valid admin ID</div>
    </div>

    <div class="input-group">
      <label for="password">Password</label>
      <div class="input-field">
        <i class="fas fa-lock input-icon"></i>
        <input type="password" id="password" placeholder="Enter your password">
      </div>
      <div class="error-message" id="password-error">Please enter your password</div>
    </div>

    <button class="login-btn" id="loginButton">
      <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Login
    </button>

    <div class="success-message" id="successMessage">Login successful! Redirecting...</div>

  </div>

  <script src="adminlogin.js"></script>
</body>
</html>