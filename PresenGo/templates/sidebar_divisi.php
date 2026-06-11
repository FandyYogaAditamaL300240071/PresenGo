<div class="sidebar">

    <h3>PresenGo</h3>

    <a
        href="<?= $base_url; ?>divisi/dashboard.php"
        class="<?= $menu == 'dashboard' ? 'active' : ''; ?>"
    >
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a
        href="<?= $base_url; ?>divisi/karyawan/index.php"
        class="<?= $menu == 'karyawan' ? 'active' : ''; ?>"
    >
        <i class="bi bi-people"></i>
        Data Karyawan
    </a>

    <a
        href="<?= $base_url; ?>divisi/presensi/index.php"
        class="<?= $menu == 'presensi' ? 'active' : ''; ?>"
    >
        <i class="bi bi-calendar-check"></i>
        Presensi
    </a>

    <a
        href="<?= $base_url; ?>divisi/laporan/index.php"
        class="<?= $menu == 'laporan' ? 'active' : ''; ?>"
    >
        <i class="bi bi-bar-chart"></i>
        Monitoring
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
