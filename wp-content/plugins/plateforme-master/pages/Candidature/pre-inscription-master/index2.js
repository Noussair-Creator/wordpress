

const addBtn = document.getElementById('goto');

addBtn.addEventListener('click', () => {
    window.location.href = "../ListeMaster/index.html";

});

document.addEventListener("DOMContentLoaded", function () {
    const radioButtons = document.querySelectorAll('input[name="doctorat"]');
    const cards = document.querySelectorAll('.card');
  
    radioButtons.forEach((radio) => {
      radio.addEventListener("change", () => {
        cards.forEach((card) => {
          card.style.border = "none"; // Reset all
        });
  
        // Add red border to the selected radio's parent card
        const selectedCard = radio.closest(".card");
        if (selectedCard) {
          selectedCard.style.border = "2px solid #BF0404";
        }
      });
  
      // Trigger initial style if already selected
      if (radio.checked) {
        const selectedCard = radio.closest(".card");
        if (selectedCard) {
          selectedCard.style.border = "2px solid #BF0404";
        }
      }
    });
  });
  