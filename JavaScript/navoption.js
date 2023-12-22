//Toggle button positioning
window.addEventListener("resize", positionToggleBtn);

function positionToggleBtn() {
  const toggleBtn = document.querySelector(".toggle-btn");
  const navbar = document.querySelector("header.navbar");
  const navbarRect = navbar.getBoundingClientRect();

  toggleBtn.style.top = navbarRect.top + navbarRect.height / 2 + "px";
}

// Define the toggleNavLinks function in the global scope
function toggleNavLinks() {
  const navLinks = document.querySelector(".navlinks");
  const overlay = document.querySelector(".overlay");

  if (navLinks.style.display === "block") {
    navLinks.style.display = "none";
    overlay.style.display = "none";
  } else {
    navLinks.style.display = "block";
    overlay.style.display = "block";
  }

  // Update the position of the toggle button after the display is toggled
  setTimeout(positionToggleBtn, 0);
}

// Position the toggle button initially
positionToggleBtn();
