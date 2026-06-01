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

// Mengambil Data Karyawan Divisi
$karyawan = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_divisi = '$id_divisi'
     ORDER BY nama_karyawan ASC"
);

// Proses Tambah Presensi
if(isset($_POST['simpan']))
{
    $id_karyawan_presensi = $_POST['id_karyawan'];
    $status = $_POST['status'];
    $simpan = mysqli_query(
        $koneksi,
        "INSERT INTO presensi
        (
            id_karyawan,
            status
        )
        VALUES
        (
            '$id_karyawan_presensi',
            '$status'
        )"
    );
    if($simpan)
    {
        header("Location: presensi.php?pesan=tambah");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Presensi - PresenGo</title>

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
            Tambah Data Presensi
        </div>
        <div class="card-body">

            <!-- Form Tambah Presensi -->
            <form method="POST">

                <!-- Karyawan -->
                <div class="mb-3">
                    <label class="form-label">
                        Karyawan
                    </label>
                    <select
                        name="id_karyawan"
                        class="form-select"
                        required
                    >
                        <option value="">
                            -- Pilih Karyawan --
                        </option>
                        <?php while($data = mysqli_fetch_assoc($karyawan)) : ?>
                            <option value="<?= $data['id_karyawan']; ?>">
                                <?= $data['nama_karyawan']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Status -->
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

                <!-- Tombol Simpan -->
                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary"
                >
                    Simpan
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