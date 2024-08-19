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

function addTicket() {
  const ticketsContainer = document.getElementById("tickets");
  const ticketGroup = document.createElement("div");
  ticketGroup.classList.add("ticket-group");

  ticketGroup.innerHTML = `
      <input type="text" name="ticket_type[]" placeholder="Ticket Type" required>
      <input type="number" name="price[]" placeholder="Price" required>
      <input type="number" name="quantity[]" placeholder="Quantity" required>
  `;

  ticketsContainer.appendChild(ticketGroup);
}
