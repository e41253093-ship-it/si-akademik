<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Dashboard Detail Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th width="35%">NIM / ID</th>
                                <td><?= htmlspecialchars($id) ?></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td><?= htmlspecialchars($mahasiswa['nama']) ?></td>
                            </tr>
                            <tr>
                                <th>Program Studi</th>
                                <td><?= htmlspecialchars($mahasiswa['prodi']) ?></td>
                            </tr>
                            <tr>
                                <th>Angkatan</th>
                                <td><?= htmlspecialchars($mahasiswa['angkatan']) ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span class="badge bg-success">Aktif</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <a href="/si-akademik/public/mahasiswa" class="btn btn-secondary">&larr; Kembali ke Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>