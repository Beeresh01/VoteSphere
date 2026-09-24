document.addEventListener('DOMContentLoaded', function() {
    const candidates = document.querySelectorAll('.candidate');
    const voteButtons = document.querySelectorAll('.vote-btn');
    
    // Function to update vote counts display
    function updateVoteCounts() {
        fetch('votspo.php?get_votes=1')
            .then(response => response.json())
            .then(votes => {
                candidates.forEach(candidate => {
                    const candidateId = candidate.getAttribute('data-id');
                    const voteData = votes[candidateId];
                    
                    let countDisplay = candidate.querySelector('.vote-count');
                    if (!countDisplay) {
                        countDisplay = document.createElement('div');
                        countDisplay.className = 'vote-count';
                        candidate.appendChild(countDisplay);
                    }
                    
                    if (voteData) {
                        countDisplay.textContent = `${voteData.count} votes`;
                    } else {
                        countDisplay.textContent = '0 votes';
                    }
                });
            });
    }
    
    // Initial vote count load
    updateVoteCounts();
    
    // Set up vote buttons
    voteButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const candidateDiv = this.closest('.candidate');
            const candidateId = candidateDiv.getAttribute('data-id');
            
            // Disable all buttons during processing
            voteButtons.forEach(btn => btn.disabled = true);
            
            try {
                const response = await fetch('votspo.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `candidate_id=${candidateId}`
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update UI for successful vote
                    candidateDiv.classList.add('voted');
                    this.textContent = 'Voted!';
                    this.disabled = true;
                    
                    // Update vote count display
                    updateVoteCounts();
                    
                    // Show success message
                    alert(`Thank you for voting! ${candidateDiv.querySelector('h2').textContent} now has ${data.vote_count} votes.`);
                } else {
                    alert(data.message || 'Failed to record your vote. Please try again.');
                    voteButtons.forEach(btn => btn.disabled = false);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                voteButtons.forEach(btn => btn.disabled = false);
            }
        });
    });
    
    // Add click handler to entire candidate card
    candidates.forEach(candidate => {
        candidate.addEventListener('click', function(e) {
            if (!e.target.closest('.vote-btn') && !e.target.closest('.back-button')) {
                const button = this.querySelector('.vote-btn');
                if (button && !button.disabled) {
                    button.click();
                }
            }
        });
    });
    
    // Optional: Refresh vote counts periodically
    setInterval(updateVoteCounts, 30000); // Every 30 seconds
});