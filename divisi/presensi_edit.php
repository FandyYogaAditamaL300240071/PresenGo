<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Kepala Divisi
cekDivisi();

// Mengambil ID Presensi
$id = $_GET['id'] ?? 0;

// Mengambil Data Presensi
$query = mysqli_query(
    $koneksi,
    "SELECT
        presensi.*,
        karyawan.id_divisi
     FROM presensi
     JOIN karyawan
        ON presensi.id_karyawan = karyawan.id_karyawan
     WHERE presensi.id_presensi = '$id'"
);
$data = mysqli_fetch_assoc($query);

// Jika Data Tidak Ditemukan
if(!$data)
{
    header("Location: presensi.php");
    exit;
}

// Mengambil Divisi Kepala Divisi
$id_karyawan_login = $_SESSION['id_karyawan'];
$queryLogin = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_karyawan = '$id_karyawan_login'"
);
$login = mysqli_fetch_assoc($queryLogin);

// Cek Kepemilikan Divisi
if($data['id_divisi'] != $login['id_divisi'])
{
    header("Location: presensi.php");
    exit;
}

// Proses Update
if(isset($_POST['update']))
{
    $status = mysqli_real_escape_string(
        $koneksi,
        $_POST['status']
    );
    $update = mysqli_query(
        $koneksi,
        "UPDATE presensi
         SET status = '$status'
         WHERE id_presensi = '$id'"
    );
    if($update)
    {
        header("Location: presensi.php?pesan=edit");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Presensi - PresenGo</title>

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
        href="presensi.php"
        class="btn btn-secondary back-btn"
    >
        ← Back
    </a>
    <div class="card">
        <div class="card-header">
            Edit Data Presensi
        </div>
        <div class="card-body">

            <!-- Form Edit -->
            <form method="POST">

                <!-- Status Presensi -->
                <div class="mb-3">
                    <label class="form-label">
                        Status Presensi
                    </label>
                    <select
                        name="status"
                        class="form-select"
                        required
                    >
                        <option
                            value="Hadir"
                            <?= ($data['status'] == 'Hadir') ? 'selected' : ''; ?>
                        >
                            Hadir
                        </option>
                        <option
                            value="Izin"
                            <?= ($data['status'] == 'Izin') ? 'selected' : ''; ?>
                        >
                            Izin
                        </option>
                        <option
                            value="Sakit"
                            <?= ($data['status'] == 'Sakit') ? 'selected' : ''; ?>
                        >
                            Sakit
                        </option>
                        <option
                            value="Alpha"
                            <?= ($data['status'] == 'Alpha') ? 'selected' : ''; ?>
                        >
                            Alpha
                        </option>
                    </select>
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
                    href="presensi.php"
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