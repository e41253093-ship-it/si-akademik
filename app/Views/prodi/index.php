<?php
require_once __DIR__ . '/../../Models/ProdiModel.php';
$model = new ProdiModel();
$dataProdi = $model->getAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white p-4 rounded shadow-sm">
    <h3 class="mb-4">Data Program Studi</h3>
    <a href="create.php" class="btn btn-primary mb-3">+ Tambah Prodi</a>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProdi as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['kode']) ?></td>
                <td><?= htmlspecialchars($p['nama']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus prodi ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>