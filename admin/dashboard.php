<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PresenGo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="dashboard-box">
            <div class="card">

                <!-- Header -->
                <div class="card-header text-center">
                    Dashboard Admin
                </div>
                <div class="card-body">

                    <!-- Judul -->
                    <h4 class="page-title">
                        Anda Login Sebagai Admin
                    </h4>
                    <h6 class="text-center mb-4">
                        Tampilan Menu
                    </h6>

                    <!-- Data Divisi -->
                    <a
                        href="divisi.php"
                        class="btn btn-primary menu-btn"
                    >
                        Data Divisi
                    </a>

                    <!-- Data Akun -->
                    <a
                        href="user.php"
                        class="btn btn-light menu-btn"
                    >
                        Data Akun
                    </a>

                    <!-- Data Presensi -->
                    <a
                        href="presensi.php"
                        class="btn btn-success menu-btn"
                    >
                        Data Presensi
                    </a>

                    <!-- Logout -->
                    <a
                        href="../proses/logout.php"
                        class="btn btn-danger menu-btn"
                        onclick="return confirm('Anda yakin ingin keluar?')"
                    >
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>