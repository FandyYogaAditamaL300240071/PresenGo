<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekKaryawan();

$id_karyawan = (int)
$_SESSION['id_karyawan'];

$tanggal_hari_ini =
date('Y-m-d');

// CEK SUDAH PRESENSI HARI INI

$cek = mysqli_query(
    $koneksi,
    "SELECT *
     FROM presensi
     WHERE id_karyawan = $id_karyawan
     AND tanggal = '$tanggal_hari_ini'"
);

$sudah_presensi =
mysqli_num_rows($cek) > 0;

$title = "Input Presensi";
$base_url = "../../";
$menu = "presensi";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php
    require_once
    '../../templates/sidebar_karyawan.php';
    ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>
                Input Presensi
            </h4>

        </div>

        <?php if($sudah_presensi) : ?>

        <div
            class="alert alert-success mt-4"
        >

            Anda sudah melakukan
            presensi hari ini.

        </div>

        <?php else : ?>

        <!-- FORM -->

        <div class="card mt-4">

            <div class="card-header">

                Presensi Hari Ini

            </div>

            <div class="card-body">

                <form
                    action="../../proses/presensi_simpan.php"
                    method="POST"
                >

                    <input
                        type="hidden"
                        name="id_karyawan"
                        value="<?= $id_karyawan; ?>"
                    >

                    <div class="mb-3">

                        <label class="form-label">

                            Tanggal

                        </label>

                        <input
                            type="date"
                            class="form-control"
                            value="<?= $tanggal_hari_ini; ?>"
                            readonly
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
                        Simpan Presensi
                    </button>

                </form>

            </div>

        </div>

        <?php endif; ?>

    </div>

</div>

<?php

require_once
'../../templates/footer.php';

?>
