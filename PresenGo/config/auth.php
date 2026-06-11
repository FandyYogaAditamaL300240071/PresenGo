<?php

require_once __DIR__ . '/helper.php';

// MEMULAI SESSION

if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}

// CEK LOGIN

function cekLogin()
{
    if (!isset($_SESSION['id_user']))
    {
        header("Location: ../index.php");
        exit;
    }
}

// CEK ADMIN

function cekAdmin()
{
    cekLogin();

    if ($_SESSION['role'] !== 'admin')
    {
        header("Location: ../index.php");
        exit;
    }
}

// CEK KEPALA DIVISI

function cekDivisi()
{
    cekLogin();

    if ($_SESSION['role'] !== 'kepala_divisi')
    {
        header("Location: ../index.php");
        exit;
    }
}

// CEK KARYAWAN

function cekKaryawan()
{
    cekLogin();

    if ($_SESSION['role'] !== 'karyawan')
    {
        header("Location: ../index.php");
        exit;
    }
}

?>
