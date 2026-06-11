<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// CEK ID

if (!isset($_GET['id']))
{
    header(
        "Location: ../admin/divisi/index.php"
    );

    exit;
}

$id_divisi = (int) $_GET['id'];

// CEK DATA DIVISI

$cek_divisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     WHERE id_divisi = $id_divisi"
);

if (mysqli_num_rows($cek_divisi) == 0)
{
    header(
        "Location: ../admin/divisi/index.php"
    );

    exit;
}

// CEK KARYAWAN PADA DIVISI

$cek_karyawan = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_divisi = $id_divisi"
);

if (mysqli_num_rows($cek_karyawan) > 0)
{
    header(
        "Location: ../admin/divisi/index.php?error=digunakan"
    );

    exit;
}

// HAPUS DIVISI

mysqli_query(
    $koneksi,
    "DELETE FROM divisi
     WHERE id_divisi = $id_divisi"
);

// KEMBALI KE HALAMAN DIVISI

header(
    "Location: ../admin/divisi/index.php?success=hapus"
);

exit;

?>