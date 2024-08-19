<?php

namespace Dxnz\Hindiafest\App\Controllers;

use Dxnz\Hindiafest\Core\View;
use Dxnz\Hindiafest\Models\Event;

class EventController
{
  public function index()
  {
    $eventModel = new Event();
    $events = $eventModel->getAll();

    // Determine if the user is logged in
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

    $model = [
      'title' => 'Upcoming Events | HindiaFest',
      'username' => $username,
      'events' => $events,
    ];

    View::render('index', $model);
  }
}
