<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

// AMBIL DATA AKUN

$query = mysqli_query(
    $koneksi,
    "SELECT
        u.*,
        k.nama_karyawan,
        d.nama_divisi
     FROM users u
     LEFT JOIN karyawan k
        ON u.id_karyawan = k.id_karyawan
     LEFT JOIN divisi d
        ON k.id_divisi = d.id_divisi
     ORDER BY u.id_user ASC"
);

$title = "Data Akun";
$base_url = "../../";
$menu = "akun";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Data Akun</h4>

            <a
                href="tambah.php"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-circle"></i>
                Tambah Akun
            </a>

        </div>

        <!-- ALERT -->

        <?php if(isset($_GET['success'])) : ?>

            <div class="alert alert-success mt-3">

                Data berhasil diproses.

            </div>

        <?php endif; ?>
        
        <?php if(isset($_GET['error']) && $_GET['error'] == 'admin') : ?>

        <div class="alert alert-danger mt-3">

            Akun admin tidak dapat dihapus.

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
                        placeholder="Cari akun..."
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

                        <th width="60">
                            No
                        </th>

                        <th>
                            Nama Karyawan
                        </th>

                        <th>
                            Username
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Divisi
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
                            <?= e($data['nama_karyawan'] ?? 'Administrator'); ?>
                        </td>

                        <td>
                            <?= e($data['username']); ?>
                        </td>

                        <td>

                            <?php
                            if ($data['role'] == 'admin')
                            {
                                echo '<span class="badge bg-danger">Admin</span>';
                            }
                            elseif ($data['role'] == 'kepala_divisi')
                            {
                                echo '<span class="badge bg-warning">Kepala Divisi</span>';
                            }
                            else
                            {
                                echo '<span class="badge bg-primary">Karyawan</span>';
                            }
                            ?>

                        </td>

                        <td>
                            <?= e($data['nama_divisi'] ?? '-'); ?>
                        </td>

                        <td>

                            <a
                                href="edit.php?id=<?= $data['id_user']; ?>"
                                class="btn btn-warning btn-sm"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            <?php if($data['role'] != 'admin') : ?>

                            <a
                                href="../../proses/akun_hapus.php?id=<?= $data['id_user']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return konfirmasiHapus(this)"
                            >
                                <i class="bi bi-trash"></i>
                            </a>

                            <?php endif; ?>

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
