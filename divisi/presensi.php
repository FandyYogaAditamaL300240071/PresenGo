<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Kepala Divisi
cekDivisi();

// Mengambil Data Kepala Divisi
$id_karyawan = $_SESSION['id_karyawan'];
$queryDivisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_karyawan = '$id_karyawan'"
);
$kepalaDivisi = mysqli_fetch_assoc($queryDivisi);
$id_divisi = $kepalaDivisi['id_divisi'];

// Mengambil Nama Divisi
$queryNamaDivisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     WHERE id_divisi = '$id_divisi'"
);
$divisi = mysqli_fetch_assoc($queryNamaDivisi);

// Mengambil Data Presensi Divisi
$query = mysqli_query(
    $koneksi,
    "SELECT
        presensi.*,
        karyawan.nama_karyawan
     FROM presensi
     JOIN karyawan
        ON presensi.id_karyawan = karyawan.id_karyawan
     WHERE karyawan.id_divisi = '$id_divisi'
     ORDER BY presensi.waktu_presensi DESC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Presensi Divisi - PresenGo</title>

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
            Data Presensi Divisi <?= $divisi['nama_divisi']; ?>
        </div>
        <div class="card-body">

            <!-- Notifikasi -->
            <?php if(isset($_GET['pesan'])) : ?>
                <?php if($_GET['pesan'] == 'tambah') : ?>
                    <div class="alert alert-success">
                        Data berhasil ditambahkan.
                    </div>
                <?php endif; ?>
                <?php if($_GET['pesan'] == 'edit') : ?>
                    <div class="alert alert-warning">
                        Data berhasil diubah.
                    </div>
                <?php endif; ?>
                <?php if($_GET['pesan'] == 'hapus') : ?>
                    <div class="alert alert-danger">
                        Data berhasil dihapus.
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Tombol Tambah -->
            <a
                href="presensi_tambah.php"
                class="btn btn-primary mb-3"
            >
                + Tambah Presensi
            </a>

            <!-- Tabel Presensi -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Karyawan</th>
                            <th>Status</th>
                            <th>Waktu Presensi</th>
                            <th width="20%">Aksi</th>
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
                            <td class="text-center">

                                <!-- Edit -->
                                <a
                                    href="presensi_edit.php?id=<?= $data['id_presensi']; ?>"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <!-- Hapus -->
                                <a
                                    href="presensi_hapus.php?id=<?= $data['id_presensi']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                >
                                    Hapus
                                </a>
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