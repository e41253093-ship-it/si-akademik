<?php
require_once __DIR__ . '/../../Models/MatakuliahModel.php';
$model = new MatakuliahModel();
$dataMK = $model->getAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white p-4 rounded shadow-sm">
    <h3 class="mb-4">Data Mata Kuliah</h3>
    <a href="create.php" class="btn btn-primary mb-3">+ Tambah Mata Kuliah</a>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataMK as $mk): ?>
            <tr>
                <td><?= htmlspecialchars($mk['kode']) ?></td>
                <td><?= htmlspecialchars($mk['nama']) ?></td>
                <td><?= htmlspecialchars($mk['sks']) ?></td>
                <td><?= htmlspecialchars($mk['prodi_nama']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $mk['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $mk['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>