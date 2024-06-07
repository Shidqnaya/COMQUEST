const body = document.querySelector("body"),
  sidebar = body.querySelector("nav"),
  sidebarToggle = body.querySelector(".sidebar-toggle"),
  takequizbtns = document.querySelectorAll(".takequiz-btn"),
  popupInfo = document.querySelector(".popup-info"),
  exitBtn = document.querySelector(".exit-btn"),
  belibtns = document.querySelectorAll(".beli-btn"),
  popupBeli = document.querySelector(".popup-beli"),
  noBtn = document.querySelector(".no-btn");

sidebarToggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

takequizbtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    popupInfo.classList.add("active");
    dashContent.classList.add("active");
  });
});

exitBtn.addEventListener("click", () => {
  popupInfo.classList.remove("active");
});

belibtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    popupBeli.classList.add("active");
  });
});

noBtn.addEventListener("click", () => {
  popupBeli.classList.remove("active");
});
