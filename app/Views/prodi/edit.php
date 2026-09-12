<?php
require_once __DIR__ . '/../../Models/ProdiModel.php';
$model = new ProdiModel();
$id = $_GET['id'] ?? null;
$prodi = $model->getById($id);

if (!$prodi) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model->update($id, $_POST['kode'], $_POST['nama']);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Prodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
    <h4>Edit Program Studi</h4>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Kode Prodi</label>
            <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($prodi['kode']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Prodi</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($prodi['nama']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>