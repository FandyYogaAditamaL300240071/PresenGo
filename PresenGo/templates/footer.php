    <?php if (isset($_SESSION['id_user'])) : ?>

    <div
        class="modal fade"
        id="logoutModal"
        tabindex="-1"
        aria-labelledby="logoutModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content logout-modal">
                <div class="modal-body">
                    <div class="logout-icon">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>

                    <h4 id="logoutModalLabel">
                        Keluar dari PresenGo?
                    </h4>

                    <p>
                        Sesi Anda akan diakhiri dan Anda perlu
                        login kembali untuk mengakses aplikasi.
                    </p>

                    <div class="logout-actions">
                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Tetap di sini
                        </button>

                        <a
                            href="<?= $base_url; ?>proses/logout.php"
                            class="btn btn-danger"
                        >
                            <i class="bi bi-box-arrow-right"></i>
                            Ya, Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="modal fade"
        id="deleteConfirmModal"
        tabindex="-1"
        aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content logout-modal">
                <div class="modal-body">
                    <div class="logout-icon">
                        <i class="bi bi-trash"></i>
                    </div>

                    <h4 id="deleteConfirmModalLabel">
                        Hapus data ini?
                    </h4>

                    <p>
                        Data yang sudah dihapus tidak dapat
                        dikembalikan.
                    </p>

                    <div class="logout-actions">
                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>

                        <a
                            href="#"
                            id="deleteConfirmButton"
                            class="btn btn-danger"
                        >
                            <i class="bi bi-trash"></i>
                            Ya, Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

    <!-- Footer -->

    <div class="footer">
        <p>
            &copy; <?= date('Y'); ?>
            PresenGo | Sistem Presensi Karyawan
        </p>
    </div>

    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- Javascript -->

    <script
        src="<?= $base_url; ?>assets/js/script.js?v=<?= filemtime(__DIR__ . '/../assets/js/script.js'); ?>">
    </script>

</body>
</html>
