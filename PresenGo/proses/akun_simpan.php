<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// AMBIL DATA FORM

$id_karyawan = (int) (
    $_POST['id_karyawan'] ?? 0
);

$username = trim(
    $_POST['username'] ?? ''
);

$password = trim(
    $_POST['password'] ?? ''
);

$role = trim(
    $_POST['role'] ?? ''
);

// CEK INPUT

if (
    $id_karyawan <= 0 ||
    empty($username) ||
    empty($password) ||
    empty($role)
)
{
    header(
        "Location: ../admin/akun/tambah.php?error=input"
    );

    exit;
}

// CEK KARYAWAN

$cek_karyawan = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_karyawan = $id_karyawan"
);

if (mysqli_num_rows($cek_karyawan) == 0)
{
    header(
        "Location: ../admin/akun/tambah.php?error=karyawan"
    );

    exit;
}

$data_karyawan = mysqli_fetch_assoc(
    $cek_karyawan
);

// CEK USERNAME DUPLIKAT

$cek_username = mysqli_query(
    $koneksi,
    "SELECT *
     FROM users
     WHERE username = '$username'"
);

if (mysqli_num_rows($cek_username) > 0)
{
    header(
        "Location: ../admin/akun/tambah.php?error=username"
    );

    exit;
}

// CEK KARYAWAN SUDAH PUNYA AKUN

$cek_akun = mysqli_query(
    $koneksi,
    "SELECT *
     FROM users
     WHERE id_karyawan = $id_karyawan"
);

if (mysqli_num_rows($cek_akun) > 0)
{
    header(
        "Location: ../admin/akun/tambah.php?error=akun"
    );

    exit;
}

// CEK KEPALA DIVISI

if ($role == 'kepala_divisi')
{
    $id_divisi =
        $data_karyawan['id_divisi'];

    $cek_kepala = mysqli_query(
        $koneksi,
        "SELECT u.*
         FROM users u
         JOIN karyawan k
            ON u.id_karyawan = k.id_karyawan
         WHERE u.role = 'kepala_divisi'
         AND k.id_divisi = $id_divisi"
    );

    if (mysqli_num_rows($cek_kepala) > 0)
    {
        header(
            "Location: ../admin/akun/tambah.php?error=kepala_divisi"
        );

        exit;
    }
}

// SIMPAN AKUN

mysqli_query(
    $koneksi,
    "INSERT INTO users
    (
        id_karyawan,
        username,
        password,
        role
    )
    VALUES
    (
        '$id_karyawan',
        '$username',
        '$password',
        '$role'
    )"
);

// KEMBALI KE DATA AKUN

header(
    "Location: ../admin/akun/index.php?success=tambah"
);

exit;

?>