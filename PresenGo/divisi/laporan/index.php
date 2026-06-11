<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekDivisi();

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

// DATA LAPORAN

$query = mysqli_query(
    $koneksi,
    "SELECT
        k.id_karyawan,
        k.nama_karyawan,
        k.jabatan,

        COUNT(
            CASE
            WHEN p.status = 'Hadir'
            THEN 1
            END
        ) AS hadir,

        COUNT(
            CASE
            WHEN p.status = 'Izin'
            THEN 1
            END
        ) AS izin,

        COUNT(
            CASE
            WHEN p.status = 'Sakit'
            THEN 1
            END
        ) AS sakit,

        COUNT(
            CASE
            WHEN p.status = 'Alpha'
            THEN 1
            END
        ) AS alpha

     FROM karyawan k

     LEFT JOIN presensi p
        ON k.id_karyawan = p.id_karyawan

     WHERE k.id_divisi = $id_divisi

     GROUP BY k.id_karyawan

     ORDER BY k.nama_karyawan ASC"
);

$title = "Laporan Presensi";
$base_url = "../../";
$menu = "laporan";

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
                Laporan Presensi Divisi
            </h4>

        </div>

        <!-- TABEL LAPORAN -->

        <div
            class="table-responsive mt-4"
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
                            Nama Karyawan
                        </th>

                        <th>
                            Jabatan
                        </th>

                        <th>
                            Hadir
                        </th>

                        <th>
                            Izin
                        </th>

                        <th>
                            Sakit
                        </th>

                        <th>
                            Alpha
                        </th>

                        <th>
                            Total
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

                    $total =
                        $data['hadir']
                        + $data['izin']
                        + $data['sakit']
                        + $data['alpha'];

                    ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>
                            <?= e(
                                $data['nama_karyawan']
                            ); ?>
                        </td>

                        <td>
                            <?= e(
                                $data['jabatan']
                            ); ?>
                        </td>

                        <td>
                            <?= $data['hadir']; ?>
                        </td>

                        <td>
                            <?= $data['izin']; ?>
                        </td>

                        <td>
                            <?= $data['sakit']; ?>
                        </td>

                        <td>
                            <?= $data['alpha']; ?>
                        </td>

                        <td>
                            <strong>
                                <?= $total; ?>
                            </strong>
                        </td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php

require_once
'../../templates/footer.php';

?>