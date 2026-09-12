<?php
namespace App\Controllers;

use App\Core\Database;

class authcontroller {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function showLoginForm() {
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Jika tabel users belum ada / kosongan, izinkan login bypass bawaan
        if (!empty($username) && !empty($password)) {
            $_SESSION['user'] = $username;
            
            // Redirect langsung ke daftar mahasiswa
            header('Location: ../public/index.php?action=index');
            exit;
        } else {
            header('Location: ../public/login');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../public/login');
        exit;
    }
}