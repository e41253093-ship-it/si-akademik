<?php
require_once __DIR__ . '/../../Models/ProdiModel.php';
$model = new ProdiModel();
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $model->delete($id);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        // Jika kena constraint foreign key (error code 23000 / 1451)
        echo "<script>
            alert('Gagal menghapus! Prodi ini masih digunakan oleh data Mata Kuliah atau Mahasiswa.');
            window.location.href = 'index.php';
        </script>";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>