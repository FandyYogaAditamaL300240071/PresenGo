<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekKaryawan();

$id_karyawan = (int)
$_SESSION['id_karyawan'];

// AMBIL DATA KARYAWAN

$query = mysqli_query(
    $koneksi,
    "SELECT
        k.*,
        d.nama_divisi,
        u.username
     FROM karyawan k
     JOIN divisi d
        ON k.id_divisi = d.id_divisi
     JOIN users u
        ON k.id_karyawan = u.id_karyawan
     WHERE k.id_karyawan = $id_karyawan"
);

$data =
mysqli_fetch_assoc($query);

$title = "Profil Saya";
$base_url = "../../";
$menu = "profil";

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
                Profil Saya
            </h4>

        </div>

        <!-- DATA PROFIL -->

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
                            Username
                        </th>

                        <td>
                            <?= e(
                                $data['username']
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
