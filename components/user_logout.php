<?php
session_start();

// hapus semua session
session_unset();
session_destroy();

// hapus cookie kalau ada
if (isset($_COOKIE['id_pelanggan'])) {
    setcookie('id_pelanggan', '', time() - 3600, '/');
}

// arahkan ke HOME, bukan login
header('Location: /beautyclinic/index.php');
exit;
