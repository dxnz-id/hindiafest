<main class="container main-content">
  <h1 class="text-center">Purchase Tickets for <?= htmlspecialchars($event['event_name']) ?></h1>
  <p class="text-center">Date: <?= date('F j, Y', strtotime($event['event_date'])) ?></p>

  <div class="card-container">
    <?php foreach ($tickets as $ticket): ?>
      <div class="card">
        <div class="card-body">
          <h3 class="card-title"><?= htmlspecialchars($ticket['ticket_type']) ?></h3>
          <p class="card-text">Price: $<?= number_format($ticket['price'], 2) ?></p>
          <p class="card-text">Available Quantity: <?= htmlspecialchars($ticket['quantity']) ?></p>
          <form action="/purchase" method="POST">
            <input type="hidden" name="event_id" value="<?= htmlspecialchars($eventId) ?>">
            <input type="hidden" name="ticket_type" value="<?= htmlspecialchars($ticket['ticket_type']) ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="<?= htmlspecialchars($ticket['quantity']) ?>" required>

            <!-- Add payment method selection -->
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
              <option value="credit_card">Credit Card</option>
              <option value="gopay">GoPay</option>
            </select>

            <button type="submit" class="btn btn-primary">Buy Now</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>