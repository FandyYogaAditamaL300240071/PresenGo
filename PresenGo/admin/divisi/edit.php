<?php

require_once '../../config/koneksi.php';
require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

// CEK ID

if (!isset($_GET['id']))
{
    header("Location: index.php");
    exit;
}

$id_divisi = (int) $_GET['id'];

// AMBIL DATA DIVISI

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM divisi
     WHERE id_divisi = $id_divisi"
);

if (mysqli_num_rows($query) == 0)
{
    header("Location: index.php");
    exit;
}

$data = mysqli_fetch_assoc($query);

$title = "Edit Divisi";
$base_url = "../../";
$menu = "divisi";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Edit Divisi</h4>

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

                Form Edit Divisi

            </div>

            <div class="card-body">

                <form
                    action="../../proses/divisi_update.php"
                    method="POST"
                >

                    <input
                        type="hidden"
                        name="id_divisi"
                        value="<?= $data['id_divisi']; ?>"
                    >

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Divisi

                        </label>

                        <input
                            type="text"
                            name="nama_divisi"
                            class="form-control"
                            value="<?= e($data['nama_divisi']); ?>"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Deskripsi

                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="4"
                        ><?= e($data['deskripsi']); ?></textarea>

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
