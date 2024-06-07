const badan = document.querySelector("body"),
  changeThemeRoastedPeach = badan.querySelector(".circleroastedpeach"),
  changeThemeSwimmingPool = badan.querySelector(".circleswimmingpool"),
  changeThemeCottonCandy = badan.querySelector(".circlecottoncandy"),
  dashContent = document.querySelector(".dash-content");

changeThemeRoastedPeach.addEventListener("click", () => {
  console.log("Clicked roastedpeach");
  badan.classList.toggle("roastedpeach");
  badan.classList.remove("swimmingpool", "cottoncandy", "purple", "green", "black", "blue");
  saveTheme("roastedpeach");
});

changeThemeSwimmingPool.addEventListener("click", () => {
  console.log("Clicked swimmingpool");
  badan.classList.toggle("swimmingpool");
  badan.classList.remove("roastedpeach", "cottoncandy", "purple", "green", "black", "blue");
  saveTheme("swimmingpool");
});

changeThemeCottonCandy.addEventListener("click", () => {
  console.log("Clicked cottoncandy");
  badan.classList.toggle("cottoncandy");
  badan.classList.remove("roastedpeach", "swimmingpool", "purple", "green", "black", "blue");
  saveTheme("cottoncandy");
});
