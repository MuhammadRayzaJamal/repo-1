<?php
$konek = new mysqli('localhost', 'root', '', 'spksaw', 3306);
if ($konek->connect_errno) {
    // Saat ini ini cuma string, tidak dicetak atau dihentikan eksekusi
    echo "Database Error: " . $konek->connect_error;
    exit; // Hentikan eksekusi jika koneksi gagal
}
?>
