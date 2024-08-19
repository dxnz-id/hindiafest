<?php

namespace Dxnz\Hindiafest\Models;

use Dxnz\Hindiafest\Core\Database;

class Event
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getConnection();
  }

  // Create a new event
  public function create($event_name, $event_date, $description, $location_url)
  {
    $stmt = $this->db->prepare("INSERT INTO events (event_name, event_date, description, location_url) VALUES (:event_name, :event_date, :description, :location_url)");
    $stmt->bindParam(':event_name', $event_name);
    $stmt->bindParam(':event_date', $event_date);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':location_url', $location_url);

    if ($stmt->execute()) {
      // Return the ID of the newly created event
      return $this->db->lastInsertId();
    } else {
      return false;
    }
  }

  // Read a single event by ID
  public function read($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  // Update an existing event
  public function update($id, $event_name, $event_date, $description, $location_url)
  {
    $stmt = $this->db->prepare("UPDATE events SET event_name = ?, event_date = ?, description = ?, location_url = ? WHERE id = ?");
    return $stmt->execute([$event_name, $event_date, $description, $location_url, $id]);
  }

  // Delete an event along with related tickets
  public function delete($id)
  {
    try {
      // Start a transaction
      $this->db->beginTransaction();

      // Delete related tickets
      $ticketStmt = $this->db->prepare("DELETE FROM tickets WHERE event_id = ?");
      $ticketStmt->execute([$id]);

      // Delete the event
      $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
      $stmt->execute([$id]);

      // Commit the transaction
      $this->db->commit();

      return true;
    } catch (\Exception $e) {
      // Rollback the transaction if something goes wrong
      $this->db->rollBack();
      error_log($e->getMessage());
      return false;
    }
  }

  // Get all events
  public function getAll()
  {
    $stmt = $this->db->query("SELECT * FROM events ORDER BY event_date DESC");
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getCount()
  {
    $query = "SELECT COUNT(*) FROM events"; // Adjust the table name as necessary
    $stmt = $this->db->query($query);
    return $stmt->fetchColumn();
  }
}
