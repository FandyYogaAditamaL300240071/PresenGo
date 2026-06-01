<?php

// Konfigurasi Database
$host     = "localhost";
$username = "root";
$password = "";
$database = "presengo";

// Membuat Koneksi
$koneksi = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

// Cek Koneksi
if (!$koneksi) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}
?>