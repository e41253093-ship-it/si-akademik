<?php
namespace App\Core;

use mysqli;
use Exception;

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $config = require __DIR__ . '/../../config/database.php';
        
        try {
            $this->conn = new mysqli(
                $config['host'],
                $config['username'],
                $config['password'],
                $config['database']
            );

            if ($this->conn->connect_error) {
                die("Koneksi Database Gagal: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Error Database: Pastikan database 'si_akademik' sudah di-import!");
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}