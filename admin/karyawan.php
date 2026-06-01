<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil ID Divisi
$id_divisi = $_GET['id_divisi'] ?? 0;

// Mengambil Data Divisi
$queryDivisi = mysqli_query(
    $koneksi,
    "SELECT * FROM divisi
     WHERE id_divisi = '$id_divisi'"
);
$divisi = mysqli_fetch_assoc($queryDivisi);

// Jika Divisi Tidak Ditemukan
if(!$divisi)
{
    header("Location: divisi.php");
    exit;
}

// Mengambil Data Karyawan
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM karyawan
     WHERE id_divisi = '$id_divisi'
     ORDER BY nama_karyawan ASC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan - PresenGo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
<div class="container">

    <!-- Tombol Back -->
    <a
        href="divisi.php"
        class="btn btn-secondary back-btn"
    >
        ← Back
    </a>
    <div class="card">
        <div class="card-header">
            Data Karyawan Divisi <?= $divisi['nama_divisi']; ?>
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
                href="karyawan_tambah.php?id_divisi=<?= $id_divisi; ?>"
                class="btn btn-primary mb-3"
            >
                + Tambah Karyawan
            </a>

            <!-- Tabel Karyawan -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Karyawan</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Jabatan</th>
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
                                <?= $data['alamat']; ?>
                            </td>
                            <td>
                                <?= $data['no_hp']; ?>
                            </td>
                            <td>
                                <?= $data['jabatan']; ?>
                            </td>
                            <td class="text-center">

                                <!-- Edit -->
                                <a
                                    href="karyawan_edit.php?id=<?= $data['id_karyawan']; ?>"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <!-- Hapus -->
                                <a
                                    href="karyawan_hapus.php?id=<?= $data['id_karyawan']; ?>"
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