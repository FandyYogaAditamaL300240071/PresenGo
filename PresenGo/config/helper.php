<?php

// FORMAT TANGGAL INDONESIA

function tanggalIndonesia($tanggal)
{
    return date(
        'd-m-Y',
        strtotime($tanggal)
    );
}

// FORMAT JAM

function formatJam($jam)
{
    return date(
        'H:i',
        strtotime($jam)
    );
}

// AMANKAN OUTPUT HTML

function e($text)
{
    return htmlspecialchars(
        $text ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}

// WARNA BADGE STATUS PRESENSI

function badgeStatus($status)
{
    switch ($status)
    {
        case 'Hadir':
            return 'success';

        case 'Izin':
            return 'warning';

        case 'Sakit':
            return 'info';

        case 'Alpha':
            return 'danger';

        default:
            return 'secondary';
    }
}

// HITUNG TOTAL DATA

function hitungData($query)
{
    return mysqli_num_rows($query);
}

?>