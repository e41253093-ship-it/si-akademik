<?php

namespace App\Repositories;

use App\Core\Database;
use mysqli;

class MahasiswaRepository
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // Ambil SEMUA data mahasiswa (bisa juga dicari berdasarkan keyword)
    public function all(string $keyword = ''): array
    {
        $sql = "SELECT mahasiswa.*, prodi.nama AS nama_prodi
                FROM mahasiswa
                LEFT JOIN prodi ON mahasiswa.prodi_id = prodi.id";

        $data = [];

        if ($keyword !== '') {
            $sql .= " WHERE mahasiswa.nama LIKE CONCAT('%', ?, '%')
                         OR mahasiswa.nim LIKE CONCAT('%', ?, '%')
                      ORDER BY mahasiswa.id DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ss', $keyword, $keyword);
        } else {
            $sql .= " ORDER BY mahasiswa.id DESC";
            $stmt = $this->db->prepare($sql);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();

        return $data;
    }

    // Ambil SATU data mahasiswa berdasarkan id
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $row ?: null; // null kalau tidak ketemu
    }

    // Cek apakah NIM sudah dipakai orang lain
    public function existsByNim(string $nim, ?int $excludeId = null): bool
    {
        if ($excludeId !== null) {
            // dipakai saat EDIT: jangan bandingkan dengan data dirinya sendiri
            $stmt = $this->db->prepare("SELECT id FROM mahasiswa WHERE nim = ? AND id != ?");
            $stmt->bind_param('si', $nim, $excludeId);
        } else {
            $stmt = $this->db->prepare("SELECT id FROM mahasiswa WHERE nim = ?");
            $stmt->bind_param('s', $nim);
        }
        $stmt->execute();
        $found = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return (bool) $found;
    }

    // Tambah data mahasiswa baru
    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            'sssiss',
            $data['nim'], $data['nama'], $data['email'],
            $data['prodi_id'], $data['angkatan'], $data['status']
        );
        $stmt->execute();
        $id = $this->db->insert_id; // ambil id yang baru dibuat
        $stmt->close();

        return $id;
    }

    // Ubah data mahasiswa
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE mahasiswa SET
                nim = ?, nama = ?, email = ?, prodi_id = ?, angkatan = ?, status = ?
             WHERE id = ?"
        );
        $stmt->bind_param(
            'sssissi',
            $data['nim'], $data['nama'], $data['email'],
            $data['prodi_id'], $data['angkatan'], $data['status'], $id
        );
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    // Hapus data mahasiswa
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = ?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }
}