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

  public function getByEventId($event_id)
  {
    $stmt = $this->db->prepare("SELECT * FROM tickets WHERE event_id = :event_id");
    $stmt->bindParam(':event_id', $event_id, \PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function create($event_id, $ticket_type, $price, $quantity)
  {
    $stmt = $this->db->prepare("INSERT INTO tickets (event_id, ticket_type, price, quantity) VALUES (:event_id, :ticket_type, :price, :quantity)");
    $stmt->bindParam(':event_id', $event_id, \PDO::PARAM_INT);
    $stmt->bindParam(':ticket_type', $ticket_type);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    return $stmt->execute();
  }

  public function delete($id)
  {
    $stmt = $this->db->prepare("DELETE FROM tickets WHERE id = :id");
    $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
    return $stmt->execute();
  }

  // Additional methods like update, etc., can be added as needed.
}
