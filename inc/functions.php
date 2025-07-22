<?php
function countUsers() {
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users WHERE status='active'");
    $data = mysqli_fetch_assoc($query);
    return $data['total'];
}

function countTodayTransactions() {
    global $koneksi;
    $today = date('Y-m-d');
    $q = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM transaksi WHERE DATE(tanggal_transaksi) = '$today'");
    $data = mysqli_fetch_assoc($q);
    return $data['total'];
}
?>
