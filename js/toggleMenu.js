const initToggle = (retries = 50) => {
  const headerNav = document.querySelector(".headerNav ul");
  const toggleMenu = document.querySelector(".toggleMenu");

  if (!headerNav || !toggleMenu) {
    if (retries > 0) {
      setTimeout(() => initToggle(retries - 1), 100);
    } else {
      console.warn("Toggle menu elements not found");
    }
    return;
  }

  toggleMenu.addEventListener("click", () => {
    toggleMenu.classList.toggle("open");
    headerNav.classList.toggle("open");
  });
};

export default initToggle;
