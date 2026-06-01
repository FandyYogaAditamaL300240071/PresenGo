<?php
// Memulai Session
session_start();

// Jika Sudah Login
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    }
    if ($_SESSION['role'] == 'divisi') {
        header("Location: divisi/dashboard.php");
        exit;
    }
    if ($_SESSION['role'] == 'karyawan') {
        header("Location: karyawan/dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PresenGo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="card">
                <div class="card-header text-center">
                    Selamat Datang di PresenGo
                </div>
                <div class="card-body">

                    <!-- Notifikasi -->
                    <?php if(isset($_GET['pesan'])) : ?>
                        <?php if($_GET['pesan'] == 'gagal') : ?>
                            <div class="alert alert-danger">
                                Username atau Password Salah
                            </div>
                        <?php endif; ?>
                        <?php if($_GET['pesan'] == 'logout') : ?>
                            <div class="alert alert-success">
                                Berhasil Logout
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Form Login -->
                    <form action="proses/login.php" method="POST">

                        <!-- Username -->
                        <div class="mb-3">
                            <label class="form-label">
                                Username
                            </label>
                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required
                            >
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">
                                Password
                            </label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >
                        </div>

                        <!-- Tombol Login -->
                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>