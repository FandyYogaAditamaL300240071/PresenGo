<?php

require_once '../config/koneksi.php';
require_once '../config/auth.php';

cekAdmin();

// HITUNG TOTAL DIVISI

$total_divisi = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM divisi"
    )
);

// HITUNG TOTAL KARYAWAN

$total_karyawan = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM karyawan"
    )
);

// HITUNG TOTAL AKUN

$total_akun = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM users"
    )
);

// HITUNG TOTAL PRESENSI

$total_presensi = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM presensi"
    )
);

$title = "Dashboard Admin";
$base_url = "../";
$menu = "dashboard";

require_once '../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Dashboard Admin</h4>

            <span>
                <?= e($_SESSION['username']); ?>
            </span>

        </div>

        <!-- WELCOME -->

        <div class="welcome-box">

            <h2>
                Selamat Datang,
                <?= e($_SESSION['username']); ?>
            </h2>

            <p>
                Kelola data divisi, karyawan,
                akun, dan presensi melalui
                sistem PresenGo.
            </p>

        </div>

        <!-- STATISTIK -->

        <div class="row mt-4">

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Total Divisi</h5>

                    <h2>
                        <?= $total_divisi; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Total Karyawan</h5>

                    <h2>
                        <?= $total_karyawan; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Total Akun</h5>

                    <h2>
                        <?= $total_akun; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Total Presensi</h5>

                    <h2>
                        <?= $total_presensi; ?>
                    </h2>

                </div>

            </div>

        </div>

        <!-- MENU CEPAT -->

        <div class="row mt-2">

            <div class="col-md-3 mb-3">

                <div class="dashboard-card">

                    <i class="bi bi-building"></i>

                    <h5>Data Divisi</h5>

                    <a
                        href="divisi/index.php"
                        class="btn btn-primary"
                    >
                        Buka
                    </a>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="dashboard-card">

                    <i class="bi bi-people"></i>

                    <h5>Data Karyawan</h5>

                    <a
                        href="karyawan/index.php"
                        class="btn btn-success"
                    >
                        Buka
                    </a>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="dashboard-card">

                    <i class="bi bi-person-circle"></i>

                    <h5>Data Akun</h5>

                    <a
                        href="akun/index.php"
                        class="btn btn-warning"
                    >
                        Buka
                    </a>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="dashboard-card">

                    <i class="bi bi-calendar-check"></i>

                    <h5>Monitoring Presensi</h5>

                    <a
                        href="presensi/index.php"
                        class="btn btn-info"
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