<?php

namespace Dxnz\Hindiafest\App\Controllers;

use Dxnz\Hindiafest\Core\View;
use Dxnz\Hindiafest\Models\User;
use Dxnz\Hindiafest\Models\Event;

class IndexController
{
  public function index()
  {
    session_start();

    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit;
    }

    // Cek apakah username ada di session
    if (isset($_SESSION['username'])) {

      // Pastikan userInfo tidak false dan memiliki key 'role'
      if ($_SESSION['role'] === 'admin') {
        header('Location: /admin');
        exit();
      }
    }

    $userModel = new User();
    $user = $userModel->findById($_SESSION['user_id']);
    $eventModel = new Event();

    // Prepare the model for the view
    $model = [
      'title' => "User Dashboard",
      'username' => $user['username'],
      'role' => $user['role'],
      'events' => $eventModel->getUpcomingEvents(),
    ];

    // Render the view
    View::render('user/index', $model);
  }
}
