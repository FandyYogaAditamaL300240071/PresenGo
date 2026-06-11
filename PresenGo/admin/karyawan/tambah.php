<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

// AMBIL DATA DIVISI

$divisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     ORDER BY nama_divisi ASC"
);

$title = "Tambah Karyawan";
$base_url = "../../";
$menu = "karyawan";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Tambah Karyawan</h4>

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>

        <?php if(($_GET['error'] ?? '') === 'kode') : ?>

            <div class="alert alert-danger mt-3">

                Kode karyawan sudah digunakan.

            </div>

        <?php endif; ?>

        <?php if(($_GET['error'] ?? '') === 'kode_format') : ?>

            <div class="alert alert-danger mt-3">

                Kode karyawan harus tepat 8 karakter, berisi kombinasi
                huruf dan angka.

            </div>

        <?php endif; ?>

        <?php if(($_GET['error'] ?? '') === 'hp') : ?>

            <div class="alert alert-danger mt-3">

                Nomor HP harus berisi 11 sampai 13 digit angka.

            </div>

        <?php endif; ?>

        <!-- FORM -->

        <div class="card mt-4">

            <div class="card-header">

                Form Tambah Karyawan

            </div>

            <div class="card-body">

                <form
                    action="../../proses/karyawan_simpan.php"
                    method="POST"
                >

                    <div class="mb-3">

                        <label class="form-label">

                            Kode Karyawan

                        </label>

                        <input
                            type="text"
                            name="kode_karyawan"
                            class="form-control"
                            minlength="8"
                            maxlength="8"
                            pattern="(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]{8}"
                            title="Kode karyawan harus tepat 8 karakter, berisi kombinasi huruf dan angka."
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Karyawan

                        </label>

                        <input
                            type="text"
                            name="nama_karyawan"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Divisi

                        </label>

                        <select
                            name="id_divisi"
                            class="form-select"
                            required
                        >

                            <option value="">

                                -- Pilih Divisi --

                            </option>

                            <?php
                            while(
                                $d =
                                mysqli_fetch_assoc($divisi)
                            ) :
                            ?>

                            <option
                                value="<?= $d['id_divisi']; ?>"
                            >

                                <?= e($d['nama_divisi']); ?>

                            </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Jabatan

                        </label>

                        <input
                            type="text"
                            name="jabatan"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Nomor HP

                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            class="form-control"
                            inputmode="numeric"
                            minlength="11"
                            maxlength="13"
                            pattern="[0-9]{11,13}"
                            title="Nomor HP harus berisi 11 sampai 13 digit angka."
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Alamat

                        </label>

                        <textarea
                            name="alamat"
                            class="form-control"
                            rows="4"
                        ></textarea>

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
