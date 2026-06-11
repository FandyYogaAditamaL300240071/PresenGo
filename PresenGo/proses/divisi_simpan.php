<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// AMBIL DATA FORM

$nama_divisi = trim(
    $_POST['nama_divisi'] ?? ''
);

$deskripsi = trim(
    $_POST['deskripsi'] ?? ''
);

// CEK INPUT

if (empty($nama_divisi))
{
    header(
        "Location: ../admin/divisi/tambah.php"
    );

    exit;
}

// CEK DUPLIKAT DIVISI

$cek = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     WHERE nama_divisi = '$nama_divisi'"
);

if (mysqli_num_rows($cek) > 0)
{
    header(
        "Location: ../admin/divisi/tambah.php?error=duplikat"
    );

    exit;
}

// SIMPAN DATA

mysqli_query(
    $koneksi,
    "INSERT INTO divisi
    (
        nama_divisi,
        deskripsi
    )
    VALUES
    (
        '$nama_divisi',
        '$deskripsi'
    )"
);

// KEMBALI KE HALAMAN DIVISI

header(
    "Location: ../admin/divisi/index.php?success=tambah"
);

exit;

?>
