const navList = document.querySelector(".navList");
const navBtn = document.querySelector(".hamburger");
const loginBtn = document.getElementById("loginBtn");
const dashboardBtn = document.getElementById("dashboardBtn");
const ctaBtn = Array.from(document.getElementsByClassName("ctaBtn"));
const planBtn = Array.from(document.getElementsByClassName("planBtn"));
// Toggle navigation menu
navBtn.addEventListener("click", () => {
  navBtn.classList.toggle("active");
  navList.classList.toggle("active");
});
navList.addEventListener("click", () => {
  if (window.innerWidth <= 800) {
    navBtn.classList.toggle("active");
    navList.classList.toggle("active");
  }
});

ctaBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    const sendTo = loginBtn ? "login.php" : dashboardBtn.parentElement.getAttribute("href");
    window.location.assign(sendTo);
  });
});
planBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    const membershipType = btn.parentElement.querySelector("h3").innerText;
    const sendTo = loginBtn ? `login.php?membership=${membershipType}` : `${dashboardBtn.parentElement.getAttribute("href")}?membership=${membershipType}`;
    window.location.assign(sendTo);
  });
});

// Update button content based on window width
function updateBtnContent() {
  const isMobile = window.innerWidth <= 800;
  if (loginBtn) {
    loginBtn.innerHTML = isMobile
      ? '<i class="fas fa-right-to-bracket"></i>'
      : "Join Now";
  }
  if (dashboardBtn) {
    dashboardBtn.innerHTML = isMobile
      ? '<span class="material-symbols-outlined" style="font-size:28px;">dashboard</span>'
      : "Dashboard";
  }
}

window.addEventListener("resize", updateBtnContent);
updateBtnContent();

// Slider functionality
const sliders = Array.from(document.getElementsByClassName("slider"));
const textContainers = Array.from(
  document.getElementsByClassName("textContainer")
);
let sliderCounter = 0;

setInterval(() => {
  sliders.forEach((slider, index) => {
    slider.style.opacity = index === sliderCounter ? "1" : "0";
  });
  textContainers.forEach((container, index) => {
    container.style.transform =
      index === sliderCounter ? "translateY(0)" : "translateY(100px)";
  });
  sliderCounter = (sliderCounter + 1) % sliders.length;
}, 3000);

// Initial transform for the first text container
setTimeout(() => {
  textContainers[0].style.transform = "translateY(0)";
}, 200);
setTimeout(() => {
  document.body.style.opacity = "1";
}, 100);
