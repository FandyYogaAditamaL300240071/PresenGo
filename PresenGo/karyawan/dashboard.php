<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';
require_once '../config/helper.php';

cekKaryawan();

$id_karyawan = (int) $_SESSION['id_karyawan'];

// AMBIL DATA KARYAWAN

$query = mysqli_query(
    $koneksi,
    "SELECT
        k.*,
        d.nama_divisi
     FROM karyawan k
     JOIN divisi d
        ON k.id_divisi = d.id_divisi
     WHERE k.id_karyawan = $id_karyawan"
);

$data = mysqli_fetch_assoc($query);

// HITUNG TOTAL HADIR

$total_hadir = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM presensi
         WHERE id_karyawan = $id_karyawan
         AND status = 'Hadir'"
    )
);

// HITUNG TOTAL IZIN

$total_izin = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM presensi
         WHERE id_karyawan = $id_karyawan
         AND status = 'Izin'"
    )
);

// HITUNG TOTAL SAKIT

$total_sakit = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM presensi
         WHERE id_karyawan = $id_karyawan
         AND status = 'Sakit'"
    )
);

// HITUNG TOTAL ALPHA

$total_alpha = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM presensi
         WHERE id_karyawan = $id_karyawan
         AND status = 'Alpha'"
    )
);

$title = "Dashboard Karyawan";
$base_url = "../";
$menu = "dashboard";

require_once '../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../templates/sidebar_karyawan.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Dashboard Karyawan</h4>

            <span>
                <?= e($data['nama_divisi']); ?>
            </span>

        </div>

        <!-- WELCOME -->

        <div class="welcome-box">

            <h2>
                Selamat Datang,
                <?= e($data['nama_karyawan']); ?>
            </h2>

            <p>
                <?= e($data['jabatan']); ?>
                -
                <?= e($data['nama_divisi']); ?>
            </p>

        </div>

        <!-- STATISTIK -->

        <div class="row mt-4">

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Hadir</h5>

                    <h2>
                        <?= $total_hadir; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Izin</h5>

                    <h2>
                        <?= $total_izin; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Sakit</h5>

                    <h2>
                        <?= $total_sakit; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Alpha</h5>

                    <h2>
                        <?= $total_alpha; ?>
                    </h2>

                </div>

            </div>

        </div>

        <!-- MENU CEPAT -->

        <div class="row mt-2">

            <div class="col-md-6 mb-3">

                <div class="dashboard-card">

                    <i class="bi bi-calendar-check-fill"></i>

                    <h5>Input Presensi</h5>

                    <a
                        href="presensi/input.php"
                        class="btn btn-primary"
                    >
                        Buka
                    </a>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <div class="dashboard-card">

                    <i class="bi bi-clock-history"></i>

                    <h5>Riwayat Presensi</h5>

                    <a
                        href="presensi/riwayat.php"
                        class="btn btn-success"
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