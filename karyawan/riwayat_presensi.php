<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Karyawan
cekKaryawan();

// Mengambil Data Karyawan Login
$id_karyawan = $_SESSION['id_karyawan'];

// Mengambil Riwayat Presensi
$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM presensi
     WHERE id_karyawan = '$id_karyawan'
     ORDER BY waktu_presensi DESC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Presensi - PresenGo</title>

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
            Riwayat Presensi
        </div>
        <div class="card-body">

            <!-- Tabel Riwayat -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
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