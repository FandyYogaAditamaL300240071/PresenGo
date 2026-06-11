<?php

date_default_timezone_set('Asia/Jakarta');

// KONFIGURASI DATABASE

$host = "localhost";
$user = "root";
$pass = "";
$db   = "presengo";

// MEMBUAT KONEKSI

$koneksi = mysqli_connect(
    $host,
    $user,
    $pass,
    $db
);

// CEK KONEKSI

if (!$koneksi)
{
    die(
        "Koneksi database gagal: "
        . mysqli_connect_error()
    );
}

// SET UTF-8

mysqli_set_charset(
    $koneksi,
    "utf8mb4"
);

?>
