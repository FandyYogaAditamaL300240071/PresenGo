<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekLogin();

// AMBIL DATA FORM

$status = trim(
    $_POST['status'] ?? ''
);

$keterangan = trim(
    $_POST['keterangan'] ?? ''
);

// VALIDASI STATUS

$status_valid = [
    'Hadir',
    'Izin',
    'Sakit',
    'Alpha'
];

if (!in_array($status, $status_valid))
{
    $error = 'status';
}
else
{
    $error = '';
}

if ($_SESSION['role'] === 'karyawan')
{
    $id_karyawan = (int) $_SESSION['id_karyawan'];
    $tanggal = date('Y-m-d');
    $jam_masuk = date('H:i:s');
    $redirect_form = '../karyawan/presensi/input.php';
    $redirect_success = '../karyawan/presensi/riwayat.php?success=tambah';
}
elseif ($_SESSION['role'] === 'kepala_divisi')
{
    $id_karyawan = (int) ($_POST['id_karyawan'] ?? 0);
    $tanggal = trim($_POST['tanggal'] ?? '');
    $jam_masuk = trim($_POST['jam_masuk'] ?? '');
    $redirect_form = '../divisi/presensi/tambah.php';
    $redirect_success = '../divisi/presensi/index.php?success=tambah';

    $id_login = (int) $_SESSION['id_karyawan'];
    $user = mysqli_query(
        $koneksi,
        "SELECT id_divisi
         FROM karyawan
         WHERE id_karyawan = $id_login"
    );
    $data_user = mysqli_fetch_assoc($user);
    $id_divisi = (int) ($data_user['id_divisi'] ?? 0);

    $karyawan = mysqli_query(
        $koneksi,
        "SELECT id_karyawan
         FROM karyawan
         WHERE id_karyawan = $id_karyawan
         AND id_divisi = $id_divisi"
    );

    if (mysqli_num_rows($karyawan) === 0)
    {
        header("Location: $redirect_form?error=karyawan");
        exit;
    }
}
else
{
    header('Location: ../index.php');
    exit;
}

if (
    $id_karyawan <= 0 ||
    empty($tanggal) ||
    empty($jam_masuk) ||
    empty($status)
)
{
    $error = 'input';
}

if ($error !== '')
{
    header("Location: $redirect_form?error=$error");
    exit;
}

// CEK PRESENSI GANDA

$cek_presensi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM presensi
     WHERE id_karyawan = $id_karyawan
     AND tanggal = '$tanggal'"
);

if (mysqli_num_rows($cek_presensi) > 0)
{
    header("Location: $redirect_form?error=duplikat");
    exit;
}

// SIMPAN DATA

$keterangan = mysqli_real_escape_string(
    $koneksi,
    $keterangan
);

mysqli_query(
    $koneksi,
    "INSERT INTO presensi
    (
        id_karyawan,
        tanggal,
        jam_masuk,
        status,
        keterangan
    )
    VALUES
    (
        '$id_karyawan',
        '$tanggal',
        '$jam_masuk',
        '$status',
        '$keterangan'
    )"
);

// KEMBALI KE DATA PRESENSI

header("Location: $redirect_success");

exit;

?>
