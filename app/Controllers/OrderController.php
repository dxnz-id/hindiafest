<?php

namespace Dxnz\Hindiafest\App\Controllers;

use Dxnz\Hindiafest\Core\View;
use Dxnz\Hindiafest\Models\Ticket;
use Dxnz\Hindiafest\Models\Event;

class OrderController
{
  private $ticketModel;
  private $eventModel;

  public function __construct()
  {
    $this->ticketModel = new Ticket();
    $this->eventModel = new Event();
  }

  public function showPurchasePage()
  {
    $eventId = $_GET['event_id'];
    $model = [
      'title' => 'Hindiafest',
      'username' => isset($_SESSION['username']) ? $_SESSION['username'] : null,
      'eventId' => $_GET['event_id'],
      'tickets' => $this->ticketModel->getTicketsByEventId($eventId),
      'event' => $this->eventModel->getEventById($eventId), // Method to get event details
    ];
    View::render('user/purchase_ticket', $model);
    // require '../View/content/user/purchase_ticket.php'; // Path to your view file
  }

  public function purchaseTicket()
  {
    // Ensure user is logged in
    session_start();
    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit;
    }

    $eventId = $_POST['event_id'];
    $ticketType = $_POST['ticket_type'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['user_id'];

    // Save the order
    $result = $this->ticketModel->createOrder($eventId, $ticketType, $quantity, $userId);

    if ($result) {
      header('Location: /confirmation');
    } else {
      // Handle error
      echo "Error processing your order.";
    }
  }

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
