<?php

namespace Dxnz\Hindiafest\Controllers;

use Dxnz\Hindiafest\Core\View;
use Dxnz\Hindiafest\Models\Ticket;
use Dxnz\Hindiafest\Models\Event;

class ConfirmationController
{
  public function confirmation()
  {
    $model = [
      'title' => 'Hindiafest',
      'username' => isset($_SESSION['username']) ? $_SESSION['username'] : null,
    ];
    // Logika lain bisa ditambahkan di sini jika diperlukan.
    View::render('user/confirmation', $model);
  }
}
