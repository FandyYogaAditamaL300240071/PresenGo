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

// Hapus Data Karyawan
$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM karyawan
     WHERE id_karyawan = '$id'"
);

// Redirect
if($hapus)
{
    header(
        "Location: karyawan.php?id_divisi=$id_divisi&pesan=hapus"
    );
    exit;
}
else
{
    header(
        "Location: karyawan.php?id_divisi=$id_divisi"
    );
    exit;
}

?>