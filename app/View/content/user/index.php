<main class="container main-content">
  <h1 class="text-center">Upcoming Events</h1>

  <div class="card-container">
    <?php foreach ($events as $event): ?>
      <div class="card">
        <div class="card-body">
          <h3 class="card-title"><?= htmlspecialchars($event['event_name']) ?></h3>
          <p class="card-text"><?= htmlspecialchars($event['description']) ?></p>
          <p class="card-text"><?= date('F j, Y', strtotime($event['event_date'])) ?></p>
          <a href="<?= htmlspecialchars($event['location_url']) ?>" class="btn btn-secondary" target="_blank">Location</a>
          <a href="order?event_id=<?= htmlspecialchars($event['id']) ?>" class="btn btn-primary">Buy Ticket</a>
          <div class="ticket-details">
            <?php if (isset($event['ticket_id'])): ?>
              <p class="card-text">Ticket Type: <?= htmlspecialchars($event['ticket_type']) ?></p>
              <p class="card-text">Price: $<?= number_format($event['price'], 2) ?></p>
              <p class="card-text">Available Quantity: <?= htmlspecialchars($event['quantity']) ?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>