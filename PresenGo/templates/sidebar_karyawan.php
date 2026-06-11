<div class="sidebar">

    <h3>PresenGo</h3>

    <a
        href="<?= $base_url; ?>karyawan/dashboard.php"
        class="<?= $menu == 'dashboard' ? 'active' : ''; ?>"
    >
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a
        href="<?= $base_url; ?>karyawan/presensi/input.php"
        class="<?= $menu == 'input_presensi' ? 'active' : ''; ?>"
    >
        <i class="bi bi-calendar-plus"></i>
        Input Presensi
    </a>

    <a
        href="<?= $base_url; ?>karyawan/presensi/riwayat.php"
        class="<?= $menu == 'riwayat_presensi' ? 'active' : ''; ?>"
    >
        <i class="bi bi-clock-history"></i>
        Riwayat Presensi
    </a>

    <a
        href="<?= $base_url; ?>karyawan/profil/index.php"
        class="<?= $menu == 'profil' ? 'active' : ''; ?>"
    >
        <i class="bi bi-person-circle"></i>
        Profil Saya
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
