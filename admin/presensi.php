<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil Data Presensi
$query = mysqli_query(
    $koneksi,
    "SELECT
        presensi.*,
        karyawan.nama_karyawan,
        divisi.nama_divisi
     FROM presensi
     JOIN karyawan
        ON presensi.id_karyawan = karyawan.id_karyawan
     JOIN divisi
        ON karyawan.id_divisi = divisi.id_divisi
     ORDER BY presensi.waktu_presensi DESC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Presensi - PresenGo</title>

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

    <!-- Tombol Back -->
    <a
        href="dashboard.php"
        class="btn btn-secondary back-btn"
    >
        ← Back
    </a>
    <div class="card">
        <div class="card-header">
            Data Presensi
        </div>
        <div class="card-body">
            <!-- Tabel Presensi -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Karyawan</th>
                            <th>Divisi</th>
                            <th>Status</th>
                            <th>Waktu Presensi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $no = 1;
                        while($data = mysqli_fetch_assoc($query)) :
                        ?>

                        <tr>
                            <td class="text-center">
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $data['nama_karyawan']; ?>
                            </td>
                            <td>
                                <?= $data['nama_divisi']; ?>
                            </td>
                            <td>
                                <?php if($data['status'] == 'Hadir') : ?>
                                    <span class="badge bg-success">
                                        Hadir
                                    </span>
                                <?php elseif($data['status'] == 'Izin') : ?>
                                    <span class="badge bg-warning text-dark">
                                        Izin
                                    </span>
                                <?php elseif($data['status'] == 'Sakit') : ?>
                                    <span class="badge bg-info">
                                        Sakit
                                    </span>
                                <?php else : ?>
                                    <span class="badge bg-danger">
                                        Alpha
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= $data['waktu_presensi']; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>