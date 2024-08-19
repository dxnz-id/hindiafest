<?php

namespace Dxnz\Hindiafest\App\Controllers;

use Dxnz\Hindiafest\Core\View;
use Dxnz\Hindiafest\Models\Event;
use Dxnz\Hindiafest\Models\User;
use Dxnz\Hindiafest\Middleware\AdminMiddleware;

class AdminController
{
  private $event;
  private $user;

  public function __construct()
  {
    AdminMiddleware::handle();  // Panggil middleware untuk memeriksa akses admin
    $this->event = new Event();
    $this->user = new User();
  }

  public function dashboard()
  {
    $totalUsers = $this->user->getCount();  // Method to get total number of users
    $totalEvents = $this->event->getCount();  // Method to get total number of events

    $model = [
      'title' => 'Admin | Dashboard',
      'username' => isset($_SESSION['username']) ? $_SESSION['username'] : null,
      'totalUsers' => $totalUsers,
      'totalEvents' => $totalEvents,
    ];

    View::render('admin/dashboard', $model);
  }

  public function showEvents()
  {
    $event = new Event();
    $model = [
      'title' => 'Admin | Events',
      'username' => isset($_SESSION['username']) ? $_SESSION['username'] : null,
      'events' => $event->getAll(),
    ];
    View::render('admin/events', $model);
  }

  public function addEvent()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $event_name = $_POST['event_name'];
      $event_date = $_POST['event_date'];
      $description = $_POST['description'];
      $location_url = $_POST['location_url'];

      $this->event->create($event_name, $event_date, $description, $location_url);
      header('Location: /admin/events');
    }
  }

  public function deleteEvent()
  {
    if (isset($_POST['delete_id'])) {
      $id = $_POST['delete_id'];
      $this->event->delete($id);
      header('Location: /admin/events');
    }
  }

  public function showUsers()
  {
    $users = $this->user->getAll();
    $model = [
      'title' => 'Admin | Users',
      'username' => isset($_SESSION['username']) ? $_SESSION['username'] : null,
      'users' => $users,
    ];
    View::render('admin/users', $model);
  }
  public function editUser()
  {
    // Pastikan pengguna memiliki hak akses admin
    if ($_SESSION['role'] !== 'admin') {
      header('Location: /');
      exit();
    }

    // Ambil ID dari query string
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id === null) {
      // Tangani jika ID tidak disediakan
      header('Location: /admin/users');
      exit();
    }

    $user = new User();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Ambil data dari form
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

      // Perbarui data user
      if ($user->update($id, $username, $email, $password)) {
        // Redirect setelah sukses
        header('Location: /admin/users');
        exit();
      } else {
        $error = "Failed to update user.";
      }
    }

    // Ambil data user untuk form
    $userData = $user->findById($id);

    $model = [
      'title' => 'Edit User',
      'username' => isset($_SESSION['username']) ? $_SESSION['username'] : null,
      'user' => $userData,
      'error' => isset($error) ? $error : null
    ];

    View::render('admin/user_edit', $model);
  }

  public function deleteUser()
  {
    // Pastikan pengguna memiliki hak akses admin
    if ($_SESSION['role'] !== 'admin') {
      header('Location: /');
      exit();
    }

    // Periksa apakah ID pengguna yang akan dihapus dikirim melalui POST
    if (isset($_POST['delete_id'])) {
      $id = $_POST['delete_id'];

      // Panggil metode delete dari model User
      if ($this->user->delete($id)) {
        // Redirect setelah sukses
        header('Location: /admin/users');
        exit();
      } else {
        // Tangani kegagalan penghapusan
        $error = "Failed to delete user.";
      }
    }

    // Jika tidak ada ID yang dikirim, redirect kembali ke halaman pengguna
    header('Location: /admin/users');
    exit();
  }
  // Tambahkan fungsi lainnya untuk admin seperti manage users, events, etc.
}
