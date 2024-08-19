<main class="container main-content">
  <h1 class="text-center">Manage Users</h1>

  <!-- User List -->
  <div class="card-container">
    <?php foreach ($users as $user): ?>
      <div class="card">
        <div class="card-body">
          <h3 class="card-title"><?= htmlspecialchars($user['username']); ?></h3>
          <p class="card-text"><?= htmlspecialchars($user['email']); ?></p>
          <p class="card-text"><?= htmlspecialchars($user['role']); ?></p>
          <form action="/admin/users/delete" method="POST" style="display:inline;">
            <input type="hidden" name="delete_id" value="<?= $user['id']; ?>">
            <button type="submit" class="btn btn-primary">Delete</button>
          </form>
          <a href="/admin/users/edit?id=<?= $user['id']; ?>" class="btn btn-secondary">Edit</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>