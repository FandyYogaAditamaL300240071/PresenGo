<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekDivisi();

// CEK ID PRESENSI

if (!isset($_GET['id']))
{
    header(
        "Location: index.php"
    );

    exit;
}

$id_presensi = (int)
$_GET['id'];

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

// AMBIL DATA PRESENSI

$query = mysqli_query(
    $koneksi,
    "SELECT
        p.*,
        k.nama_karyawan,
        k.id_divisi
     FROM presensi p
     JOIN karyawan k
        ON p.id_karyawan = k.id_karyawan
     WHERE p.id_presensi = $id_presensi
     AND k.id_divisi = $id_divisi"
);

if (mysqli_num_rows($query) == 0)
{
    header(
        "Location: index.php"
    );

    exit;
}

$data =
mysqli_fetch_assoc($query);

$title = "Edit Presensi";
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
                Edit Presensi
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

                Form Edit Presensi

            </div>

            <div class="card-body">

                <form
                    action="../../proses/presensi_update.php"
                    method="POST"
                >

                    <input
                        type="hidden"
                        name="id_presensi"
                        value="<?= $data['id_presensi']; ?>"
                    >

                    <div class="mb-3">

                        <label class="form-label">

                            Karyawan

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= e($data['nama_karyawan']); ?>"
                            readonly
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Tanggal

                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            value="<?= $data['tanggal']; ?>"
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
                            value="<?= $data['jam_masuk']; ?>"
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

                            <option
                                value="Hadir"
                                <?= $data['status'] == 'Hadir' ? 'selected' : ''; ?>
                            >
                                Hadir
                            </option>

                            <option
                                value="Izin"
                                <?= $data['status'] == 'Izin' ? 'selected' : ''; ?>
                            >
                                Izin
                            </option>

                            <option
                                value="Sakit"
                                <?= $data['status'] == 'Sakit' ? 'selected' : ''; ?>
                            >
                                Sakit
                            </option>

                            <option
                                value="Alpha"
                                <?= $data['status'] == 'Alpha' ? 'selected' : ''; ?>
                            >
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
                        ><?= e($data['keterangan']); ?></textarea>

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
