<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// CEK ID

if (!isset($_GET['id']))
{
    header(
        "Location: ../admin/akun/index.php"
    );

    exit;
}

$id_user = (int) $_GET['id'];

// CEK DATA USER

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

// CEK AKUN ADMIN

if ($user['role'] == 'admin')
{
    header(
        "Location: ../admin/akun/index.php?error=admin"
    );

    exit;
}

// HAPUS AKUN

mysqli_query(
    $koneksi,
    "DELETE FROM users
     WHERE id_user = $id_user"
);

// KEMBALI KE DATA AKUN

header(
    "Location: ../admin/akun/index.php?success=hapus"
);

exit;

?>