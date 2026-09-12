<?php
namespace App\Middleware;

class AuthMiddleware
{
    public function handle()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Jika user belum login, lemparkan balik ke halaman login
        if (!isset($_SESSION['user'])) {
            $_SESSION['flash_message'] = "Silakan login terlebih dahulu!";
            header('Location: /si-akademik/public/login');
            exit;
        }
    }
}