<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark justify-content-between w-100">
    <div class="logo">
      <a href="/" class="navbar-brand text-primary">Hindia Fest</a>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="/" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="/admin/users" class="nav-link">User</a></li>
        <li class="nav-item"><a href="/admin/events" class="nav-link">Events</a></li>
        <?php if ($username): ?>
          <li class="nav-item"><a class="nav-link"><?php echo htmlspecialchars($username); ?>, <a href="/logout">Logout</a></a></li>
        <?php else: ?>
          <li class="nav-item"><a href="/login" class="nav-link btn btn-primary">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</header>