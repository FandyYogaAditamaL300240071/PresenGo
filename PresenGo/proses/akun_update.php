<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// AMBIL DATA FORM

$id_user = (int) (
    $_POST['id_user'] ?? 0
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

// CEK INPUT DASAR

if (
    $id_user <= 0 ||
    empty($username)
)
{
    header(
        "Location: ../admin/akun/index.php"
    );

    exit;
}

// CEK USER

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM users
     WHERE id_user = $id_user"
);

if (mysqli_num_rows($query) == 0)
{
    header(
        "Location: ../admin/akun/index.php"
    );

    exit;
}

$user = mysqli_fetch_assoc($query);

// CEK USERNAME DUPLIKAT

$cek_username = mysqli_query(
    $koneksi,
    "SELECT *
     FROM users
     WHERE username = '$username'
     AND id_user != $id_user"
);

if (mysqli_num_rows($cek_username) > 0)
{
    header(
        "Location: ../admin/akun/edit.php?id=$id_user&error=username"
    );

    exit;
}

// VALIDASI KEPALA DIVISI

if (
    $user['role'] != 'admin' &&
    $role == 'kepala_divisi'
)
{
    $id_karyawan =
        $user['id_karyawan'];

    $karyawan = mysqli_query(
        $koneksi,
        "SELECT *
         FROM karyawan
         WHERE id_karyawan = $id_karyawan"
    );

    $data_karyawan =
        mysqli_fetch_assoc($karyawan);

    $id_divisi =
        $data_karyawan['id_divisi'];

    $cek_kepala = mysqli_query(
        $koneksi,
        "SELECT u.*
         FROM users u
         JOIN karyawan k
            ON u.id_karyawan = k.id_karyawan
         WHERE u.role = 'kepala_divisi'
         AND k.id_divisi = $id_divisi
         AND u.id_user != $id_user"
    );

    if (mysqli_num_rows($cek_kepala) > 0)
    {
        header(
            "Location: ../admin/akun/edit.php?id=$id_user&error=kepala_divisi"
        );

        exit;
    }
}

// UPDATE TANPA GANTI PASSWORD

if (empty($password))
{
    if ($user['role'] == 'admin')
    {
        mysqli_query(
            $koneksi,
            "UPDATE users
             SET username = '$username'
             WHERE id_user = $id_user"
        );
    }
    else
    {
        mysqli_query(
            $koneksi,
            "UPDATE users
             SET
                username = '$username',
                role = '$role'
             WHERE id_user = $id_user"
        );
    }
}

// UPDATE DENGAN PASSWORD BARU

else
{
    if ($user['role'] == 'admin')
    {
        mysqli_query(
            $koneksi,
            "UPDATE users
             SET
                username = '$username',
                password = '$password'
             WHERE id_user = $id_user"
        );
    }
    else
    {
        mysqli_query(
            $koneksi,
            "UPDATE users
             SET
                username = '$username',
                password = '$password',
                role = '$role'
             WHERE id_user = $id_user"
        );
    }
}

// KEMBALI KE DATA AKUN

header(
    "Location: ../admin/akun/index.php?success=update"
);

exit;

?>