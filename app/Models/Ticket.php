<?php

namespace Dxnz\Hindiafest\Models;

use Dxnz\Hindiafest\Core\Database;

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


  public function getAllWithTickets()
  {
    $stmt = $this->db->query("SELECT * FROM events");
    $events = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($events as &$event) {
      $stmt = $this->db->prepare("SELECT * FROM tickets WHERE event_id = :event_id");
      $stmt->bindParam(':event_id', $event['id']);
      $stmt->execute();
      $event['tickets'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    return $events;
  }

  public function getTicketsByEventId($eventId)
  {
    $stmt = $this->db->prepare("SELECT * FROM tickets WHERE event_id = ?");
    $stmt->execute([$eventId]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function createOrder($eventId, $ticketType, $quantity, $userId)
  {
    $stmt = $this->db->prepare("INSERT INTO orders (event_id, ticket_type, quantity, user_id, created_at) VALUES (?, ?, ?, ?, NOW())");
    return $stmt->execute([$eventId, $ticketType, $quantity, $userId]);
  }
}
