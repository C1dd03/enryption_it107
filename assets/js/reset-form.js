// When the register toggle is clicked, reset to step 1
document.querySelectorAll('label[for="toggle"]').forEach((label) => {
  label.addEventListener("click", function () {
    // Only reset if going to register (toggle is being checked)
    setTimeout(() => {
      if (document.getElementById("toggle").checked) {
        document.getElementById("step1").checked = true;
      }
    }, 0);
  });
});

// Navbar link toggle logic
/* function updateNavLinks(link) {
        const loginLink = document.querySelector(".login-link");

        if (link === "login") {
          loginLink.textContent = "Register";
          loginLink.setAttribute("onclick", "updateNavLinks('register')");
        } else {
          loginLink.textContent = "Login";
          loginLink.setAttribute("onclick", "updateNavLinks('login')");
        }
      } */

// Navbar link toggle logic with form reset
function updateNavLinks(link) {
  const loginLink = document.querySelector(".login-link");
  const loginForm = document.querySelector(".login-form");
  const registerForm = document.querySelector(".register-form");

  if (link === "login") {
    // Show login, hide register
    loginForm.classList.add("active");
    registerForm.classList.remove("active");

    // Reset register form + step
    registerForm.reset();
    document.getElementById("step1").checked = true;

    // Update nav link
    loginLink.textContent = "Register";
    loginLink.setAttribute("onclick", "updateNavLinks('register')");
  } else {
    // Show register, hide login
    registerForm.classList.add("active");
    loginForm.classList.remove("active");

    // Reset login form
    loginForm.reset();

    // Update nav link
    loginLink.textContent = "Login";
    loginLink.setAttribute("onclick", "updateNavLinks('login')");
  }
}
