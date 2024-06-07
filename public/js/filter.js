function filterObject(category) {
  let cards = document.querySelectorAll(".matkul");

  cards.forEach((card) => {
    if (category === "all" || card.classList.contains(category)) {
      card.style.display = "flex";
    } else {
      card.style.display = "none";
    }
  });
}
