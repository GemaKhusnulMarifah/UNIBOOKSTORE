<?php
include 'db.php'; // Koneksi ke database

// Periksa apakah id_buku atau id_penerbit diberikan sebagai parameter
if (isset($_GET['id_buku'])) {
    // Hapus buku berdasarkan ID buku
    $id_buku = $_GET['id_buku'];
    $sql = "DELETE FROM buku WHERE id_buku = '$id_buku'";
    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('Buku berhasil dihapus!'); window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Error menghapus buku: " . $connection->error . "');</script>";
    }
} elseif (isset($_GET['id_penerbit'])) {
    // Hapus penerbit berdasarkan ID penerbit
    $id_penerbit = $_GET['id_penerbit'];
    $sql = "DELETE FROM penerbit WHERE id_penerbit = '$id_penerbit'";
    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('Penerbit berhasil dihapus!'); window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Error menghapus penerbit: " . $connection->error . "');</script>";
    }
} else {
#    echo "<script>alert('ID tidak valid.'); window.location.href = 'admin.php';</script>";
}
?>