<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

// FILTER DIVISI

$id_divisi = (int) (
    $_GET['id_divisi'] ?? 0
);

// DATA DIVISI

$divisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     ORDER BY nama_divisi ASC"
);

// QUERY KARYAWAN

$sql = "
    SELECT
        k.*,
        d.nama_divisi
    FROM karyawan k
    JOIN divisi d
        ON k.id_divisi = d.id_divisi
";

if ($id_divisi > 0)
{
    $sql .= "
        WHERE k.id_divisi = $id_divisi
    ";
}

$sql .= "
    ORDER BY
        LEFT(k.kode_karyawan, 1) ASC,
        CAST(SUBSTRING(k.kode_karyawan, 2) AS UNSIGNED) ASC,
        k.kode_karyawan ASC
";

$query = mysqli_query(
    $koneksi,
    $sql
);

$title = "Data Karyawan";
$base_url = "../../";
$menu = "karyawan";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Data Karyawan</h4>

            <a
                href="tambah.php"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-circle"></i>
                Tambah Karyawan
            </a>

        </div>

        <!-- ALERT -->

        <?php if(isset($_GET['success'])) : ?>

            <div class="alert alert-success mt-3">

                Data berhasil diproses.

            </div>

        <?php endif; ?>

        <!-- FILTER -->

        <div class="card mt-4">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">

                        <form method="GET">

                            <select
                                name="id_divisi"
                                class="form-select"
                                onchange="this.form.submit()"
                            >

                                <option value="0">

                                    Semua Divisi

                                </option>

                                <?php
                                mysqli_data_seek(
                                    $divisi,
                                    0
                                );

                                while(
                                    $d =
                                    mysqli_fetch_assoc($divisi)
                                ) :
                                ?>

                                <option
                                    value="<?= $d['id_divisi']; ?>"
                                    <?= $id_divisi == $d['id_divisi']
                                        ? 'selected'
                                        : ''; ?>
                                >

                                    <?= e($d['nama_divisi']); ?>

                                </option>

                                <?php endwhile; ?>

                            </select>

                        </form>

                    </div>

                    <div class="col-md-4">

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

        </div>

        <!-- TABEL -->

        <div class="table-responsive mt-3">

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
                            Divisi
                        </th>

                        <th>
                            Jabatan
                        </th>

                        <th>
                            No HP
                        </th>

                        <th width="220">
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
                            <?= e($data['kode_karyawan']); ?>
                        </td>

                        <td>
                            <?= e($data['nama_karyawan']); ?>
                        </td>

                        <td>
                            <?= e($data['nama_divisi']); ?>
                        </td>

                        <td>
                            <?= e($data['jabatan']); ?>
                        </td>

                        <td>
                            <?= e($data['no_hp']); ?>
                        </td>

                        <td>

                            <a
                                href="detail.php?id=<?= $data['id_karyawan']; ?>"
                                class="btn btn-info btn-sm"
                            >
                                <i class="bi bi-eye"></i>
                            </a>

                            <a
                                href="edit.php?id=<?= $data['id_karyawan']; ?>"
                                class="btn btn-warning btn-sm"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            <a
                                href="../../proses/karyawan_hapus.php?id=<?= $data['id_karyawan']; ?>"
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

require_once '../../templates/footer.php';

?>
