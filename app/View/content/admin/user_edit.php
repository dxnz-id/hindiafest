<main class="container">
  <h1><?= htmlspecialchars($model['title']) ?></h1>

  <?php if ($model['error']): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($model['error']) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <input type="hidden" name="id" value="<?= htmlspecialchars($model['user']['id']) ?>">
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?= htmlspecialchars($model['user']['username']) ?>" required>
    </div>
    <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($model['user']['email']) ?>" required>
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</main>