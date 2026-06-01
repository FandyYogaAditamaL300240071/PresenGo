<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Proses Tambah Data
if(isset($_POST['simpan']))
{
    $nama_divisi = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_divisi']
    );
    $keterangan = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan']
    );
    $simpan = mysqli_query(
        $koneksi,
        "INSERT INTO divisi
        (
            nama_divisi,
            keterangan
        )
        VALUES
        (
            '$nama_divisi',
            '$keterangan'
        )"
    );
    if($simpan)
    {
        header("Location: divisi.php?pesan=tambah");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Divisi - PresenGo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
<div class="container">

    <!-- Tombol Back -->
    <a href="divisi.php" class="btn btn-secondary back-btn">
        ← Back
    </a>
    <div class="card">
        <div class="card-header">
            Tambah Data Divisi
        </div>
        <div class="card-body">

            <!-- Form Tambah Divisi -->
            <form method="POST">

                <!-- Nama Divisi -->
                <div class="mb-3">
                    <label class="form-label">
                        Nama Divisi
                    </label>
                    <input
                        type="text"
                        name="nama_divisi"
                        class="form-control"
                        required
                    >
                </div>

                <!-- Keterangan -->
                <div class="mb-3">
                    <label class="form-label">
                        Keterangan
                    </label>
                    <textarea
                        name="keterangan"
                        class="form-control"
                        rows="4"
                        required
                    ></textarea>
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
                    href="divisi.php"
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