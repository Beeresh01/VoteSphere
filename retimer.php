<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epic Countdown Timer</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
          --primary-color: #4361ee;
          --secondary-color: #3a0ca3;
          --accent-color: #f72585;
          --dark-color: #212529;
          --light-color: #f8f9fa;
          --glow-color: rgba(247, 37, 133, 0.7);
        }

        body {
          font-family: 'Poppins', sans-serif;
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
          margin: 0;
          background: linear-gradient(135deg, #000428 0%, #004e92 100%);
          color: var(--light-color);
          overflow: hidden;
          perspective: 1000px;
        }

        .countdown-container {
          text-align: center;
          background: rgba(0, 0, 0, 0.3);
          backdrop-filter: blur(15px);
          -webkit-backdrop-filter: blur(15px);
          padding: 3rem 4rem;
          border-radius: 20px;
          box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3),
                      0 0 30px rgba(67, 97, 238, 0.3),
                      0 0 60px rgba(247, 37, 133, 0.2);
          border: 1px solid rgba(255, 255, 255, 0.18);
          position: relative;
          overflow: hidden;
          z-index: 1;
          transform-style: preserve-3d;
          transition: all 0.5s ease;
        }

        .countdown-container:hover {
          transform: translateY(-5px) rotateX(5deg);
          box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4),
                      0 0 40px rgba(67, 97, 238, 0.4),
                      0 0 80px rgba(247, 37, 133, 0.3);
        }

        #countdown-timer h2 {
          margin-bottom: 1.5rem;
          font-size: 2rem;
          font-weight: 300;
          letter-spacing: 3px;
          text-transform: uppercase;
          text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
          position: relative;
          display: inline-block;
        }

        #countdown-timer h2::after {
          content: '';
          position: absolute;
          bottom: -10px;
          left: 50%;
          transform: translateX(-50%);
          width: 50%;
          height: 2px;
          background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
          border-radius: 50%;
          filter: blur(1px);
        }

        .timer {
          font-size: 6rem;
          font-weight: 700;
          font-family: 'Orbitron', sans-serif;
          color: white;
          text-shadow: 0 0 10px rgba(255, 255, 255, 0.5),
                      0 0 20px var(--glow-color);
          margin: 1.5rem 0;
          position: relative;
          display: inline-block;
          animation: float 3s ease-in-out infinite;
        }

        .timer span {
          display: inline-block;
          min-width: 1.2em;
          text-align: center;
        }

        .timer::after {
          content: '';
          position: absolute;
          bottom: -15px;
          left: 0;
          width: 100%;
          height: 4px;
          background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
          border-radius: 50%;
          filter: blur(2px);
          opacity: 0.8;
          transform: scaleX(0.8);
          transition: all 0.3s ease;
        }

        .countdown-container:hover .timer::after {
          transform: scaleX(1);
          opacity: 1;
        }

        .timer-separator {
          animation: pulse 1s infinite;
          margin: 0 5px;
        }

        .warning {
          color: var(--accent-color) !important;
          --glow-color: rgba(247, 37, 133, 0.9);
          animation: pulse 0.5s infinite alternate, shake 0.5s infinite alternate;
        }

        .critical {
          --glow-color: rgba(255, 0, 0, 0.9);
          animation: pulse 0.3s infinite alternate, shake 0.3s infinite alternate;
        }

        @keyframes pulse {
          0% { 
            transform: scale(1);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5),
                         0 0 20px var(--glow-color);
          }
          100% { 
            transform: scale(1.05);
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.7),
                        0 0 30px var(--glow-color);
          }
        }

        @keyframes shake {
          0%, 100% { transform: translateX(0); }
          25% { transform: translateX(-2px); }
          75% { transform: translateX(2px); }
        }

        @keyframes float {
          0%, 100% { transform: translateY(0); }
          50% { transform: translateY(-10px); }
        }

        .bg-circles {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: -1;
          overflow: hidden;
        }

        .bg-circles li {
          position: absolute;
          display: block;
          list-style: none;
          background: rgba(255, 255, 255, 0.1);
          animation: float 15s infinite linear;
          bottom: -150px;
          border-radius: 50%;
          filter: blur(5px);
        }

        .bg-circles li:nth-child(1) {
          left: 25%;
          width: 80px;
          height: 80px;
          animation-delay: 0s;
          background: radial-gradient(circle, rgba(67, 97, 238, 0.8), transparent 70%);
        }

        .bg-circles li:nth-child(2) {
          left: 10%;
          width: 20px;
          height: 20px;
          animation-delay: 2s;
          animation-duration: 12s;
          background: radial-gradient(circle, rgba(255, 255, 255, 0.8), transparent 70%);
        }

        .bg-circles li:nth-child(3) {
          left: 70%;
          width: 20px;
          height: 20px;
          animation-delay: 4s;
          background: radial-gradient(circle, rgba(255, 255, 255, 0.8), transparent 70%);
        }

        .bg-circles li:nth-child(4) {
          left: 40%;
          width: 60px;
          height: 60px;
          animation-delay: 0s;
          animation-duration: 18s;
          background: radial-gradient(circle, rgba(247, 37, 133, 0.6), transparent 70%);
        }

        .bg-circles li:nth-child(5) {
          left: 65%;
          width: 20px;
          height: 20px;
          animation-delay: 0s;
          background: radial-gradient(circle, rgba(67, 97, 238, 0.8), transparent 70%);
        }

        .confetti {
          position: absolute;
          width: 10px;
          height: 10px;
          background-color: var(--accent-color);
          opacity: 0;
        }

        .event-title {
          font-size: 1.5rem;
          margin-bottom: 0.5rem;
          color: var(--accent-color);
          text-shadow: 0 0 10px rgba(247, 37, 133, 0.5);
        }

        .target-date {
          font-size: 1.2rem;
          margin-bottom: 1.5rem;
          opacity: 0.8;
        }

        @media (max-width: 768px) {
          .countdown-container {
            padding: 2rem;
            width: 90%;
          }
          
          .timer {
            font-size: 3.5rem;
          }
          
          #countdown-timer h2 {
            font-size: 1.4rem;
          }
          
          .event-title {
            font-size: 1.2rem;
          }
          
          .target-date {
            font-size: 1rem;
          }
        }
    </style>
