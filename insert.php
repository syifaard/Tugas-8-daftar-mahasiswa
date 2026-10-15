<?php
include 'koneksi.php';

$query_jurusan = mysqli_query(
    $koneksi,
    "SELECT id_jurusan, nama_jurusan
     FROM jurusan
     ORDER BY nama_jurusan ASC"
);

if (!$query_jurusan) {
    die("Gagal mengambil data jurusan: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background-color: #f3f6fb;
            font-family: Arial, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background-color: #123b63;
            padding: 16px 0;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .navbar-brand:hover {
            color: #dbeafe;
        }

        .form-container {
            max-width: 750px;
            margin: 45px auto;
        }

        .form-card {
            background-color: white;
            padding: 32px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        }

        .page-title {
            color: #123b63;
            font-weight: 700;
        }

        .form-label {
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            padding: 11px 12px;
            border: 1px solid #d5dce5;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #1769aa;
            box-shadow: 0 0 0 0.2rem rgba(23, 105, 170, 0.15);
        }

        .btn-simpan {
            background-color: #1769aa;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }

        .btn-simpan:hover {
            background-color: #0e4f85;
            color: white;
        }

        .btn-reset {
            border-radius: 8px;
            padding: 10px 20px;
        }

        .btn-kembali {
            color: #1769aa;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-kembali:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .form-container {
                margin: 24px auto;
            }

            .form-card {
                padding: 22px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand text-decoration-none" href="index.php">
                DATA MAHASISWA
            </a>
        </div>
    </nav>

    <div class="container form-container">
        <div class="form-card">

            <a href="index.php" class="btn-kembali">
                &larr; Kembali ke Daftar Data
            </a>

            <div class="mt-4 mb-4">
                <h2 class="page-title">Tambah Data Mahasiswa</h2>
                <p class="text-secondary mb-0">
                    Silakan lengkapi formulir berikut dengan benar.
                </p>
            </div>

            <form action="proses.php?aksi=tambah" method="POST">

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control"
                           id="nim" name="nim"
                           placeholder="Masukkan NIM" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control"
                           id="nama" name="nama"
                           placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>

                    <select class="form-select" id="jurusan"
                            name="id_jurusan" required>

                        <option value="">-- Pilih Jurusan --</option>

                        <?php while ($jurusan = mysqli_fetch_assoc($query_jurusan)) { ?>
                            <option value="<?= (int) $jurusan['id_jurusan']; ?>">
                                <?= htmlspecialchars($jurusan['nama_jurusan']); ?>
                            </option>
                        <?php } ?>

                    </select>
                </div>

                <div class="mb-4">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat"
                              name="alamat" rows="4"
                              placeholder="Masukkan alamat lengkap"
                              required></textarea>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" name="submit"
                            class="btn btn-simpan">
                        Simpan Data
                    </button>

                    <button type="reset"
                            class="btn btn-outline-secondary btn-reset">
                        Reset
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>