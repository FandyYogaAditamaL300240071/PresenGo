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
    "SELECT *
     FROM karyawan
     WHERE id_karyawan = $id_karyawan"
);

if (mysqli_num_rows($query) == 0)
{
    header(
        "Location: index.php"
    );

    exit;
}

$data = mysqli_fetch_assoc($query);

// AMBIL DATA DIVISI

$divisi = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     ORDER BY nama_divisi ASC"
);

$title = "Edit Karyawan";
$base_url = "../../";
$menu = "karyawan";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Edit Karyawan</h4>

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

                Form Edit Karyawan

            </div>

            <div class="card-body">

                <form
                    action="../../proses/karyawan_update.php"
                    method="POST"
                >

                    <input
                        type="hidden"
                        name="id_karyawan"
                        value="<?= $data['id_karyawan']; ?>"
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
                            value="<?= e($data['kode_karyawan']); ?>"
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
                            value="<?= e($data['nama_karyawan']); ?>"
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

                            <?php
                            while(
                                $d =
                                mysqli_fetch_assoc($divisi)
                            ) :
                            ?>

                            <option
                                value="<?= $d['id_divisi']; ?>"
                                <?= $data['id_divisi'] == $d['id_divisi']
                                    ? 'selected'
                                    : ''; ?>
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
                            value="<?= e($data['jabatan']); ?>"
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
                            value="<?= e($data['no_hp']); ?>"
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
                        ><?= e($data['alamat']); ?></textarea>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Update
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
