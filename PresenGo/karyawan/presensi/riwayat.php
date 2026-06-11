<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekKaryawan();

$id_karyawan = (int)
$_SESSION['id_karyawan'];

// AMBIL DATA PRESENSI

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM presensi
     WHERE id_karyawan = $id_karyawan
     ORDER BY tanggal DESC"
);

$title = "Riwayat Presensi";
$base_url = "../../";
$menu = "riwayat";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php
    require_once
    '../../templates/sidebar_karyawan.php';
    ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>
                Riwayat Presensi
            </h4>

        </div>

        <!-- STATISTIK -->

        <?php

        $hadir = mysqli_num_rows(
            mysqli_query(
                $koneksi,
                "SELECT *
                 FROM presensi
                 WHERE id_karyawan = $id_karyawan
                 AND status = 'Hadir'"
            )
        );

        $izin = mysqli_num_rows(
            mysqli_query(
                $koneksi,
                "SELECT *
                 FROM presensi
                 WHERE id_karyawan = $id_karyawan
                 AND status = 'Izin'"
            )
        );

        $sakit = mysqli_num_rows(
            mysqli_query(
                $koneksi,
                "SELECT *
                 FROM presensi
                 WHERE id_karyawan = $id_karyawan
                 AND status = 'Sakit'"
            )
        );

        $alpha = mysqli_num_rows(
            mysqli_query(
                $koneksi,
                "SELECT *
                 FROM presensi
                 WHERE id_karyawan = $id_karyawan
                 AND status = 'Alpha'"
            )
        );

        ?>

        <div class="row mt-4">

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Hadir</h5>

                    <h2>
                        <?= $hadir; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Izin</h5>

                    <h2>
                        <?= $izin; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Sakit</h5>

                    <h2>
                        <?= $sakit; ?>
                    </h2>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="stat-card">

                    <h5>Alpha</h5>

                    <h2>
                        <?= $alpha; ?>
                    </h2>

                </div>

            </div>

        </div>

        <!-- TABEL -->

        <div
            class="table-responsive mt-3"
        >

            <table
                class="table table-bordered table-hover"
            >

                <thead>

                    <tr>

                        <th width="60">
                            No
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th>
                            Jam Masuk
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Keterangan
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $no = 1;

                    while(
                        $data =
                        mysqli_fetch_assoc(
                            $query
                        )
                    ) :

                    ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>
                            <?= tanggalIndonesia(
                                $data['tanggal']
                            ); ?>
                        </td>

                        <td>
                            <?= e(
                                $data['jam_masuk']
                            ); ?>
                        </td>

                        <td>

                            <span
                                class="badge bg-<?= badgeStatus(
                                    $data['status']
                                ); ?>"
                            >

                                <?= e(
                                    $data['status']
                                ); ?>

                            </span>

                        </td>

                        <td>
                            <?= e(
                                $data['keterangan']
                            ); ?>
                        </td>

                    </tr>

                    <?php endwhile; ?>

                    <?php if(
                        mysqli_num_rows($query)
                        == 0
                    ) : ?>

                    <tr>

                        <td
                            colspan="5"
                            class="text-center"
                        >

                            Belum ada data
                            presensi.

                        </td>

                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php

require_once
'../../templates/footer.php';

?>