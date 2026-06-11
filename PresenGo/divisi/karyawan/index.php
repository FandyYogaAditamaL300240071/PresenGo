<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekDivisi();

$id_karyawan_login = (int)
$_SESSION['id_karyawan'];

// AMBIL DATA KEPALA DIVISI

$user = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_karyawan =
     $id_karyawan_login"
);

$data_user =
mysqli_fetch_assoc($user);

$id_divisi =
$data_user['id_divisi'];

// AMBIL DATA KARYAWAN DIVISI

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_divisi = $id_divisi
     ORDER BY
        LEFT(kode_karyawan, 1) ASC,
        CAST(SUBSTRING(kode_karyawan, 2) AS UNSIGNED) ASC,
        kode_karyawan ASC"
);

$title = "Data Karyawan";
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
                Data Karyawan Divisi
            </h4>

        </div>

        <!-- SEARCH -->

        <div class="card mt-4">

            <div class="card-body">

                <div class="search-box">

                    <input
                        type="text"
                        id="searchInput"
                        class="form-control"
                        placeholder="Cari karyawan..."
                        onkeyup="
                        cariData(
                        'searchInput',
                        'dataTable'
                        )
                        "
                    >

                </div>

            </div>

        </div>

        <!-- TABEL -->

        <div
            class="table-responsive mt-3"
        >

            <table
                class="table table-bordered table-hover"
                id="dataTable"
            >

                <thead>

                    <tr>

                        <th width="60">
                            No
                        </th>

                        <th>
                            Kode
                        </th>

                        <th>
                            Nama Karyawan
                        </th>

                        <th>
                            Jabatan
                        </th>

                        <th>
                            No HP
                        </th>

                        <th width="120">
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
                                $data['kode_karyawan']
                            ); ?>
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
                            <?= e(
                                $data['no_hp']
                            ); ?>
                        </td>

                        <td>

                            <a
                                href="detail.php?id=<?= $data['id_karyawan']; ?>"
                                class="btn btn-info btn-sm"
                            >
                                <i class="bi bi-eye"></i>
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
