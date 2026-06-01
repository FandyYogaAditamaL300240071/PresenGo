<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil ID Divisi
$id = $_GET['id'] ?? 0;

// Cek Data Divisi
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

// Hapus Data Divisi
$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM divisi
     WHERE id_divisi = '$id'"
);

// Redirect
if($hapus)
{
    header("Location: divisi.php?pesan=hapus");
    exit;
}
else
{
    header("Location: divisi.php");
    exit;
}

?>