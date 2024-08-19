<?php

namespace Dxnz\Hindiafest\Middleware;

class AdminMiddleware
{
  public static function handle()
  {
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
      header('Location: /');
      exit();
    }
  }
}
