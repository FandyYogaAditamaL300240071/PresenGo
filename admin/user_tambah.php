<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil Data Karyawan
$karyawan = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     ORDER BY nama_karyawan ASC"
);

// Proses Tambah Akun
if(isset($_POST['simpan']))
{
    $username = mysqli_real_escape_string(
        $koneksi,
        $_POST['username']
    );
    $password = mysqli_real_escape_string(
        $koneksi,
        $_POST['password']
    );
    $role = mysqli_real_escape_string(
        $koneksi,
        $_POST['role']
    );
    $id_karyawan = $_POST['id_karyawan'] ?? NULL;

    // Cek Username
    $cek = mysqli_query(
        $koneksi,
        "SELECT *
         FROM users
         WHERE username = '$username'"
    );
    if(mysqli_num_rows($cek) > 0)
    {
        echo "
        <script>
            alert('Username sudah digunakan!');
            window.history.back();
        </script>
        ";
        exit;
    }

    // Simpan Data
    $simpan = mysqli_query(
        $koneksi,
        "INSERT INTO users
        (
            username,
            password,
            role,
            id_karyawan
        )
        VALUES
        (
            '$username',
            '$password',
            '$role',
            " . ($id_karyawan ? "'$id_karyawan'" : "NULL") . "
        )"
    );

    if($simpan)
    {
        header("Location: user.php?pesan=tambah");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun - PresenGo</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- CSS -->
    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >
</head>
<body>
<div class="container">

    <!-- Tombol Back -->
    <a
        href="user.php"
        class="btn btn-secondary back-btn"
    >
        ← Back
    </a>
    <div class="card">
        <div class="card-header">
            Tambah Data Akun
        </div>
        <div class="card-body">

            <!-- Form Tambah Akun -->
            <form method="POST">

                <!-- Username -->
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

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">
                        Password
                    </label>
                    <input
                        type="text"
                        name="password"
                        class="form-control"
                        required
                    >
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label class="form-label">
                        Role
                    </label>
                    <select
                        name="role"
                        class="form-select"
                        required
                    >
                        <option value="">
                            -- Pilih Role --
                        </option>
                        <option value="admin">
                            Admin
                        </option>
                        <option value="divisi">
                            Kepala Divisi
                        </option>
                        <option value="karyawan">
                            Karyawan
                        </option>
                    </select>
                </div>

                <!-- Karyawan -->
                <div class="mb-3">
                    <label class="form-label">
                        Karyawan
                    </label>
                    <select
                        name="id_karyawan"
                        class="form-select"
                    >
                        <option value="">
                            -- Pilih Karyawan --
                        </option>
                        <?php while($data = mysqli_fetch_assoc($karyawan)) : ?>

                            <option value="<?= $data['id_karyawan']; ?>">
                                <?= $data['nama_karyawan']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Tombol Simpan -->
                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary"
                >
                    Simpan
                </button>
                <a
                    href="user.php"
                    class="btn btn-danger"
                >
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>
</body>
</html>