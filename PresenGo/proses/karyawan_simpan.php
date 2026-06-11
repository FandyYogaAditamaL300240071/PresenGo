<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// AMBIL DATA FORM

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
    empty($kode_karyawan) ||
    empty($nama_karyawan) ||
    $id_divisi <= 0 ||
    empty($jabatan) ||
    empty($no_hp)
)
{
    header(
        "Location: ../admin/karyawan/tambah.php"
    );

    exit;
}

// VALIDASI FORMAT KODE KARYAWAN

if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])[A-Z0-9]{8}$/', $kode_karyawan))
{
    header(
        "Location: ../admin/karyawan/tambah.php?error=kode_format"
    );

    exit;
}

// VALIDASI NOMOR HP

if (!preg_match('/^[0-9]{11,13}$/', $no_hp))
{
    header(
        "Location: ../admin/karyawan/tambah.php?error=hp"
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
     WHERE kode_karyawan = '$kode_karyawan'"
);

if (mysqli_num_rows($cek_kode) > 0)
{
    header(
        "Location: ../admin/karyawan/tambah.php?error=kode"
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
        "Location: ../admin/karyawan/tambah.php"
    );

    exit;
}

// SIMPAN DATA

mysqli_query(
    $koneksi,
    "INSERT INTO karyawan
    (
        kode_karyawan,
        id_divisi,
        nama_karyawan,
        alamat,
        no_hp,
        jabatan
    )
    VALUES
    (
        '$kode_karyawan',
        '$id_divisi',
        '$nama_karyawan',
        '$alamat',
        '$no_hp',
        '$jabatan'
    )"
);

// KEMBALI KE DATA KARYAWAN

header(
    "Location: ../admin/karyawan/index.php?success=tambah"
);

exit;

?>
