<?php

// Memulai Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek Login
function cekLogin()
{
    if (!isset($_SESSION['login'])) {
        header("Location: ../index.php");
        exit;
    }
}

// Cek Admin
function cekAdmin()
{
    cekLogin();

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../index.php");
        exit;
    }
}

// Cek Kepala Divisi
function cekDivisi()
{
    cekLogin();

    if ($_SESSION['role'] != 'divisi') {
        header("Location: ../index.php");
        exit;
    }
}

// Cek Karyawan
function cekKaryawan()
{
    cekLogin();

    if ($_SESSION['role'] != 'karyawan') {
        header("Location: ../index.php");
        exit;
    }
}
?>