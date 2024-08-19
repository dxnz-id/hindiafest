<main class="container main-content">
  <h1 class="text-center">Manage Events</h1>

  <!-- Add Event Form -->
  <div class="card">
    <div class="card-body">
      <h2 class="card-title">Add New Event</h2>
      <form action="/admin/events" method="POST">
        <input type="text" name="event_name" placeholder="Event Name" required>
        <input type="date" name="event_date" required>
        <textarea name="description" placeholder="Event Description" required></textarea>
        <input type="text" name="location_url" placeholder="Location URL" required>

        <h3 class="card-title">Add Tickets</h3>
        <div id="tickets">
          <div class="ticket-group">
            <input type="text" name="ticket_type[]" placeholder="Ticket Type" required>
            <input type="number" name="price[]" placeholder="Price" required>
            <input type="number" name="quantity[]" placeholder="Quantity" required>
          </div>
        </div>
        <button type="button" class="btn btn-secondary" onclick="addTicket()">Add Another Ticket</button>

        <button type="submit" class="btn btn-primary">Add Event</button>
      </form>
    </div>
  </div>

  <!-- Event List -->
  <h2 class="text-center">Current Events</h2>
  <div class="card-container">
    <?php foreach ($events as $event): ?>
      <div class="card">
        <div class="card-body">
          <h3 class="card-title"><?= htmlspecialchars($event['event_name']); ?></h3>
          <p class="card-text"><?= htmlspecialchars($event['event_date']); ?></p>
          <p class="card-text"><?= htmlspecialchars($event['description']); ?></p>
          <a href="<?= htmlspecialchars($event['location_url']); ?>" class="btn btn-primary" target="_blank">View Location</a>

          <h4>Tickets:</h4>
          <?php if (!empty($event['tickets'])): ?>
            <?php foreach ($event['tickets'] as $ticket): ?>
              <p>Type: <?= htmlspecialchars($ticket['ticket_type']); ?> | Price: <?= htmlspecialchars($ticket['price']); ?> | Quantity: <?= htmlspecialchars($ticket['quantity']); ?></p>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No tickets available for this event.</p>
          <?php endif; ?>

          <form action="/admin/events/delete" method="POST" style="display:inline;">
            <input type="hidden" name="delete_id" value="<?= $event['id']; ?>">
            <button type="submit" class="btn btn-secondary">Delete</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>