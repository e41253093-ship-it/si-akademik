<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SI Akademik</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow border-0 p-4" style="width: 100%; max-width: 400px; border-radius: 12px;">
        <div class="card-body">
            <h3 class="card-title text-center fw-bold mb-4">Login System</h3>

            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger py-2" role="alert">
                    <small><?= $_SESSION['error']; unset($_SESSION['error']); ?></small>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label text-secondary fw-semibold">Username</label>
                    <input type="text" name="username" class="form-control form-control-lg fs-6" placeholder="Masukkan username" required autofocus>
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg fs-6" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold fs-6">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>