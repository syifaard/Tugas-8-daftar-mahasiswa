<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM mahasiswa ORDER BY id DESC"
);

if (!$query) {
    die("Gagal mengambil data mahasiswa: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background-color: #f3f6fb;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #123b63;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .navbar-brand:hover {
            color: #dbeafe;
        }

        .main-container {
            max-width: 1250px;
            margin: 45px auto;
        }

        .content-card {
            background-color: white;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        }

        .page-title {
            color: #123b63;
            font-weight: 700;
        }

        .page-description {
            color: #6b7280;
        }

        .table thead th {
            background-color: #123b63;
            color: white;
            font-weight: 600;
            padding: 14px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 13px;
            vertical-align: middle;
        }

        .table tbody tr:hover td {
            background-color: #f0f6ff;
        }

        .badge-jurusan {
            background-color: #e0efff;
            color: #174b7a;
            font-weight: 600;
            white-space: normal;
            text-align: left;
        }

        .btn-tambah {
            background-color: #1769aa;
            color: white;
            border-radius: 8px;
            padding: 10px 17px;
        }

        .btn-tambah:hover {
            background-color: #0e4f85;
            color: white;
        }

        .footer-text {
            color: #8993a1;
            font-size: 13px;
        }

        @media (max-width: 576px) {
            .main-container {
                margin: 24px auto;
            }

            .content-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-decoration-none" href="index.php">
                DATA MAHASISWA
            </a>
        </div>
    </nav>

    <!-- Konten utama -->
    <div class="container main-container">
        <div class="content-card">

            <!-- Judul dan tombol tambah -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

                <div>
                    <h2 class="page-title mb-2">
                        Daftar Data Mahasiswa
                    </h2>

                    <p class="page-description mb-0">
                        Informasi mahasiswa yang tersimpan dalam database.
                    </p>
                </div>

                <a href="insert.php" class="btn btn-tambah">
                    + Tambah Mahasiswa
                </a>

            </div>

            <!-- Tabel mahasiswa -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">

                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th>Alamat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        if (mysqli_num_rows($query) > 0) {
                            while ($data = mysqli_fetch_assoc($query)) {
                        ?>

                            <tr>
                                <td class="text-center">
                                    <?= $no++; ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($data['nim']); ?>
                                </td>

                                <td class="fw-semibold">
                                    <?= htmlspecialchars($data['nama']); ?>
                                </td>

                                <td>
                                    <span class="badge badge-jurusan rounded-pill px-3 py-2">
                                        <?= htmlspecialchars($data['jurusan']); ?>
                                    </span>
                                </td>

                                <td>
                                    <?= htmlspecialchars($data['alamat']); ?>
                                </td>

                                <!-- Tombol Edit dan Hapus -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="update.php?id=<?= (int) $data['id']; ?>"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="delete.php"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?');">

                                            <input type="hidden"
                                                   name="id"
                                                   value="<?= (int) $data['id']; ?>">

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>

                        <?php
                            }
                        } else {
                        ?>

                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p class="fw-semibold mb-1">
                                        Belum ada data mahasiswa
                                    </p>

                                    <span class="text-secondary">
                                        Klik tombol Tambah Mahasiswa untuk memasukkan data baru.
                                    </span>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>

                </table>
            </div>

            <!-- Footer -->
            <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mt-3">

                <span class="footer-text">
                    Sistem Informasi Data Mahasiswa
                </span>

                <span class="footer-text">
                    Total data: <?= mysqli_num_rows($query); ?> mahasiswa
                </span>

            </div>

        </div>
    </div>

</body>
</html>