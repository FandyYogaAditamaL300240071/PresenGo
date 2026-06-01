<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil Data Divisi
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM divisi
     ORDER BY nama_divisi ASC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Divisi - PresenGo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">

    <!-- Tombol Back -->
    <a href="dashboard.php" class="btn btn-secondary back-btn">
        ← Back
    </a>
    <div class="card">
        <div class="card-header">
            Data Divisi
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
                href="divisi_tambah.php"
                class="btn btn-primary mb-3"
            >
                + Tambah Divisi
            </a>

            <!-- Tabel Divisi -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Divisi</th>
                            <th>Keterangan</th>
                            <th width="25%">Aksi</th>
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
                                <?= $data['nama_divisi']; ?>
                            </td>
                            <td>
                                <?= $data['keterangan']; ?>
                            </td>
                            <td class="text-center">

                                <!-- Data Karyawan -->
                                <a
                                    href="karyawan.php?id_divisi=<?= $data['id_divisi']; ?>"
                                    class="btn btn-success btn-sm"
                                >
                                    Karyawan
                                </a>

                                <!-- Edit -->
                                <a
                                    href="divisi_edit.php?id=<?= $data['id_divisi']; ?>"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <!-- Hapus -->
                                <a
                                    href="divisi_hapus.php?id=<?= $data['id_divisi']; ?>"
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