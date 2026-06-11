<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekDivisi();

// CEK ID

if (!isset($_GET['id']))
{
    header(
        "Location: index.php"
    );

    exit;
}

$id_karyawan = (int) $_GET['id'];

$id_login = (int)
$_SESSION['id_karyawan'];

// AMBIL DATA KEPALA DIVISI

$user = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_karyawan = $id_login"
);

$data_user =
mysqli_fetch_assoc($user);

$id_divisi =
$data_user['id_divisi'];

// AMBIL DATA KARYAWAN

$query = mysqli_query(
    $koneksi,
    "SELECT
        k.*,
        d.nama_divisi
     FROM karyawan k
     JOIN divisi d
        ON k.id_divisi = d.id_divisi
     WHERE k.id_karyawan = $id_karyawan
     AND k.id_divisi = $id_divisi"
);

if (mysqli_num_rows($query) == 0)
{
    header(
        "Location: index.php"
    );

    exit;
}

$data = mysqli_fetch_assoc($query);

$title = "Detail Karyawan";
$base_url = "../../";
$menu = "karyawan";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php
    require_once
    '../../templates/sidebar_divisi.php';
    ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>
                Detail Karyawan
            </h4>

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>

        <!-- DETAIL -->

        <div class="card mt-4">

            <div class="card-header">

                Informasi Karyawan

            </div>

            <div class="card-body">

                <table class="table">

                    <tr>

                        <th width="220">
                            Kode Karyawan
                        </th>

                        <td>
                            <?= e(
                                $data['kode_karyawan']
                            ); ?>
                        </td>

                    </tr>

                    <tr>

                        <th width="220">
                            Nama Karyawan
                        </th>

                        <td>
                            <?= e(
                                $data['nama_karyawan']
                            ); ?>
                        </td>

                    </tr>

                    <tr>

                        <th>
                            Divisi
                        </th>

                        <td>
                            <?= e(
                                $data['nama_divisi']
                            ); ?>
                        </td>

                    </tr>

                    <tr>

                        <th>
                            Jabatan
                        </th>

                        <td>
                            <?= e(
                                $data['jabatan']
                            ); ?>
                        </td>

                    </tr>

                    <tr>

                        <th>
                            Nomor HP
                        </th>

                        <td>
                            <?= e(
                                $data['no_hp']
                            ); ?>
                        </td>

                    </tr>

                    <tr>

                        <th>
                            Alamat
                        </th>

                        <td>
                            <?= e(
                                $data['alamat']
                            ); ?>
                        </td>

                    </tr>

                </table>

            </div>

        </div>

        <!-- STATISTIK PRESENSI -->

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

        <div class="row mt-3">

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

    </div>

</div>

<?php

require_once
'../../templates/footer.php';

?>
