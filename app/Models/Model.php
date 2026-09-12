<?php
namespace App\Models;

// Ambil file Database (sesuaikan path jika tersimpan di folder lain, misal Config atau Core)
if (file_exists(__DIR__ . '/../Config/Database.php')) {
    require_once __DIR__ . '/../Config/Database.php';
} elseif (file_exists(__DIR__ . '/../Core/Database.php')) {
    require_once __DIR__ . '/../Core/Database.php';
} else {
    require_once __DIR__ . '/../../config/Database.php';
}

class Model {
    protected $db;

    public function __construct() {
        // Cek method yang tersedia pada kelas Singleton Database agar tidak crash/eror
        if (method_exists('Database', 'getInstance')) {
            $instance = \Database::getInstance();
            // Jika getInstance() mengembalikan object Database yang punya method getConnection()
            if (is_object($instance) && method_exists($instance, 'getConnection')) {
                $this->db = $instance->getConnection();
            } else {
                $this->db = $instance;
            }
        } elseif (method_exists('Database', 'getConnection')) {
            $this->db = \Database::getConnection();
        } else {
            // Fallback koneksi PDO biasa jika tidak menggunakan Singleton murni
            $this->db = new \PDO("mysql:host=localhost;dbname=si_akademik", "root", "");
        }
    }
}
?>