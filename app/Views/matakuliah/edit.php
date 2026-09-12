<?php
require_once __DIR__ . '/../../Models/MatakuliahModel.php';
$model = new MatakuliahModel();
$id = $_GET['id'] ?? null;
$mk = $model->getById($id);
$prodiList = $model->getProdiList();

if (!$mk) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model->update($id, $_POST['kode'], $_POST['nama'], $_POST['sks'], $_POST['prodi_id']);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
    <h4>Edit Mata Kuliah</h4>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Kode MK</label>
            <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($mk['kode']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($mk['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">SKS</label>
            <input type="number" name="sks" class="form-control" value="<?= htmlspecialchars($mk['sks']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select" required>
                <?php foreach ($prodiList as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= $p['id'] == $mk['prodi_id'] ? 'selected' : '' ?>>
                        <?= $p['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>