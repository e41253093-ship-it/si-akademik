<?php
require_once __DIR__ . '/../../Models/MatakuliahModel.php';
$model = new MatakuliahModel();
$prodiList = $model->getProdiList();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model->create($_POST['kode'], $_POST['nama'], $_POST['sks'], $_POST['prodi_id']);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
    <h4>Tambah Mata Kuliah Baru</h4>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Kode MK</label>
            <input type="text" name="kode" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">SKS</label>
            <input type="number" name="sks" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select" required>
                <option value="">-- Pilih Prodi --</option>
                <?php foreach ($prodiList as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>