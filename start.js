document.addEventListener('DOMContentLoaded', function() {
  // Initialize image preview functionality
  document.querySelectorAll('.photo-upload').forEach(input => {
    input.addEventListener('change', function(e) {
      const row = this.closest('.candidate-row');
      const preview = row.querySelector('.image-preview');
      const file = this.files[0];
      
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        preview.style.display = 'none';
      }
    });
  });

  // Initialize submit buttons
  document.querySelectorAll('.submit-btn').forEach(button => {
    button.addEventListener('click', function() {
      const row = this.closest('.candidate-row');
      const candidateId = row.dataset.candidateId;
      submitCandidate(candidateId);
    });
  });
});

function submitCandidate(candidateId) {
  const row = document.querySelector(`.candidate-row[data-candidate-id="${candidateId}"]`);
  
  // Get form values
  const name = row.querySelector('input[name="name"]').value;
  const department = row.querySelector('input[name="department"]').value;
  const semester = row.querySelector('input[name="semester"]').value;
  const photo = row.querySelector('input[name="photo"]').files[0];
  
  // Validate inputs
  if (!name || !department || !semester) {
    alert('Please fill all required fields for Candidate ' + candidateId);
    return;
  }
  
  // Prepare form data
  const formData = new FormData();
  formData.append('candidateId', candidateId);
  formData.append('name', name);
  formData.append('department', department);
  formData.append('semester', semester);
  formData.append('position', 'Cultural-Secretary');
  if (photo) formData.append('photo', photo);
  
  // Send data to server
  fetch('stacon.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert(`Candidate ${candidateId} (${name}) saved successfully!`);
      // Disable the button after successful submission
      row.querySelector('.submit-btn').disabled = true;
      row.querySelector('.submit-btn').textContent = 'Submitted ✓';
    } else {
      alert('Error: ' + data.message);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Failed to save candidate');
  });
}