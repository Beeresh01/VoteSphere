function addCandidate(position) {
  const confirmed = confirm(`You are about to add a new candidate for ${position}. Continue?`);

   if (confirmed) {
        // Determine the redirect URL based on position
        let redirectUrl;
        switch(position) {
          case 'President':
            redirectUrl = 'addpres.php';
            break;
          case 'Vice-President':
            redirectUrl = 'addvice.php';
            break;
          case 'Cultural Secretary':
            redirectUrl = 'cultural.php';
            break;
          case 'Sport Secretary':
            redirectUrl = 'addspo.php';
            break;
          default:
            redirectUrl = 'add_candidate.php';
        }
        window.location.href = redirectUrl;
      }

}
