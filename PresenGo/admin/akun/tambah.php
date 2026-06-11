<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

// AMBIL KARYAWAN YANG BELUM MEMILIKI AKUN

$karyawan = mysqli_query(
    $koneksi,
    "SELECT
        k.*,
        d.nama_divisi
     FROM karyawan k
     JOIN divisi d
        ON k.id_divisi = d.id_divisi
     WHERE k.id_karyawan NOT IN
     (
        SELECT id_karyawan
        FROM users
        WHERE id_karyawan IS NOT NULL
     )
     ORDER BY k.nama_karyawan ASC"
);

$title = "Tambah Akun";
$base_url = "../../";
$menu = "akun";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Tambah Akun</h4>

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>

        <!-- ALERT -->

        <?php if(isset($_GET['error'])) : ?>

            <div class="alert alert-danger mt-3">

                Data akun tidak valid.

            </div>

        <?php endif; ?>

        <!-- FORM -->

        <div class="card mt-4">

            <div class="card-header">

                Form Tambah Akun

            </div>

            <div class="card-body">

                <form
                    action="../../proses/akun_simpan.php"
                    method="POST"
                >

                    <div class="mb-3">

                        <label class="form-label">

                            Karyawan

                        </label>

                        <select
                            name="id_karyawan"
                            class="form-select"
                            required
                        >

                            <option value="">

                                -- Pilih Karyawan --

                            </option>

                            <?php
                            while(
                                $k =
                                mysqli_fetch_assoc($karyawan)
                            ) :
                            ?>

                            <option
                                value="<?= $k['id_karyawan']; ?>"
                            >

                                <?= e($k['nama_karyawan']); ?>
                                -
                                <?= e($k['nama_divisi']); ?>

                            </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Username

                        </label>

                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Password

                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                required
                            >

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword('password')"
                            >
                                <i class="bi bi-eye"></i>
                            </button>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Role

                        </label>

                        <select
                            name="role"
                            class="form-select"
                            required
                        >

                            <option value="">

                                -- Pilih Role --

                            </option>

                            <option value="kepala_divisi">

                                Kepala Divisi

                            </option>

                            <option value="karyawan">

                                Karyawan

                            </option>

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan
                    </button>

                    <a
                        href="index.php"
                        class="btn btn-secondary"
                    >
                        Batal
                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

<?php

require_once '../../templates/footer.php';

?>
