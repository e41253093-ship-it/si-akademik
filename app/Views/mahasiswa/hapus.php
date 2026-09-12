<?php
require_once __DIR__ . '/../../Models/MahasiswaModel.php';
$model = new MahasiswaModel();

$id = $_GET['id'] ?? null;

if ($id) {
    $model->delete($id);
}

header("Location: index.php");
exit;
?>