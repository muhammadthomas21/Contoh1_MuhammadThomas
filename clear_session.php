<?php
session_start();

// Hapus data pendaftaran dari session
if (isset($_SESSION['pendaftaran'])) {
    unset($_SESSION['pendaftaran']);
}

// Redirect kembali ke halaman utama
header('Location: index.php');
exit;
?>