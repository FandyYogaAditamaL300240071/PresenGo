<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// AMBIL DATA FORM

$id_divisi = (int) (
    $_POST['id_divisi'] ?? 0
);

$nama_divisi = trim(
    $_POST['nama_divisi'] ?? ''
);

$deskripsi = trim(
    $_POST['deskripsi'] ?? ''
);

// CEK INPUT

if (
    $id_divisi <= 0 ||
    empty($nama_divisi)
)
{
    header(
        "Location: ../admin/divisi/index.php"
    );

    exit;
}

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

// CEK DUPLIKAT NAMA DIVISI

$cek_nama = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     WHERE nama_divisi = '$nama_divisi'
     AND id_divisi != $id_divisi"
);

if (mysqli_num_rows($cek_nama) > 0)
{
    header(
        "Location: ../admin/divisi/edit.php?id=$id_divisi&error=duplikat"
    );

    exit;
}

// UPDATE DATA

mysqli_query(
    $koneksi,
    "UPDATE divisi
     SET
        nama_divisi = '$nama_divisi',
        deskripsi = '$deskripsi'
     WHERE id_divisi = $id_divisi"
);

// KEMBALI KE HALAMAN DIVISI

header(
    "Location: ../admin/divisi/index.php?success=update"
);

exit;

?>
