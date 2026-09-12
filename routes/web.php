<?php
// Autoload class
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});

use App\Controllers\authcontroller;
use App\Controllers\MahasiswaController;

// Tangkap URI untuk URL cantik (public/login) atau query string (?action=login)
$request_uri = strtok($_SERVER['REQUEST_URI'], '?');
$action = $_GET['action'] ?? '';

$authController = new authcontroller();
$mahasiswaController = new MahasiswaController();

if (str_ends_with($request_uri, '/login') || $action === 'login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $authController->login();
    } else {
        $authController->showLoginForm();
    }
} elseif (str_ends_with($request_uri, '/logout') || $action === 'logout') {
    $authController->logout();
} else {
    // Jalankan CRUD Mahasiswa
    if ($action === 'create') {
        $mahasiswaController->create();
    } elseif ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $mahasiswaController->store();
    } elseif ($action === 'edit' && isset($_GET['id'])) {
        $mahasiswaController->edit((int)$_GET['id']);
    } elseif ($action === 'update' && isset($_GET['id'])) {
        $mahasiswaController->update((int)$_GET['id']);
    } elseif ($action === 'delete' && isset($_GET['id'])) {
        $mahasiswaController->delete((int)$_GET['id']);
    } else {
        $mahasiswaController->index();
    }
}