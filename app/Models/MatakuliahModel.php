<?php
namespace App\Models;

require_once __DIR__ . '/Model.php';

class MahasiswaModel extends Model {

    // Mengambil data mahasiswa (dukung pencarian Tugas Mandiri & SQL JOIN)
    public function getAll($keyword = null) {
        if ($keyword) {
            $sql = "SELECT m.*, p.nama AS prodi_nama 
                    FROM mahasiswa m 
                    JOIN prodi p ON m.prodi_id = p.id
                    WHERE m.nim LIKE :k1 OR m.nama LIKE :k2 OR m.email LIKE :k3
                    ORDER BY m.id DESC";
            
            $stmt = $this->db->prepare($sql);
            $searchTerm = "%{$keyword}%";
            $stmt->execute([
                'k1' => $searchTerm,
                'k2' => $searchTerm,
                'k3' => $searchTerm
            ]);
            return $stmt->fetchAll();
        } else {
            $sql = "SELECT m.*, p.nama AS prodi_nama 
                    FROM mahasiswa m 
                    JOIN prodi p ON m.prodi_id = p.id
                    ORDER BY m.id DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // Mengambil 1 data mahasiswa berdasarkan ID
    public function getById($id) {
        $sql = "SELECT m.*, p.nama AS prodi_nama 
                FROM mahasiswa m 
                JOIN prodi p ON m.prodi_id = p.id 
                WHERE m.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Menambah data mahasiswa
    public function create($nim, $nama, $email, $prodi_id, $angkatan, $status = 'aktif') {
        $sql = "INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status) 
                VALUES (:nim, :nama, :email, :prodi_id, :angkatan, :status)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nim'      => $nim,
            'nama'     => $nama,
            'email'    => $email,
            'prodi_id' => $prodi_id,
            'angkatan' => $angkatan,
            'status'   => $status
        ]);
    }

    // Memperbarui data mahasiswa
    public function update($id, $nim, $nama, $email, $prodi_id, $angkatan, $status) {
        $sql = "UPDATE mahasiswa 
                SET nim = :nim, nama = :nama, email = :email, prodi_id = :prodi_id, angkatan = :angkatan, status = :status 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id'       => $id,
            'nim'      => $nim,
            'nama'     => $nama,
            'email'    => $email,
            'prodi_id' => $prodi_id,
            'angkatan' => $angkatan,
            'status'   => $status
        ]);
    }

    // Menghapus data mahasiswa
    public function delete($id) {
        $sql = "DELETE FROM mahasiswa WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>