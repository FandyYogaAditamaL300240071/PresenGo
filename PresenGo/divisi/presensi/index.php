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

// FILTER TANGGAL

$tanggal =
$_GET['tanggal']
?? date('Y-m-d');

// DATA PRESENSI DIVISI

$query = mysqli_query(
    $koneksi,
    "SELECT
        p.*,
        k.nama_karyawan
     FROM presensi p
     JOIN karyawan k
        ON p.id_karyawan = k.id_karyawan
     WHERE k.id_divisi = $id_divisi
     AND p.tanggal = '$tanggal'
     ORDER BY
        k.nama_karyawan ASC"
);

$title = "Data Presensi";
$base_url = "../../";
$menu = "presensi";

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
                Data Presensi
            </h4>

            <a
                href="tambah.php"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-circle"></i>
                Tambah Presensi
            </a>

        </div>

        <!-- FILTER -->

        <div class="card mt-4">

            <div class="card-body">

                <form method="GET">

                    <div class="row">

                        <div class="col-md-4">

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                value="<?= $tanggal; ?>"
                            >

                        </div>

                        <div class="col-md-2">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Filter
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!-- ALERT -->

        <?php if(isset($_GET['success'])) : ?>

        <div class="alert alert-success mt-3">

            Data berhasil diproses.

        </div>

        <?php endif; ?>

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
                            Nama Karyawan
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

                        <th width="160">
                            Aksi
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
                            <?= e(
                                $data['nama_karyawan']
                            ); ?>
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

                            <a
                                href="edit.php?id=<?= $data['id_presensi']; ?>"
                                class="btn btn-warning btn-sm"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            <a
                                href="../../proses/presensi_hapus.php?id=<?= $data['id_presensi']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return konfirmasiHapus(this)"
                            >
                                <i class="bi bi-trash"></i>
                            </a>

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
