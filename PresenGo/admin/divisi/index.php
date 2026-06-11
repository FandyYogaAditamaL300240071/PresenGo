<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

// AMBIL DATA DIVISI

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     ORDER BY id_divisi ASC"
);

$title = "Data Divisi";
$base_url = "../../";
$menu = "divisi";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Data Divisi</h4>

            <a
                href="tambah.php"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-circle"></i>
                Tambah Divisi
            </a>

        </div>



        <!-- ALERT -->

        <?php if(isset($_GET['success'])) : ?>

            <div class="alert alert-success mt-3">

                Data berhasil diproses.

            </div>

        <?php endif; ?>
        
        <?php if(isset($_GET['error']) && $_GET['error'] == 'digunakan') : ?>

        <div class="alert alert-danger mt-3">

            Divisi tidak dapat dihapus karena masih digunakan oleh karyawan.

        </div>

        <?php endif; ?>

        <!-- SEARCH -->

        <div class="card mt-4">

            <div class="card-body">

                <div class="search-box">

                    <input
                        type="text"
                        id="searchInput"
                        class="form-control"
                        placeholder="Cari divisi..."
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

        <div class="table-responsive mt-3">

            <table
                class="table table-bordered table-hover"
                id="dataTable"
            >

                <thead>

                    <tr>

                        <th width="70">
                            No
                        </th>

                        <th>
                            Nama Divisi
                        </th>

                        <th>
                            Deskripsi
                        </th>

                        <th width="180">
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
                            <?= e($data['nama_divisi']); ?>
                        </td>

                        <td>
                            <?= e($data['deskripsi']); ?>
                        </td>

                        <td>

                            <a
                                href="edit.php?id=<?= $data['id_divisi']; ?>"
                                class="btn btn-warning btn-sm"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            <a
                                href="../../proses/divisi_hapus.php?id=<?= $data['id_divisi']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return konfirmasiHapus(this)"
                            >
                                <i class="bi bi-trash"></i>
                            </a>

                        </td>

                    </tr>

                    <?php endwhile; ?>

                    <?php if(mysqli_num_rows($query) == 0) : ?>

                    <tr>

                        <td
                            colspan="4"
                            class="empty-data"
                        >

                            Tidak ada data divisi.

                        </td>

                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php

require_once '../../templates/footer.php';

?>
