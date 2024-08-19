<?php

use Dxnz\Hindiafest\Core\Router;
use Dxnz\Hindiafest\App\Controllers\IndexController;
use Dxnz\Hindiafest\App\Controllers\AuthController;
use Dxnz\Hindiafest\App\Controllers\AdminController;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Controllers/IndexController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';

// Router GET
Router::add('GET', '/', IndexController::class, 'index');
Router::add('GET', '/register', AuthController::class, 'showRegisterForm');
Router::add('GET', '/login', AuthController::class, 'showLoginForm');
Router::add('GET', '/logout', AuthController::class, 'logout');
Router::add('GET', '/admin', AdminController::class, 'dashboard');
Router::add('GET', '/admin/events', AdminController::class, 'showEvents');
Router::add('GET', '/admin/events/add', AdminController::class, 'showAddEventForm');
Router::add('GET', '/admin/manage-users', AdminController::class, 'manageUsers');
Router::add('GET', '/admin/users', AdminController::class, 'showUsers');
Router::add('GET', '/admin/users/edit', AdminController::class, 'editUser');

// Router POST
Router::add('POST', '/register', AuthController::class, 'register');
Router::add('POST', '/login', AuthController::class, 'login');
Router::add('POST', '/admin/events', AdminController::class, 'addEvent');
Router::add('POST', '/admin/events/add', AdminController::class, 'addEvent');
Router::add('POST', '/admin/events/delete', AdminController::class, 'deleteEvent');
Router::add('POST', '/admin/users/delete', AdminController::class, 'deleteUser');
Router::add('POST', '/admin/users/edit', AdminController::class, 'editUser');

Router::run();
