<?php

namespace App\Repositories;

use App\Core\Database;
use mysqli;

class ProdiRepository
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(): array
    {
        $result = $this->db->query("SELECT * FROM prodi ORDER BY nama ASC");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM prodi WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }
}