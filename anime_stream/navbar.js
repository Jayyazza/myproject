document.addEventListener("DOMContentLoaded", () => {
  const navbar = document.querySelector("nav");
  const links = document.querySelectorAll("nav a");

  navbar.style.opacity = "0";
  navbar.style.transform = "translateY(-20px)";
  navbar.style.transition = "all 1s ease";

  setTimeout(() => {
    navbar.style.opacity = "1";
    navbar.style.transform = "translateY(0)";
  }, 200);

  links.forEach((link, index) => {
    link.style.opacity = "0";
    link.style.transition = "all 0.8s ease";
    setTimeout(() => {
      link.style.opacity = "1";
      link.style.textShadow = "0 0 8px #00e5ff, 0 0 15px #ff00ff";
    }, 400 + index * 200);

    setTimeout(() => {
      link.style.textShadow = "none";
    }, 2000 + index * 200);
  });
});