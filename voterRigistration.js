document.querySelector('.submit-btn').addEventListener('click', function () {
  const name = document.getElementById('name').value.trim();
  const usn = document.getElementById('usn').value.trim();
  const branch = document.getElementById('branch').value.trim();
  const gender = document.getElementById('gender').value.trim();
  const semester = document.getElementById('semester').value.trim();
  const mobile = document.getElementById('mobile').value.trim();
  const password = document.getElementById('password').value.trim();

  if (!name || !usn || !branch || !gender || !semester || !mobile || !password) {
    showError("Please fill in all fields.");
    return;
  }

  if (!/^\d{10}$/.test(mobile)) {
    showError("Please enter a valid 10-digit mobile number.");
    return;
  }

  if (password.length < 6) {
    showError("Password must be at least 6 characters long.");
    return;
  }

  document.getElementById('successText').textContent = `Thank you, ${name}! Your voter registration has been submitted successfully.`;
  document.getElementById('overlay').style.display = 'block';
  document.getElementById('successMessage').style.display = 'block';
});

function showError(message) {
  alert(message);
}

function closeSuccess() {
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('successMessage').style.display = 'none';

  document.querySelectorAll('input').forEach(input => input.value = '');
}
