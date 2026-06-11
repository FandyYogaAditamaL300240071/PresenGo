<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekDivisi();

// CEK ID

if (!isset($_GET['id']))
{
    header(
        "Location: ../divisi/presensi/index.php"
    );

    exit;
}

$id_presensi = (int)
$_GET['id'];

// AMBIL DATA KEPALA DIVISI

$id_login = (int)
$_SESSION['id_karyawan'];

$user = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_karyawan = $id_login"
);

$data_user =
mysqli_fetch_assoc($user);

$id_divisi =
$data_user['id_divisi'];

// CEK DATA PRESENSI

$query = mysqli_query(
    $koneksi,
    "SELECT
        p.*,
        k.id_divisi
     FROM presensi p
     JOIN karyawan k
        ON p.id_karyawan = k.id_karyawan
     WHERE p.id_presensi = $id_presensi
     AND k.id_divisi = $id_divisi"
);

if (mysqli_num_rows($query) == 0)
{
    header(
        "Location: ../divisi/presensi/index.php"
    );

    exit;
}

// HAPUS DATA

mysqli_query(
    $koneksi,
    "DELETE FROM presensi
     WHERE id_presensi = $id_presensi"
);

// KEMBALI KE DATA PRESENSI

header(
    "Location: ../divisi/presensi/index.php?success=hapus"
);

exit;

?>