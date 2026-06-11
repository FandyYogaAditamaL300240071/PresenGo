<?php

session_start();

require_once '../config/koneksi.php';

// AMBIL DATA FORM

$username = trim(
    $_POST['username'] ?? ''
);

$password = trim(
    $_POST['password'] ?? ''
);

// CEK INPUT

if (
    empty($username) ||
    empty($password)
)
{
    header(
        "Location: ../index.php?error=1"
    );

    exit;
}

// CARI USER

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM users
     WHERE username = '$username'
     LIMIT 1"
);

// CEK USER

if (
    mysqli_num_rows($query) === 0
)
{
    header(
        "Location: ../index.php?error=1"
    );

    exit;
}

// AMBIL DATA USER

$user = mysqli_fetch_assoc($query);

// CEK PASSWORD

if (
    $password !== $user['password']
)
{
    header(
        "Location: ../index.php?error=1"
    );

    exit;
}

// BUAT SESSION

$_SESSION['id_user']
    = $user['id_user'];

$_SESSION['username']
    = $user['username'];

$_SESSION['role']
    = $user['role'];

$_SESSION['id_karyawan']
    = $user['id_karyawan'];

// REDIRECT SESUAI ROLE

switch ($user['role'])
{
    case 'admin':

        header(
            "Location: ../admin/dashboard.php"
        );

        break;

    case 'kepala_divisi':

        header(
            "Location: ../divisi/dashboard.php"
        );

        break;

    case 'karyawan':

        header(
            "Location: ../karyawan/dashboard.php"
        );

        break;

    default:

        session_destroy();

        header(
            "Location: ../index.php?error=1"
        );

        break;
}

exit;

?>