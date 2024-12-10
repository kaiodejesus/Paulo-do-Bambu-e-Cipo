document.addEventListener("DOMContentLoaded", () => {
    setupResponsiveMenu();
    setupSmoothScroll();
    setupFadeInOnScroll();
  });
  
  // Função para alternar o menu responsivo
  function setupResponsiveMenu() {
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");
    const barsIcon = menuToggle.querySelector(".fa-bars");
    const timesIcon = menuToggle.querySelector(".fa-times");
  
    menuToggle.addEventListener("click", () => {
      const isActive = navMenu.classList.toggle("active");
      barsIcon.style.display = isActive ? "none" : "block";
      timesIcon.style.display = isActive ? "block" : "none";
    });
  }
  
  // Função para rolagem suave
  function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener("click", (e) => {
        e.preventDefault();
        const targetId = anchor.getAttribute("href");
        document.querySelector(targetId).scrollIntoView({
          behavior: "smooth"
        });
      });
    });
  }
  
  // Função para animação de fade-in nas seções ao rolar
  function setupFadeInOnScroll() {
    const faders = document.querySelectorAll(".fade-in");
    const appearOptions = {
      threshold: 0.5,
      rootMargin: "0px 0px -50px 0px"
    };
  
    const appearOnScroll = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("appear");
          observer.unobserve(entry.target);
        }
      });
    }, appearOptions);
  
    faders.forEach(fader => {
      appearOnScroll.observe(fader);
    });
  }