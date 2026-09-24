function addCandidate(position) {
  const confirmed = confirm(`You are about to vote a candidate for ${position}. Continue?`);

  if (confirmed) {
    // Determine the redirect URL based on position
    let redirectUrl;
    switch(position) {
      case 'President':
        redirectUrl = 'votpres.php';
        break;
      case 'Vice-President':
        redirectUrl = 'votvic.php';
        break;
      case 'Cultural Secretary':
        redirectUrl = 'votcul.php';
        break;
      case 'Sport Secretary':
        redirectUrl = 'votspo.php';
        break;
      default:
        redirectUrl = 'add_candidate.html';
    }
    window.location.href = redirectUrl;
  }
}

function voteForPost(position) {
  // This function would handle the voting process
  // For now, we'll just redirect similar to addCandidate
  addCandidate(position);
}

// Add event listeners for logout and back buttons
document.addEventListener('DOMContentLoaded', function() {
  const logoutButton = document.querySelector('.logout-button');
  
  if (logoutButton) {
    logoutButton.addEventListener('click', function(e) {
      e.preventDefault();
      if (confirm('Are you sure you want to logout?')) {
        // Redirect to logout page or clear session
        window.location.href = 'logout.php';
      }
    });
  }
  

  
});