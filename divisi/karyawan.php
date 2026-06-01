<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Kepala Divisi
cekDivisi();

// Mengambil ID Karyawan Login
$id_karyawan = $_SESSION['id_karyawan'];

// Mengambil Data Kepala Divisi
$queryDivisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_karyawan = '$id_karyawan'"
);
$kepalaDivisi = mysqli_fetch_assoc($queryDivisi);

// ID Divisi Kepala Divisi
$id_divisi = $kepalaDivisi['id_divisi'];

// Mengambil Nama Divisi
$queryNamaDivisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     WHERE id_divisi = '$id_divisi'"
);
$divisi = mysqli_fetch_assoc($queryNamaDivisi);

// Mengambil Data Karyawan Divisi
$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_divisi = '$id_divisi'
     ORDER BY nama_karyawan ASC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan Divisi - PresenGo</title>

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
            Data Karyawan Divisi <?= $divisi['nama_divisi']; ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Karyawan</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Jabatan</th>
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
                                <?= $data['alamat']; ?>
                            </td>
                            <td>
                                <?= $data['no_hp']; ?>
                            </td>
                            <td>
                                <?php if($data['jabatan'] == 'Kepala Divisi') : ?>
                                    <span class="badge bg-warning text-dark">
                                        <?= $data['jabatan']; ?>
                                    </span>
                                <?php else : ?>
                                    <?= $data['jabatan']; ?>
                                <?php endif; ?>
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