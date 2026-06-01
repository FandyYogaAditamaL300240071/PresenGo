<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Karyawan
cekKaryawan();

// Mengambil Data Karyawan Login
$id_karyawan = $_SESSION['id_karyawan'];

// Proses Input Presensi
if(isset($_POST['simpan']))
{
    $status = mysqli_real_escape_string(
        $koneksi,
        $_POST['status']
    );

    // Simpan Presensi
    $simpan = mysqli_query(
        $koneksi,
        "INSERT INTO presensi
        (
            id_karyawan,
            status
        )
        VALUES
        (
            '$id_karyawan',
            '$status'
        )"
    );
    if($simpan)
    {
        header(
            "Location: input_presensi.php?pesan=berhasil"
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
    <title>Input Presensi - PresenGo</title>

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
            Input Presensi
        </div>
        <div class="card-body">

            <!-- Notifikasi -->
            <?php if(isset($_GET['pesan'])) : ?>
                <?php if($_GET['pesan'] == 'berhasil') : ?>
                    <div class="alert alert-success">
                        Presensi Terkirim
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Form Presensi -->
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
                        <option value="">
                            -- Pilih Status --
                        </option>
                        <option value="Hadir">
                            Hadir
                        </option>
                        <option value="Izin">
                            Izin
                        </option>
                        <option value="Sakit">
                            Sakit
                        </option>
                        <option value="Alpha">
                            Alpha
                        </option>
                    </select>
                </div>

                <!-- Tombol Kirim -->
                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary"
                >
                    Kirim Presensi
                </button>
                <a
                    href="dashboard.php"
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