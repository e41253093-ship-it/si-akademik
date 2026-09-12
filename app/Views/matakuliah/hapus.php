<?php
require_once __DIR__ . '/../../Models/MatakuliahModel.php';

$model = new MatakuliahModel();
$id = $_GET['id'] ?? null;

if ($id) {
    $model->delete($id);
}

header("Location: index.php");
exit;
?>