<main class="container main-content">
  <h1 class="text-center">Manage Tickets for Event #<?= htmlspecialchars($event_id); ?></h1>

  <!-- Add Ticket Form -->
  <div class="card">
    <div class="card-body">
      <h2 class="card-title">Add New Ticket</h2>
      <form action="/admin/tickets/add" method="POST">
        <input type="hidden" name="event_id" value="<?= htmlspecialchars($event_id); ?>">
        <input type="text" name="ticket_type" placeholder="Ticket Type" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <button type="submit" class="btn btn-primary">Add Ticket</button>
      </form>
    </div>
  </div>

  <!-- Ticket List -->
  <h2 class="text-center">Current Tickets</h2>
  <div class="card-container">
    <?php foreach ($tickets as $ticket): ?>
      <div class="card">
        <div class="card-body">
          <h3 class="card-title"><?= htmlspecialchars($ticket['ticket_type']); ?></h3>
          <p class="card-text">Price: $<?= htmlspecialchars($ticket['price']); ?></p>
          <p class="card-text">Quantity: <?= htmlspecialchars($ticket['quantity']); ?></p>
          <form action="/admin/tickets/delete" method="POST" style="display:inline;">
            <input type="hidden" name="delete_id" value="<?= $ticket['id']; ?>">
            <input type="hidden" name="event_id" value="<?= $event_id; ?>">
            <button type="submit" class="btn btn-secondary">Delete</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>