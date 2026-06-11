<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';
require_once '../config/helper.php';

cekDivisi();

$id_karyawan = (int) $_SESSION['id_karyawan'];

// AMBIL DATA KEPALA DIVISI

$query_user = mysqli_query(
    $koneksi,
    "SELECT
        k.*,
        d.nama_divisi
     FROM karyawan k
     JOIN divisi d
        ON k.id_divisi = d.id_divisi
     WHERE k.id_karyawan = $id_karyawan"
);

$data_user = mysqli_fetch_assoc(
    $query_user
);

$id_divisi = $data_user['id_divisi'];

// HITUNG JUMLAH KARYAWAN DIVISI

$total_karyawan = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM karyawan
         WHERE id_divisi = $id_divisi"
    )
);

// TANGGAL HARI INI

$hari_ini = date('Y-m-d');

// HITUNG HADIR HARI INI

$total_hadir = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT p.*
         FROM presensi p
         JOIN karyawan k
            ON p.id_karyawan = k.id_karyawan
         WHERE k.id_divisi = $id_divisi
         AND p.tanggal = '$hari_ini'
         AND p.status = 'Hadir'"
    )
);

// HITUNG IZIN HARI INI

$total_izin = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT p.*
         FROM presensi p
         JOIN karyawan k
            ON p.id_karyawan = k.id_karyawan
         WHERE k.id_divisi = $id_divisi
         AND p.tanggal = '$hari_ini'
         AND p.status = 'Izin'"
    )
);

// HITUNG SAKIT HARI INI

$total_sakit = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT p.*
         FROM presensi p
         JOIN karyawan k
            ON p.id_karyawan = k.id_karyawan
         WHERE k.id_divisi = $id_divisi
         AND p.tanggal = '$hari_ini'
         AND p.status = 'Sakit'"
    )
);

$title = "Dashboard Kepala Divisi";
$base_url = "../";
$menu = "dashboard";

require_once '../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../templates/sidebar_divisi.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Dashboard Kepala Divisi</h4>

            <span>
                <?= e($data_user['nama_divisi']); ?>
            </span>

        </div>

        <!-- WELCOME -->

        <div class="welcome-box">

            <h2>
                Selamat Datang,
                <?= e($data_user['nama_karyawan']); ?>
            </h2>

            <p>
                Kepala Divisi
                <?= e($data_user['nama_divisi']); ?>
            </p>

        </div>

        <!-- STATISTIK -->

        <div class="row mt-4">

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Karyawan</h5>

                    <h2>
                        <?= $total_karyawan; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Hadir Hari Ini</h5>

                    <h2>
                        <?= $total_hadir; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Izin Hari Ini</h5>

                    <h2>
                        <?= $total_izin; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Sakit Hari Ini</h5>

                    <h2>
                        <?= $total_sakit; ?>
                    </h2>

                </div>

            </div>

        </div>

        <!-- MENU CEPAT -->

        <div class="row mt-2">

            <div class="col-md-4 mb-3">

                <div class="dashboard-card">

                    <i class="bi bi-people-fill"></i>

                    <h5>Data Karyawan</h5>

                    <a
                        href="karyawan/index.php"
                        class="btn btn-primary"
                    >
                        Buka
                    </a>

                </div>

            </div>

            <div class="col-md-4 mb-3">

                <div class="dashboard-card">

                    <i class="bi bi-calendar-check-fill"></i>

                    <h5>Presensi</h5>

                    <a
                        href="presensi/index.php"
                        class="btn btn-success"
                    >
                        Buka
                    </a>

                </div>

            </div>

            <div class="col-md-4 mb-3">

                <div class="dashboard-card">

                    <i class="bi bi-bar-chart-fill"></i>

                    <h5>Monitoring</h5>

                    <a
                        href="laporan/index.php"
                        class="btn btn-warning"
                    >
                        Buka
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php

require_once '../templates/footer.php';

?>