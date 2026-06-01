<?php

// Memanggil Koneksi dan Auth
require_once '../config/koneksi.php';
require_once '../config/auth.php';

// Cek Hak Akses Admin
cekAdmin();

// Mengambil ID User
$id = $_GET['id'] ?? 0;

// Mengambil Data User
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users
     WHERE id_user = '$id'"
);
$user = mysqli_fetch_assoc($query);

// Jika Data Tidak Ditemukan
if(!$user)
{
    header("Location: user.php");
    exit;
}

// Mengambil Data Karyawan
$karyawan = mysqli_query(
    $koneksi,
    "SELECT *
     FROM karyawan
     ORDER BY nama_karyawan ASC"
);

// Proses Edit Data
if(isset($_POST['update']))
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

    // Cek Username Duplikat
    $cek = mysqli_query(
        $koneksi,
        "SELECT *
         FROM users
         WHERE username = '$username'
         AND id_user != '$id'"
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

    // Update Data
    $update = mysqli_query(
        $koneksi,
        "UPDATE users
         SET
            username = '$username',
            password = '$password',
            role = '$role',
            id_karyawan = " . ($id_karyawan ? "'$id_karyawan'" : "NULL") . "
         WHERE id_user = '$id'"
    );
    if($update)
    {
        header("Location: user.php?pesan=edit");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun - PresenGo</title>

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
            Edit Data Akun
        </div>
        <div class="card-body">

            <!-- Form Edit Akun -->
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
                        value="<?= $user['username']; ?>"
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
                        value="<?= $user['password']; ?>"
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
                        <option
                            value="admin"
                            <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>
                        >
                            Admin
                        </option>
                        <option
                            value="divisi"
                            <?= ($user['role'] == 'divisi') ? 'selected' : ''; ?>
                        >
                            Kepala Divisi
                        </option>
                        <option
                            value="karyawan"
                            <?= ($user['role'] == 'karyawan') ? 'selected' : ''; ?>
                        >
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
                            <option
                                value="<?= $data['id_karyawan']; ?>"
                                <?= ($user['id_karyawan'] == $data['id_karyawan']) ? 'selected' : ''; ?>
                            >
                                <?= $data['nama_karyawan']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Tombol Update -->
                <button
                    type="submit"
                    name="update"
                    class="btn btn-warning"
                >
                    Update
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