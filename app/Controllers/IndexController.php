<?php

namespace Dxnz\Hindiafest\App\Controllers;

use Dxnz\Hindiafest\Core\View;
use Dxnz\Hindiafest\Models\User;

class IndexController
{
  public function index()
  {
    session_start();

    // Cek apakah username ada di session
    if (isset($_SESSION['username'])) {

      // Pastikan userInfo tidak false dan memiliki key 'role'
      if ($_SESSION['role'] === 'admin') {
        header('Location: /admin');
        exit();
      }
    }

    $model = [
      "title" => "Hindiafest",
      "username" => isset($_SESSION['username']) ? $_SESSION['username'] : null,
      "content" => "Welcome to Hindiafest",
    ];
    View::render('index', $model);
  }
}
