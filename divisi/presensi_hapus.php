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

// Mengambil Data Kepala Divisi
$id_karyawan = $_SESSION['id_karyawan'];
$queryLogin = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_karyawan = '$id_karyawan'"
);
$login = mysqli_fetch_assoc($queryLogin);

// Cek Kepemilikan Divisi
if($data['id_divisi'] != $login['id_divisi'])
{
    header("Location: presensi.php");
    exit;
}

// Hapus Data Presensi
$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM presensi
     WHERE id_presensi = '$id'"
);

// Redirect
if($hapus)
{
    header("Location: presensi.php?pesan=hapus");
    exit;
}
else
{
    header("Location: presensi.php");
    exit;
}

?>