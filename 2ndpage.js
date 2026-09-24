document.addEventListener("DOMContentLoaded", () => {
  const voterBtn = document.getElementById("voter-btn");
  const adminBtn = document.getElementById("admin-btn");
  const resultBtn = document.getElementById("result-btn");
  const backBtn = document.getElementById("back-btn");

  const addRippleEffect = (btn) => {
    btn.addEventListener("click", function(e) {
      const ripple = document.createElement("span");
      ripple.className = "ripple";
      ripple.style.left = `${e.clientX - btn.getBoundingClientRect().left}px`;
      ripple.style.top = `${e.clientY - btn.getBoundingClientRect().top}px`;
      btn.appendChild(ripple);
      setTimeout(() => ripple.remove(), 1000);
    });
  };

  addRippleEffect(voterBtn);
  addRippleEffect(adminBtn);
  addRippleEffect(resultBtn);
  addRippleEffect(backBtn);

  voterBtn.addEventListener("click", () => {
    window.location.href = "resis.php";
  });

  adminBtn.addEventListener("click", () => {
    window.location.href = "adminlogin.php";
  });

  resultBtn.addEventListener("click", () => {
   window.location.href = "votlog.php";
  });

  backBtn.addEventListener("click", () => {
    window.history.back();
  });
});
