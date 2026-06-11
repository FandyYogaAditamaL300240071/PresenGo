<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

// AMBIL DATA DIVISI

$query = mysqli_query(
    $koneksi,
    "SELECT
        d.*,
        COUNT(p.id_presensi) AS total_presensi
     FROM divisi d
     LEFT JOIN karyawan k
        ON d.id_divisi = k.id_divisi
     LEFT JOIN presensi p
        ON k.id_karyawan = p.id_karyawan
     GROUP BY d.id_divisi
     ORDER BY d.nama_divisi ASC"
);

$title = "Monitoring Presensi";
$base_url = "../../";
$menu = "presensi";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Monitoring Presensi</h4>

        </div>

        <!-- CARD DIVISI -->

        <div class="row mt-4">

            <?php
            while(
                $data =
                mysqli_fetch_assoc($query)
            ) :
            ?>

            <div class="col-md-3 mb-4">

                <div class="dashboard-card">

                    <i class="bi bi-building"></i>

                    <h5>
                        <?= e($data['nama_divisi']); ?>
                    </h5>

                    <h2>
                        <?= $data['total_presensi']; ?>
                    </h2>

                    <p>
                        Total Presensi
                    </p>

                    <a
                        href="divisi.php?id=<?= $data['id_divisi']; ?>"
                        class="btn btn-primary"
                    >
                        Lihat Detail
                    </a>

                </div>

            </div>

            <?php endwhile; ?>

        </div>

    </div>

</div>

<?php

require_once '../../templates/footer.php';

?>