</head>
<body>
    <div class="countdown-container animate__animated animate__fadeIn">
        <div id="countdown-timer">
            <div class="event-title">RESULT COUNTDOWN</div>
            <h2>Time Remaining</h2>
            <div class="target-date">April 30, 2025 at 23:01:00</div>
            <div id="timer-display" class="timer">
                <span id="days">00</span><span class="timer-separator">:</span>
                <span id="hours">00</span><span class="timer-separator">:</span>
                <span id="minutes">00</span><span class="timer-separator">:</span>
                <span id="seconds">00</span>
            </div>
            <div id="message" class="animate__animated"></div>
        </div>
    </div>

    <ul class="bg-circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    <script>
        // DOM Elements
        const timerDisplay = document.getElementById('timer-display');
        const daysElement = document.getElementById('days');
        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        const secondsElement = document.getElementById('seconds');
        const messageElement = document.getElementById('message');

        // Set your target date and time here (format: "Month Day, Year HH:MM:SS")
        const TARGET_DATE = new Date("may 1, 2025 12:52:00").getTime();
        let countdownInterval;

        // Initialize timer
        function initializeTimer() {
            updateTimer(); // Run immediately to avoid initial delay
            countdownInterval = setInterval(updateTimer, 1000);
            
            // Add floating animation to timer container
            setInterval(() => {
                const countdownContainer = document.querySelector('.countdown-container');
                countdownContainer.style.transform = `translateY(${Math.sin(Date.now()/1000)*5}px)`;
            }, 50);
        }

        // Update timer display
        function updateTimer() {
            const now = new Date().getTime();
            const distance = TARGET_DATE - now;

            // Time calculations for days, hours, minutes and seconds
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Format display
            daysElement.textContent = days < 10 ? '0' + days : days;
            hoursElement.textContent = hours < 10 ? '0' + hours : hours;
            minutesElement.textContent = minutes < 10 ? '0' + minutes : minutes;
            secondsElement.textContent = seconds < 10 ? '0' + seconds : seconds;
            
            // Add warning when less than 1 day remains
            if (distance < (24 * 60 * 60 * 1000)) {
                timerDisplay.classList.add('warning');
                messageElement.textContent = "Less than 24 hours remaining!";
                messageElement.classList.add('animate__pulse');
            }
            
            // Add critical warning when less than 1 hour remains
            if (distance < (60 * 60 * 1000)) {
                timerDisplay.classList.add('critical');
                timerDisplay.classList.remove('warning');
                messageElement.textContent = "Less than 1 hour remaining!";
            }
            
            // If the countdown is finished
            if (distance < 0) {
                clearInterval(countdownInterval);
                daysElement.textContent = '00';
                hoursElement.textContent = '00';
                minutesElement.textContent = '00';
                secondsElement.textContent = '00';
                
                // Show celebration effects
                timerDisplay.classList.add('critical');
                messageElement.textContent = "TIME'S UP!";
                messageElement.classList.add('animate__heartBeat');
                
                // Create confetti
                createConfetti();
                
                // Redirect after 3 seconds
                setTimeout(() => {
                    window.location.href = "presresults.php";
                }, 3000);
            }
        }

        // Create confetti effect
        function createConfetti() {
            const colors = ['#f72585', '#4361ee', '#4cc9f0', '#f8961e', '#43aa8b'];
            
            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.top = -10 + 'px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                document.body.appendChild(confetti);
                
                // Animate confetti
                const animationDuration = Math.random() * 3 + 2;
                confetti.style.animation = `confettiFall ${animationDuration}s linear forwards`;
                
                // Add animation style dynamically
                const style = document.createElement('style');
                style.innerHTML = `
                    @keyframes confettiFall {
                        0% {
                            transform: translateY(0) rotate(0deg);
                            opacity: 1;
                        }
                        100% {
                            transform: translateY(100vh) rotate(${Math.random() * 360}deg);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);
                
                // Remove confetti after animation
                setTimeout(() => {
                    confetti.remove();
                    style.remove();
                }, animationDuration * 1000);
            }
        }

        // Initialize when page loads
        window.onload = initializeTimer;
    </script>
</body>
</html>