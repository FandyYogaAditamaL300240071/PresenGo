<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Kepala Divisi
cekDivisi();

// Mengambil Data Kepala Divisi
$id_karyawan = $_SESSION['id_karyawan'];
$query = mysqli_query(
    $koneksi,
    "SELECT
        karyawan.*,
        divisi.nama_divisi
     FROM karyawan
     JOIN divisi
        ON karyawan.id_divisi = divisi.id_divisi
     WHERE karyawan.id_karyawan = '$id_karyawan'"
);
$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Divisi - PresenGo</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- CSS -->
    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >
</head>
<body>
<div class="container">
    <div class="dashboard-box">
        <div class="card">

            <!-- Header -->
            <div class="card-header text-center">
                Dashboard Kepala Divisi
            </div>
            <div class="card-body">

                <!-- Judul -->
                <h4 class="page-title">
                    Anda Login Sebagai Kepala Divisi
                    <?= $data['nama_divisi']; ?>
                </h4>
                <h6 class="text-center mb-4">
                    Tampilan Menu
                </h6>

                <!-- Data Karyawan Divisi -->
                <a
                    href="karyawan.php"
                    class="btn btn-primary menu-btn"
                >
                    Data Karyawan Divisi
                </a>

                <!-- Data Presensi Divisi -->
                <a
                    href="presensi.php"
                    class="btn btn-success menu-btn"
                >
                    Data Presensi Divisi
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