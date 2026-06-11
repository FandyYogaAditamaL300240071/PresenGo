<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekDivisi();

// AMBIL DATA FORM

$id_presensi = (int) (
    $_POST['id_presensi'] ?? 0
);

$tanggal = trim(
    $_POST['tanggal'] ?? ''
);

$jam_masuk = trim(
    $_POST['jam_masuk'] ?? ''
);

$status = trim(
    $_POST['status'] ?? ''
);

$keterangan = trim(
    $_POST['keterangan'] ?? ''
);

// CEK INPUT

if (
    $id_presensi <= 0 ||
    empty($tanggal) ||
    empty($jam_masuk) ||
    empty($status)
)
{
    header(
        "Location: ../divisi/presensi/index.php"
    );

    exit;
}

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

$data_presensi =
mysqli_fetch_assoc($query);

// VALIDASI STATUS

$status_valid = [
    'Hadir',
    'Izin',
    'Sakit',
    'Alpha'
];

if (!in_array($status, $status_valid))
{
    header(
        "Location: ../divisi/presensi/edit.php?id=$id_presensi&error=status"
    );

    exit;
}

// CEK DUPLIKAT TANGGAL

$cek_duplikat = mysqli_query(
    $koneksi,
    "SELECT *
     FROM presensi
     WHERE id_karyawan = {$data_presensi['id_karyawan']}
     AND tanggal = '$tanggal'
     AND id_presensi != $id_presensi"
);

if (mysqli_num_rows($cek_duplikat) > 0)
{
    header(
        "Location: ../divisi/presensi/edit.php?id=$id_presensi&error=duplikat"
    );

    exit;
}

// UPDATE DATA

mysqli_query(
    $koneksi,
    "UPDATE presensi
     SET
        tanggal = '$tanggal',
        jam_masuk = '$jam_masuk',
        status = '$status',
        keterangan = '$keterangan'
     WHERE id_presensi = $id_presensi"
);

// KEMBALI KE DATA PRESENSI

header(
    "Location: ../divisi/presensi/index.php?success=update"
);

exit;

?>