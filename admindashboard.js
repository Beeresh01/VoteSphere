function navigateToPage(pageUrl) {
  window.location.href = pageUrl;
}

function logout() {
  // Add your logout logic here
  // For example, redirect to login page:
  window.location.href = "login.html";
  
  // Or clear session storage and redirect:
  // sessionStorage.clear();
  // window.location.href = "login.html";
  
  // You can add confirmation dialog if needed:
  // if(confirm("Are you sure you want to logout?")) {
  //   window.location.href = "login.html";
  // }
}