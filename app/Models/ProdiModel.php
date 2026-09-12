<?php
namespace App\Models;

class ProdiModel extends BaseModel {

    public function getAllProdi() {
        $sql = "SELECT * FROM prodi ORDER BY nama ASC";
        $result = $this->db->query($sql);   // $this->db diwarisi dari BaseModel
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
}