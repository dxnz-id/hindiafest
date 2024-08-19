<?php

namespace Dxnz\Hindiafest\App\Controllers;

use Dxnz\Hindiafest\Core\View;
use Dxnz\Hindiafest\Models\User;

class AuthController
{
    public function showRegisterForm()
    {
        $model = [
            "title" => "Hindiafest",
            "username" => isset($_SESSION['username']) ? $_SESSION['username'] : null,
            "content" => "Welcome to hindiafest",
        ];
        View::render('auth/register', $model);
    }

    public function register()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validasi sederhana
        if ($password !== $confirm_password) {
            echo "Password and Confirm Password do not match!";
            return;
        }

        // Validasi keberadaan email
        if (User::emailExists($email)) {
            echo "Email already registered!";
            return;
        }

        // Hash password
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $user = new User();

        // Insert ke database
        if ($user->create($username, $email, $password)) {
            echo "Registration successful!";
            // Redirect ke halaman login atau dashboard
            header('Location: /login');
            exit;
        } else {
            echo "Registration failed!";
        }
    }

    public function showLoginForm()
    {
        $model = [
            "title" => "Hindiafest",
            "username" => isset($_SESSION['username']) ? $_SESSION['username'] : null,
            "content" => "Welcome to hindiafest",
        ];
        View::render('auth/login', $model);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi input
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Cek ke database
            $userModel = new User();
            $user = $userModel->findByEmail($email);
            var_dump($user);
            if ($user && password_verify($password, $user['password'])) {
                // Login berhasil
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                echo 'Login successful';
                // Redirect to dashboard or home page
                header('Location: /');
                exit;
            } else {
                echo 'Invalid email or password';
            }
        }
    }

    public function checkLogin()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            return $_SESSION['username'];
        }
        return null;
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
        exit();
    }
}
