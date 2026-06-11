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

$id_user = (int) $_GET['id'];

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
     WHERE u.id_user = $id_user"
);

if (mysqli_num_rows($query) == 0)
{
    header(
        "Location: index.php"
    );

    exit;
}

$data = mysqli_fetch_assoc($query);

$title = "Edit Akun";
$base_url = "../../";
$menu = "akun";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Edit Akun</h4>

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

                Form Edit Akun

            </div>

            <div class="card-body">

                <form
                    action="../../proses/akun_update.php"
                    method="POST"
                >

                    <input
                        type="hidden"
                        name="id_user"
                        value="<?= $data['id_user']; ?>"
                    >

                    <div class="mb-3">

                        <label class="form-label">

                            Karyawan

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= e($data['nama_karyawan'] ?? 'Administrator'); ?>"
                            readonly
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Username

                        </label>

                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            value="<?= e($data['username']); ?>"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Password Baru

                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                            >

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword('password')"
                            >
                                <i class="bi bi-eye"></i>
                            </button>

                        </div>

                        <small class="text-muted">

                            Kosongkan jika tidak ingin mengganti password.

                        </small>

                    </div>

                    <?php if($data['role'] != 'admin') : ?>

                    <div class="mb-3">

                        <label class="form-label">

                            Role

                        </label>

                        <select
                            name="role"
                            class="form-select"
                            required
                        >

                            <option
                                value="kepala_divisi"
                                <?= $data['role'] == 'kepala_divisi'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Kepala Divisi
                            </option>

                            <option
                                value="karyawan"
                                <?= $data['role'] == 'karyawan'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Karyawan
                            </option>

                        </select>

                    </div>

                    <?php endif; ?>

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
