window.addEventListener("scroll", () => {
  const footer = document.querySelector(".footer");
  const footerTop = footer.getBoundingClientRect().top;
  const windowHeight = window.innerHeight;

  if (footerTop < windowHeight - 100) {
    footer.style.animationPlayState = "running";
  }
});