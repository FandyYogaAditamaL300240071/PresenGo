<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil Data User
$query = mysqli_query(
    $koneksi,
    "SELECT
        users.*,
        karyawan.nama_karyawan
     FROM users
     LEFT JOIN karyawan
     ON users.id_karyawan = karyawan.id_karyawan
     ORDER BY users.id_user ASC"
);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Akun - PresenGo</title>

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
            Data Akun
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
                href="user_tambah.php"
                class="btn btn-primary mb-3"
            >
                + Tambah Akun
            </a>

            <!-- Tabel User -->
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Username</th>
                            <th>Nama Karyawan</th>
                            <th>Role</th>
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
                                <?= $data['username']; ?>
                            </td>
                            <td>
                                <?= $data['nama_karyawan'] ?? '-'; ?>
                            </td>
                            <td>
                                <?php if($data['role'] == 'admin') : ?>
                                    <span class="badge bg-danger">
                                        Admin
                                    </span>
                                <?php elseif($data['role'] == 'divisi') : ?>
                                    <span class="badge bg-warning text-dark">
                                        Kepala Divisi
                                    </span>
                                <?php else : ?>
                                    <span class="badge bg-success">
                                        Karyawan
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">

                                <!-- Edit -->
                                <a
                                    href="user_edit.php?id=<?= $data['id_user']; ?>"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <!-- Hapus -->
                                <a
                                    href="user_hapus.php?id=<?= $data['id_user']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus akun ini?')"
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