<?php

session_start();

// JIKA SUDAH LOGIN

if (isset($_SESSION['role']))
{
    switch ($_SESSION['role'])
    {
        case 'admin':
            header('Location: admin/dashboard.php');
            exit;

        case 'kepala_divisi':
            header('Location: divisi/dashboard.php');
            exit;

        case 'karyawan':
            header('Location: karyawan/dashboard.php');
            exit;
    }
}

$title = "Login PresenGo";
$base_url = "";

require_once 'templates/header.php';

?>

<div class="login-page">

    <!-- PANEL KIRI -->

    <div class="login-left">

        <div class="login-content">

            <h1>PresenGo</h1>

            <p>
                Sistem Presensi Karyawan Berbasis Web
            </p>

            <hr>

            <p>
                Kelola data karyawan, akun, dan presensi
                dengan lebih mudah, cepat, dan terstruktur.
            </p>

        </div>

    </div>

    <!-- PANEL KANAN -->

    <div class="login-right">

        <div class="login-box">

            <h2>Login</h2>

            <?php if(isset($_GET['error'])) : ?>

                <div class="alert alert-danger">

                    Username atau Password salah.

                </div>

            <?php endif; ?>

            <?php if(isset($_GET['logout'])) : ?>

                <div class="alert alert-success">

                    Logout berhasil.

                </div>

            <?php endif; ?>

            <form
                action="proses/login.php"
                method="POST"
            >

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

                <div class="d-grid">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Login
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php

require_once 'templates/footer.php';

?>
