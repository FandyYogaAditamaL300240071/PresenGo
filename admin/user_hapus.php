<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil ID User
$id = $_GET['id'] ?? 0;

// Mengambil Data User
$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM users
     WHERE id_user = '$id'"
);
$user = mysqli_fetch_assoc($query);

// Jika Data Tidak Ditemukan
if(!$user)
{
    header("Location: user.php");
    exit;
}

// Mencegah Admin Menghapus Akun Sendiri
if($user['id_user'] == $_SESSION['id_user'])
{
    echo "
    <script>
        alert('Akun yang sedang digunakan tidak dapat dihapus!');
        window.location='user.php';
    </script>
    ";
    exit;
}

// Hapus Data User
$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM users
     WHERE id_user = '$id'"
);

// Redirect
if($hapus)
{
    header("Location: user.php?pesan=hapus");
    exit;
}
else
{
    header("Location: user.php");
    exit;
}

?>