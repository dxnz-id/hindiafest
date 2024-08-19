document.addEventListener("DOMContentLoaded", () => {
  const modal = document.querySelector(".modal");
  const modalClose = document.querySelector(".modal-close");

  document.querySelectorAll(".btn-primary, .btn-secondary").forEach((btn) => {
    btn.addEventListener("click", () => {
      modal.classList.add("is-active");
    });
  });

  modalClose.addEventListener("click", () => {
    modal.classList.remove("is-active");
  });
});
