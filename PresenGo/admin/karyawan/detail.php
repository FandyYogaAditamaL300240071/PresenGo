<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

// CEK ID

if (!isset($_GET['id']))
{
    header(
        "Location: index.php"
    );

    exit;
}

$id_karyawan = (int) $_GET['id'];

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

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Detail Karyawan</h4>

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
                            <?= e($data['kode_karyawan']); ?>
                        </td>

                    </tr>

                    <tr>

                        <th width="220">
                            Nama Karyawan
                        </th>

                        <td>
                            <?= e($data['nama_karyawan']); ?>
                        </td>

                    </tr>

                    <tr>

                        <th>
                            Divisi
                        </th>

                        <td>
                            <?= e($data['nama_divisi']); ?>
                        </td>

                    </tr>

                    <tr>

                        <th>
                            Jabatan
                        </th>

                        <td>
                            <?= e($data['jabatan']); ?>
                        </td>

                    </tr>

                    <tr>

                        <th>
                            Nomor HP
                        </th>

                        <td>
                            <?= e($data['no_hp']); ?>
                        </td>

                    </tr>

                    <tr>

                        <th>
                            Alamat
                        </th>

                        <td>
                            <?= e($data['alamat']); ?>
                        </td>

                    </tr>

                </table>

                <a
                    href="edit.php?id=<?= $data['id_karyawan']; ?>"
                    class="btn btn-warning"
                >
                    <i class="bi bi-pencil"></i>
                    Edit Data
                </a>

            </div>

        </div>

    </div>

</div>

<?php

require_once '../../templates/footer.php';

?>
