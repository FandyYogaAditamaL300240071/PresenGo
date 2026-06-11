<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// CEK ID

if (!isset($_GET['id']))
{
    header(
        "Location: ../admin/karyawan/index.php"
    );

    exit;
}

$id_karyawan = (int) $_GET['id'];

// CEK DATA KARYAWAN

$cek_karyawan = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_karyawan = $id_karyawan"
);

if (mysqli_num_rows($cek_karyawan) == 0)
{
    header(
        "Location: ../admin/karyawan/index.php"
    );

    exit;
}

// CEK AKUN TERKAIT

$cek_akun = mysqli_query(
    $koneksi,
    "SELECT *
     FROM users
     WHERE id_karyawan = $id_karyawan"
);

if (mysqli_num_rows($cek_akun) > 0)
{
    header(
        "Location: ../admin/karyawan/index.php?error=akun"
    );

    exit;
}

// CEK PRESENSI TERKAIT

$cek_presensi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM presensi
     WHERE id_karyawan = $id_karyawan"
);

if (mysqli_num_rows($cek_presensi) > 0)
{
    header(
        "Location: ../admin/karyawan/index.php?error=presensi"
    );

    exit;
}

// HAPUS DATA

mysqli_query(
    $koneksi,
    "DELETE FROM karyawan
     WHERE id_karyawan = $id_karyawan"
);

// KEMBALI KE DATA KARYAWAN

header(
    "Location: ../admin/karyawan/index.php?success=hapus"
);

exit;

?>