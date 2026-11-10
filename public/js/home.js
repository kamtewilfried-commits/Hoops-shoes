window.addEventListener("DOMContentLoaded", () => {
  const bienvenue = document.getElementById("bienvenue-message");
  if (bienvenue) {
    setTimeout(() => {
      bienvenue.style.opacity = "1";
      bienvenue.style.transform = "translateY(0)";
    }, 700); 
  }
});
