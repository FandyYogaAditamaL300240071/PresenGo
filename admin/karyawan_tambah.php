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

// Proses Tambah Data
if(isset($_POST['simpan']))
{
    $nama_karyawan = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_karyawan']
    );
    $alamat = mysqli_real_escape_string(
        $koneksi,
        $_POST['alamat']
    );
    $no_hp = mysqli_real_escape_string(
        $koneksi,
        $_POST['no_hp']
    );
    $jabatan = mysqli_real_escape_string(
        $koneksi,
        $_POST['jabatan']
    );
    $simpan = mysqli_query(
        $koneksi,
        "INSERT INTO karyawan
        (
            id_divisi,
            nama_karyawan,
            alamat,
            no_hp,
            jabatan
        )
        VALUES
        (
            '$id_divisi',
            '$nama_karyawan',
            '$alamat',
            '$no_hp',
            '$jabatan'
        )"
    );
    if($simpan)
    {
        header(
            "Location: karyawan.php?id_divisi=$id_divisi&pesan=tambah"
        );
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan - PresenGo</title>

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
        href="karyawan.php?id_divisi=<?= $id_divisi; ?>"
        class="btn btn-secondary back-btn"
    >
        ← Back
    </a>
    <div class="card">
        <div class="card-header">
            Tambah Data Karyawan
        </div>
        <div class="card-body">

            <!-- Informasi Divisi -->
            <div class="alert alert-info">
                Divisi :
                <strong>
                    <?= $divisi['nama_divisi']; ?>
                </strong>
            </div>

            <!-- Form Tambah Karyawan -->
            <form method="POST">

                <!-- Nama Karyawan -->
                <div class="mb-3">
                    <label class="form-label">
                        Nama Karyawan
                    </label>
                    <input
                        type="text"
                        name="nama_karyawan"
                        class="form-control"
                        required
                    >
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label class="form-label">
                        Alamat
                    </label>
                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="3"
                        required
                    ></textarea>
                </div>

                <!-- Nomor HP -->
                <div class="mb-3">
                    <label class="form-label">
                        Nomor HP
                    </label>
                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        required
                    >
                </div>

                <!-- Jabatan -->
                <div class="mb-3">
                    <label class="form-label">
                        Jabatan
                    </label>
                    <input
                        type="text"
                        name="jabatan"
                        class="form-control"
                        required
                    >
                </div>

                <!-- Tombol Simpan -->
                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary"
                >
                    Simpan
                </button>
                <a
                    href="karyawan.php?id_divisi=<?= $id_divisi; ?>"
                    class="btn btn-danger"
                >
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>
</body>
</html>