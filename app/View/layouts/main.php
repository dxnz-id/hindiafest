<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../partials/head.php'; ?>

<body>
  <?php
  if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    include __DIR__ . '/../partials/header_admin.php';
  } else {
    include __DIR__ . '/../partials/header_user.php';
  }
  include __DIR__ . '/../content/' . $view . '.php';
  include __DIR__ . '/../partials/footer.php';
  include __DIR__ . '/../partials/js.php';
  ?>
</body>

</html>