<?php

namespace Dxnz\Hindiafest\Models;

use Dxnz\Hindiafest\Core\Database;
use PDO;

class Ticket
{
  protected $db;

  public function __construct()
  {
    $this->db = Database::getConnection();
  }

  public function create($event_id, $ticket_type, $price, $quantity)
  {
    try {
      // Check if event_id exists
      $eventStmt = $this->db->prepare("SELECT COUNT(*) FROM events WHERE id = :event_id");
      $eventStmt->bindParam(':event_id', $event_id);
      $eventStmt->execute();
      $eventExists = $eventStmt->fetchColumn();

      if (!$eventExists) {
        throw new Exception("Event ID does not exist.");
      }

      // Insert ticket
      $stmt = $this->db->prepare("INSERT INTO tickets (event_id, ticket_type, price, quantity) VALUES (:event_id, :ticket_type, :price, :quantity)");
      $stmt->bindParam(':event_id', $event_id);
      $stmt->bindParam(':ticket_type', $ticket_type);
      $stmt->bindParam(':price', $price);
      $stmt->bindParam(':quantity', $quantity);

      if (!$stmt->execute()) {
        throw new Exception("Failed to add ticket.");
      }

      return true;
    } catch (Exception $e) {
      // Handle exception: log it, rethrow it, or display an error message
      error_log($e->getMessage());
      throw $e;
    }
  }

  public static function updateQuantity($ticketId, $quantity)
  {
    // Asumsikan Anda memiliki koneksi database yang sudah tersedia
    $db = Database::getConnection();

    // Update kuantitas tiket di database
    $stmt = $db->prepare("UPDATE tickets SET quantity = quantity - ? WHERE id = ?");
    $stmt->execute([$quantity, $ticketId]);
  }

  public function getAllWithTickets()
  {
    $stmt = $this->db->query("SELECT * FROM events");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($events as &$event) {
      $stmt = $this->db->prepare("SELECT * FROM tickets WHERE event_id = :event_id");
      $stmt->bindParam(':event_id', $event['id']);
      $stmt->execute();
      $event['tickets'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $events;
  }

  public static function getTicketsByEventId($eventId)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM tickets WHERE event_id = ?");
    $stmt->execute([$eventId]);
    return $stmt->fetchAll();
  }

  public function getTicketTypesByEventId($eventId)
  {
    $stmt = $this->db->prepare("SELECT DISTINCT ticket_type FROM tickets WHERE event_id = ?");
    $stmt->execute([$eventId]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
  }

  public function createOrder($eventId, $ticketType, $quantity, $userId)
  {
    $stmt = $this->db->prepare("SELECT price FROM tickets WHERE event_id = ? AND ticket_type = ?");
    $stmt->execute([$eventId, $ticketType]);
    $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ticket) {
      throw new \Exception("Ticket not found.");
    }

    // Calculate the total amount
    $totalAmount = $ticket['price'] * $quantity;

    // Insert the order with total amount
    $stmt = $this->db->prepare("INSERT INTO orders (event_id, ticket_type, quantity, user_id, total_amount, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    return $stmt->execute([$eventId, $ticketType, $quantity, $userId, $totalAmount]);
  }

  public static function getTicketId($ticketType, $eventId)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT id FROM tickets WHERE event_id = ? AND ticket_type = ?");
    $stmt->execute([$eventId, $ticketType]);
    return $stmt->fetchColumn();
  }

  public static function validateTicketQuantity($ticketId, $quantity)
  {
    $ticketModel = new Ticket();
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT quantity FROM tickets WHERE id = ?");
    $stmt->execute([$ticketId]);
    $availableQuantity = $stmt->fetchColumn();

    if ($availableQuantity < $quantity) {
      throw new \Exception("Not enough tickets available.");
    }
  }
}
