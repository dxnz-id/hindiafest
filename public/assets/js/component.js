// components.js

document.addEventListener("DOMContentLoaded", function () {
  const modalTriggers = document.querySelectorAll("[data-modal-target]");

  modalTriggers.forEach((trigger) => {
    trigger.addEventListener("click", function () {
      const modalId = this.getAttribute("data-modal-target");
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.classList.add("is-active");
      }
    });
  });

  const closeModalButtons = document.querySelectorAll(".modal-close");

  closeModalButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const modal = this.closest(".modal");
      if (modal) {
        modal.classList.remove("is-active");
      }
    });
  });
});
