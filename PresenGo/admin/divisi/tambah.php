<?php

require_once '../../config/auth.php';
require_once '../../config/helper.php';

cekAdmin();

$title = "Tambah Divisi";
$base_url = "../../";
$menu = "divisi";

require_once '../../templates/header.php';

?>

<div class="wrapper">

    <?php require_once '../../templates/sidebar_admin.php'; ?>

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <h4>Tambah Divisi</h4>

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

                Form Tambah Divisi

            </div>

            <div class="card-body">

                <form
                    action="../../proses/divisi_simpan.php"
                    method="POST"
                >

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Divisi

                        </label>

                        <input
                            type="text"
                            name="nama_divisi"
                            class="form-control"
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
