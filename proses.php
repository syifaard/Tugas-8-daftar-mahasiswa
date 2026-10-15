<?php
include 'koneksi.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($aksi == 'tambah') {

    $nim = mysqli_real_escape_string(
        $koneksi, $_POST['nim']
    );

    $nama = mysqli_real_escape_string(
        $koneksi, $_POST['nama']
    );

    $alamat = mysqli_real_escape_string(
        $koneksi, $_POST['alamat']
    );

    $id_jurusan = isset($_POST['id_jurusan'])
        ? (int) $_POST['id_jurusan']
        : 0;

    // Periksa apakah jurusan tersedia
    $cek_jurusan = mysqli_query(
        $koneksi,
        "SELECT nama_jurusan FROM jurusan
         WHERE id_jurusan = $id_jurusan"
    );

    if (!$cek_jurusan || mysqli_num_rows($cek_jurusan) == 0) {
        die("Jurusan tidak ditemukan. Silakan kembali dan pilih jurusan.");
    }

    $data_jurusan = mysqli_fetch_assoc($cek_jurusan);

    $jurusan = mysqli_real_escape_string(
        $koneksi, $data_jurusan['nama_jurusan']
    );

    // Simpan data mahasiswa
    $query = mysqli_query(
        $koneksi,
        "INSERT INTO mahasiswa
        (nim, nama, jurusan, id_jurusan, alamat)
        VALUES
        ('$nim', '$nama', '$jurusan', $id_jurusan, '$alamat')"
    );

    if ($query) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambahkan data: "
             . mysqli_error($koneksi);
    }

} elseif ($aksi == 'update') {

    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    $nim = mysqli_real_escape_string(
        $koneksi, $_POST['nim']
    );

    $nama = mysqli_real_escape_string(
        $koneksi, $_POST['nama']
    );

    $alamat = mysqli_real_escape_string(
        $koneksi, $_POST['alamat']
    );

    $id_jurusan = isset($_POST['id_jurusan'])
        ? (int) $_POST['id_jurusan']
        : 0;

    if ($id <= 0) {
        die("ID mahasiswa tidak valid.");
    }

    // Periksa apakah mahasiswa tersedia
    $cek_mahasiswa = mysqli_query(
        $koneksi,
        "SELECT id FROM mahasiswa WHERE id = $id"
    );

    if (!$cek_mahasiswa || mysqli_num_rows($cek_mahasiswa) == 0) {
        die("Data mahasiswa tidak ditemukan.");
    }

    // Periksa apakah jurusan tersedia
    $cek_jurusan = mysqli_query(
        $koneksi,
        "SELECT nama_jurusan FROM jurusan
         WHERE id_jurusan = $id_jurusan"
    );

    if (!$cek_jurusan || mysqli_num_rows($cek_jurusan) == 0) {
        die("Jurusan tidak ditemukan. Silakan kembali dan pilih jurusan.");
    }

    $data_jurusan = mysqli_fetch_assoc($cek_jurusan);

    $jurusan = mysqli_real_escape_string(
        $koneksi, $data_jurusan['nama_jurusan']
    );

    // Perbarui data mahasiswa
    $query = mysqli_query(
        $koneksi,
        "UPDATE mahasiswa SET
            nim = '$nim',
            nama = '$nama',
            jurusan = '$jurusan',
            id_jurusan = $id_jurusan,
            alamat = '$alamat'
         WHERE id = $id"
    );

    if ($query) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal memperbarui data: "
             . mysqli_error($koneksi);
    }

} else {
    header("Location: index.php");
    exit();
}
?>