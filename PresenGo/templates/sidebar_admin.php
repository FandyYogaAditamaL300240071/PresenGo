<div class="sidebar">

    <h3>PresenGo</h3>

    <a
        href="<?= $base_url; ?>admin/dashboard.php"
        class="<?= $menu == 'dashboard' ? 'active' : ''; ?>"
    >
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a
        href="<?= $base_url; ?>admin/divisi/index.php"
        class="<?= $menu == 'divisi' ? 'active' : ''; ?>"
    >
        <i class="bi bi-building"></i>
        Data Divisi
    </a>

    <a
        href="<?= $base_url; ?>admin/karyawan/index.php"
        class="<?= $menu == 'karyawan' ? 'active' : ''; ?>"
    >
        <i class="bi bi-people"></i>
        Data Karyawan
    </a>

    <a
        href="<?= $base_url; ?>admin/akun/index.php"
        class="<?= $menu == 'akun' ? 'active' : ''; ?>"
    >
        <i class="bi bi-person-circle"></i>
        Data Akun
    </a>

    <a
        href="<?= $base_url; ?>admin/presensi/index.php"
        class="<?= $menu == 'presensi' ? 'active' : ''; ?>"
    >
        <i class="bi bi-calendar-check"></i>
        Monitoring Presensi
    </a>

    <a
        href="#"
        data-bs-toggle="modal"
        data-bs-target="#logoutModal"
    >
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </a>

</div>
