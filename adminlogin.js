// Example admin credentials
const validAdminId = "2025";
const validPassword = "12345";

document.getElementById("loginButton").addEventListener("click", function() {
  const adminId = document.getElementById("adminId").value.trim();
  const password = document.getElementById("password").value.trim();
  const adminIdError = document.getElementById("adminId-error");
  const passwordError = document.getElementById("password-error");
  const successMessage = document.getElementById("successMessage");

  // Reset error messages
  adminIdError.style.display = "none";
  passwordError.style.display = "none";
  successMessage.style.display = "none";

  // Validate fields
  let isValid = true;
  
  if (!adminId) {
    adminIdError.style.display = "block";
    isValid = false;
  }
  
  if (!password) {
    passwordError.style.display = "block";
    isValid = false;
  }

  if (!isValid) return;

  // Check credentials
  if (adminId === validAdminId && password === validPassword) {
    // Show success message
    successMessage.style.display = "block";
    
    // Change button to loading state
    const loginBtn = document.getElementById("loginButton");
    loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> AUTHENTICATING';
    loginBtn.disabled = true;
    
    // Simulate loading and redirect
    setTimeout(() => {
      window.location.href = "admindash.php"; // Replace with your actual dashboard page
    }, 1500);
  } else {
    passwordError.textContent = "Invalid credentials. Please try again.";
    passwordError.style.display = "block";
    
    // Shake animation for error
    const loginContainer = document.querySelector(".login-container");
    loginContainer.style.animation = "none";
    setTimeout(() => {
      loginContainer.style.animation = "shake 0.5s";
    }, 10);
  }
});

// Allow pressing Enter to submit
document.addEventListener('keypress', function(e) {
  if (e.key === 'Enter') {
    document.getElementById("loginButton").click();
  }
});