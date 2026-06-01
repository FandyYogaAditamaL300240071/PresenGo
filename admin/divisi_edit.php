<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil ID Divisi
$id = $_GET['id'] ?? 0;

// Mengambil Data Divisi
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM divisi
     WHERE id_divisi = '$id'"
);

$data = mysqli_fetch_assoc($query);
// Jika Data Tidak Ditemukan

if(!$data)
{
    header("Location: divisi.php");
    exit;
}

// Proses Edit Data
if(isset($_POST['update']))
{
    $nama_divisi = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_divisi']
    );
    $keterangan = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan']
    );
    $update = mysqli_query(
        $koneksi,
        "UPDATE divisi
         SET
            nama_divisi = '$nama_divisi',
            keterangan = '$keterangan'
         WHERE id_divisi = '$id'"
    );
    if($update)
    {
        header("Location: divisi.php?pesan=edit");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Divisi - PresenGo</title>

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
            Edit Data Divisi
        </div>
        <div class="card-body">

            <!-- Form Edit Divisi -->
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
                        value="<?= $data['nama_divisi']; ?>"
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
                    ><?= $data['keterangan']; ?></textarea>
                </div>

                <!-- Tombol Update -->
                <button
                    type="submit"
                    name="update"
                    class="btn btn-warning"
                >
                    Update
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