<?php
namespace App\Models;

use App\Core\Database;

class Mahasiswa {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllMahasiswa($keyword = '') {
        // PERBAIKAN: prodi.nama AS nama_prodi
        $sql = "SELECT mahasiswa.*, prodi.nama AS nama_prodi 
                FROM mahasiswa 
                LEFT JOIN prodi ON mahasiswa.prodi_id = prodi.id";

        if (!empty($keyword)) {
            $keywordClean = $this->db->real_escape_string($keyword);
            $sql .= " WHERE mahasiswa.nama LIKE '%$keywordClean%' OR mahasiswa.nim LIKE '%$keywordClean%'";
        }

        $sql .= " ORDER BY mahasiswa.id DESC";

        $result = $this->db->query($sql);
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getMahasiswaById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM mahasiswa WHERE id = $id";
        $result = $this->db->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data) {
        $nim = $this->db->real_escape_string($data['nim']);
        $nama = $this->db->real_escape_string($data['nama']);
        $email = $this->db->real_escape_string($data['email']);
        $prodi_id = (int)$data['prodi_id'];
        $angkatan = $this->db->real_escape_string($data['angkatan']);
        $status = $this->db->real_escape_string($data['status']);

        $sql = "INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status) 
                VALUES ('$nim', '$nama', '$email', $prodi_id, '$angkatan', '$status')";
        return $this->db->query($sql);
    }

    public function update($id, $data) {
        $id = (int)$id;
        $nim = $this->db->real_escape_string($data['nim']);
        $nama = $this->db->real_escape_string($data['nama']);
        $email = $this->db->real_escape_string($data['email']);
        $prodi_id = (int)$data['prodi_id'];
        $angkatan = $this->db->real_escape_string($data['angkatan']);
        $status = $this->db->real_escape_string($data['status']);

        $sql = "UPDATE mahasiswa SET 
                nim = '$nim', 
                nama = '$nama', 
                email = '$email', 
                prodi_id = $prodi_id, 
                angkatan = '$angkatan', 
                status = '$status' 
                WHERE id = $id";
        return $this->db->query($sql);
    }

    public function delete($id) {
        $id = (int)$id;
        return $this->db->query("DELETE FROM mahasiswa WHERE id = $id");
    }
}