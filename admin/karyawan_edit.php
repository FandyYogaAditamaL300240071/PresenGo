<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil ID Karyawan
$id = $_GET['id'] ?? 0;

// Mengambil Data Karyawan
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM karyawan
     WHERE id_karyawan = '$id'"
);
$data = mysqli_fetch_assoc($query);

// Jika Data Tidak Ditemukan
if(!$data)
{
    header("Location: divisi.php");
    exit;
}

// Menyimpan ID Divisi
$id_divisi = $data['id_divisi'];

// Proses Edit Data
if(isset($_POST['update']))
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
    $update = mysqli_query(
        $koneksi,
        "UPDATE karyawan
         SET
            nama_karyawan = '$nama_karyawan',
            alamat = '$alamat',
            no_hp = '$no_hp',
            jabatan = '$jabatan'
         WHERE id_karyawan = '$id'"
    );
    if($update)
    {
        header(
            "Location: karyawan.php?id_divisi=$id_divisi&pesan=edit"
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
    <title>Edit Karyawan - PresenGo</title>

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
            Edit Data Karyawan
        </div>
        <div class="card-body">

            <!-- Form Edit Karyawan -->
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
                        value="<?= $data['nama_karyawan']; ?>"
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
                    ><?= $data['alamat']; ?></textarea>
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
                        value="<?= $data['no_hp']; ?>"
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
                        value="<?= $data['jabatan']; ?>"
                        required
                    >
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