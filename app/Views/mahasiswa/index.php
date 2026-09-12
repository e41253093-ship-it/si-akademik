<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="container my-5">

    <?php if (!empty($flash)) : ?>
        <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">Daftar Mahasiswa</h5>
            <a href="index.php?action=create" class="btn btn-light btn-sm fw-semibold">+ Tambah Mahasiswa</a>
        </div>

        <div class="card-body p-4">
            <!-- Form Pencarian -->
            <form action="" method="GET" class="mb-4">
                <input type="hidden" name="action" value="index">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Cari nama atau NIM..." 
                               value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary px-4 fw-semibold">Cari</button>
                    </div>
                    <?php if (isset($_GET['search']) && $_GET['search'] !== '') : ?>
                        <div class="col-auto">
                            <a href="index.php?action=index" class="btn btn-secondary px-3 fw-semibold">Reset</a>
                        </div>
                    <?php endif; ?>
                </div>
            </form>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 50px;">No</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Program Studi</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (!empty($mahasiswa)) :
                            foreach ($mahasiswa as $row) : 
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nim']); ?></td>
                                <td class="text-start"><?= htmlspecialchars($row['nama']); ?></td>
                                <td class="text-start"><?= htmlspecialchars($row['email']); ?></td>
                                <td>
                                    <span class="badge bg-info text-dark px-2 py-1 fs-6 fw-normal">
                                        <?= htmlspecialchars($row['nama_prodi'] ?? 'Tanpa Prodi'); ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($row['angkatan']); ?></td>
                                <td>
                                    <?php if (strtolower($row['status']) == 'aktif') : ?>
                                        <span class="badge bg-success px-2 py-1">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary px-2 py-1"><?= ucfirst($row['status']); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="index.php?action=edit&id=<?= $row['id']; ?>" class="btn btn-warning btn-sm text-white fw-bold me-1">Edit</a>
                                    <a href="index.php?action=delete&id=<?= $row['id']; ?>" class="btn btn-danger btn-sm fw-bold" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php 
                            endforeach; 
                        else : 
                        ?>
                            <tr>
                                <td colspan="8" class="py-4 text-muted">Data mahasiswa tidak ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>