<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// AMBIL DATA FORM

$id_karyawan = (int) (
    $_POST['id_karyawan'] ?? 0
);

$kode_karyawan = strtoupper(trim(
    $_POST['kode_karyawan'] ?? ''
));

$nama_karyawan = trim(
    $_POST['nama_karyawan'] ?? ''
);

$id_divisi = (int) (
    $_POST['id_divisi'] ?? 0
);

$jabatan = trim(
    $_POST['jabatan'] ?? ''
);

$no_hp = trim(
    $_POST['no_hp'] ?? ''
);

$alamat = trim(
    $_POST['alamat'] ?? ''
);

// CEK INPUT

if (
    $id_karyawan <= 0 ||
    empty($kode_karyawan) ||
    empty($nama_karyawan) ||
    $id_divisi <= 0 ||
    empty($jabatan) ||
    empty($no_hp)
)
{
    header(
        "Location: ../admin/karyawan/index.php"
    );

    exit;
}

// VALIDASI FORMAT KODE KARYAWAN

if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])[A-Z0-9]{8}$/', $kode_karyawan))
{
    header(
        "Location: ../admin/karyawan/edit.php?id=$id_karyawan&error=kode_format"
    );

    exit;
}

// VALIDASI NOMOR HP

if (!preg_match('/^[0-9]{11,13}$/', $no_hp))
{
    header(
        "Location: ../admin/karyawan/edit.php?id=$id_karyawan&error=hp"
    );

    exit;
}

// CEK KODE KARYAWAN

$kode_karyawan = mysqli_real_escape_string(
    $koneksi,
    $kode_karyawan
);

$cek_kode = mysqli_query(
    $koneksi,
    "SELECT id_karyawan
     FROM karyawan
     WHERE kode_karyawan = '$kode_karyawan'
     AND id_karyawan != $id_karyawan"
);

if (mysqli_num_rows($cek_kode) > 0)
{
    header(
        "Location: ../admin/karyawan/edit.php?id=$id_karyawan&error=kode"
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
        "Location: ../admin/karyawan/index.php"
    );

    exit;
}

// CEK DIVISI

$cek_divisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     WHERE id_divisi = $id_divisi"
);

if (mysqli_num_rows($cek_divisi) == 0)
{
    header(
        "Location: ../admin/karyawan/index.php"
    );

    exit;
}

// UPDATE DATA

mysqli_query(
    $koneksi,
    "UPDATE karyawan
     SET
        kode_karyawan = '$kode_karyawan',
        id_divisi = '$id_divisi',
        nama_karyawan = '$nama_karyawan',
        alamat = '$alamat',
        no_hp = '$no_hp',
        jabatan = '$jabatan'
     WHERE id_karyawan = $id_karyawan"
);

// KEMBALI KE DATA KARYAWAN

header(
    "Location: ../admin/karyawan/index.php?success=update"
);

exit;

?>
