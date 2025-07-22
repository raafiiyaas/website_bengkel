<?php
function countUsers() {
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users WHERE status='active'");
    $data = mysqli_fetch_assoc($query);
    return $data['total'];
}
?>