<?php

// Memulai Session
session_start();

// Menghapus Semua Session
session_unset();

// Menghancurkan Session
session_destroy();

// Kembali ke Halaman Login
header("Location: ../index.php?pesan=logout");
exit;

?>