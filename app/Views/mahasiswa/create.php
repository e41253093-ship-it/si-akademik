<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="container my-5">
    <div class="card shadow-sm border-0 col-md-8 mx-auto">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0 fw-bold">Tambah Mahasiswa</h5>
        </div>
        <div class="card-body p-4">
            <form action="index.php?action=store" method="POST">
                <div class="mb-3">
                    <label class="form-label font-weight-bold">NIM</label>
                    <input type="text" name="nim" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Program Studi</label>
                    <select name="prodi_id" class="form-select" required>
                        <option value="">-- Pilih Prodi --</option>
                        <?php foreach ($prodiList as $prodi): ?>
                            <option value="<?= $prodi['id'] ?>"><?= htmlspecialchars($prodi['nama']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Angkatan</label>
                    <input type="number" name="angkatan" class="form-control" value="2024" required>
                </div>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="aktif">Aktif</option>
                        <option value="cuti">Cuti</option>
                        <option value="lulus">Lulus</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between pt-2">
                    <a href="index.php?action=index" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>