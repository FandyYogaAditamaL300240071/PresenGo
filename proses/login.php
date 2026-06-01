<?php

// Memulai Session
session_start();

// Memanggil Koneksi Database
require_once '../config/koneksi.php';

// Mengambil Data Login
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Mencari User
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users
     WHERE username = '$username'
     AND password = '$password'"
);

// Cek User Ditemukan
if (mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);

    // Menyimpan Session Login
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['id_karyawan'] = $user['id_karyawan'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    // Redirect Berdasarkan Role
    if ($user['role'] == 'admin') {

        header("Location: ../admin/dashboard.php");
        exit;
    }
    if ($user['role'] == 'divisi') {

        header("Location: ../divisi/dashboard.php");
        exit;
    }
    if ($user['role'] == 'karyawan') {

        header("Location: ../karyawan/dashboard.php");
        exit;
    }
} else {

    // Login Gagal
    header("Location: ../index.php?pesan=gagal");
    exit;
}
?>