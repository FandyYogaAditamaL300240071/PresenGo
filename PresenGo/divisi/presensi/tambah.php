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

// AMBIL KARYAWAN DIVISI

$karyawan = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     WHERE id_divisi = $id_divisi
     ORDER BY nama_karyawan ASC"
);

$title = "Tambah Presensi";
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
                Tambah Presensi
            </h4>

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>

        <!-- FORM -->

        <div class="card mt-4">

            <div class="card-header">

                Form Tambah Presensi

            </div>

            <div class="card-body">

                <form
                    action="../../proses/presensi_simpan.php"
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
                                mysqli_fetch_assoc(
                                    $karyawan
                                )
                            ) :
                            ?>

                            <option
                                value="<?= $k['id_karyawan']; ?>"
                            >

                                <?= e(
                                    $k['kode_karyawan']
                                ); ?>
                                -
                                <?= e(
                                    $k['nama_karyawan']
                                ); ?>

                            </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Tanggal

                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            value="<?= date('Y-m-d'); ?>"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Jam Masuk

                        </label>

                        <input
                            type="time"
                            name="jam_masuk"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >

                            <option value="Hadir">
                                Hadir
                            </option>

                            <option value="Izin">
                                Izin
                            </option>

                            <option value="Sakit">
                                Sakit
                            </option>

                            <option value="Alpha">
                                Alpha
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Keterangan

                        </label>

                        <textarea
                            name="keterangan"
                            class="form-control"
                            rows="3"
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

require_once
'../../templates/footer.php';

?>
