<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

// CEK ID DIVISI

if (!isset($_GET['id']))
{
    header(
        "Location: index.php"
    );

    exit;
}

$id_divisi = (int) $_GET['id'];

// AMBIL DATA DIVISI

$divisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     WHERE id_divisi = $id_divisi"
);

if (mysqli_num_rows($divisi) == 0)
{
    header(
        "Location: index.php"
    );

    exit;
}

$data_divisi = mysqli_fetch_assoc(
    $divisi
);

// AMBIL DATA KARYAWAN

$query = mysqli_query(
    $koneksi,
    "SELECT
        k.*,
        COUNT(p.id_presensi) AS total_presensi
     FROM karyawan k
     LEFT JOIN presensi p
        ON k.id_karyawan = p.id_karyawan
     WHERE k.id_divisi = $id_divisi
     GROUP BY k.id_karyawan
     ORDER BY k.nama_karyawan ASC"
);

$title = "Presensi Divisi";
$base_url = "../../";
$menu = "presensi";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>

                Divisi
                <?= e($data_divisi['nama_divisi']); ?>

            </h4>

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>

        <!-- TABEL -->

        <div class="table-responsive mt-4">

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
                            Total Presensi
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
                        mysqli_fetch_assoc($query)
                    ) :

                    ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>
                            <?= e($data['nama_karyawan']); ?>
                        </td>

                        <td>
                            <?= e($data['jabatan']); ?>
                        </td>

                        <td>
                            <?= $data['total_presensi']; ?>
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

require_once '../../templates/footer.php';

?>