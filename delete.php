<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($id <= 0) {
        die("ID mahasiswa tidak valid.");
    }

    $query = mysqli_query(
        $koneksi,
        "DELETE FROM mahasiswa WHERE id = $id"
    );

    if ($query && mysqli_affected_rows($koneksi) > 0) {
        header("Location: index.php");
        exit();
    } elseif ($query) {
        die("Data mahasiswa tidak ditemukan.");
    } else {
        die("Gagal menghapus data: " . mysqli_error($koneksi));
    }

} else {
    header("Location: index.php");
    exit();
}
?>