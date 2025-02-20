<?php
include "petshop.php";

// Handle tambah produk
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['tambah'])) {
    $nama = $_POST['namaProduk'];
    $kategori = $_POST['kategoriProduk'];
    $harga = $_POST['hargaProduk'];

    // Upload gambar
    $gambar = uploadImage($_FILES['gambar']);

    tambahProduk($nama, $kategori, $harga, $gambar);
    header("Location: index.php?message=Produk berhasil ditambahkan");
}

// Handle edit produk
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['idProduk'];
    $nama = $_POST['namaProduk'];
    $kategori = $_POST['kategoriProduk'];
    $harga = $_POST['hargaProduk'];

    // Upload gambar
    $gambar = null;
    if ($_FILES['gambar']['name']) {
        $gambar = uploadImage($_FILES['gambar']);
    }

    editProduk($id, $nama, $kategori, $harga, $gambar);
    header("Location: index.php?message=Produk berhasil diubah");
}

// Handle hapus produk
if (isset($_GET['hapus'])) {
    hapusProduk($_GET['hapus']);
    header("Location: index.php?message=Produk berhasil dihapus");
}

// Handle search produk
$searchQuery = "";
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $produkList = searchProduk($searchQuery);
} else {
    $produkList = getProdukList();
}

$message = "";
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petshop Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .crud-section, .search-section {
            display: inline-block;
            vertical-align: top;
        }
        .crud-section {
            width: 30%;
        }
        .search-section {
            width: 65%;
        }
        .table img {
            height: 100px; /* Enlarge images in the table */
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .btn-primary, .btn-success, .btn-warning, .btn-danger {
            margin-right: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Petshop Management</h2>

        <?php if ($message): ?>
            <div class="alert alert-success" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>
        
        <div class="d-flex justify-content-between mb-3">
            <!-- Tombol Tambah Produk -->
            <div class="crud-section">
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk</button>
            </div>

            <!-- Form Pencarian Produk -->
            <div class="search-section">
                <form method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari Produk" aria-label="Search" value="<?= $searchQuery ?>">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>

        <!-- Tabel Produk -->
        <div class="table-section mb-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produkList as $index => $produk) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= $produk->namaProduk ?></td>
                            <td><?= $produk->kategoriProduk ?></td>
                            <td>Rp <?= number_format($produk->hargaProduk, 0, ',', '.') ?></td>
                            <td><img src="<?= $produk->gambar ?>" alt="<?= $produk->namaProduk ?>"></td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit" onclick="fillEditForm(<?= $produk->id ?>, '<?= $produk->namaProduk ?>', '<?= $produk->kategoriProduk ?>', <?= $produk->hargaProduk ?>)">Edit</button>
                                <a href="?hapus=<?= $produk->id ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah Produk -->
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="namaProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" class="form-control" name="kategoriProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" name="hargaProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Produk -->
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="idProduk" id="editIdProduk">
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="namaProduk" id="editNamaProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" class="form-control" name="kategoriProduk" id="editKategoriProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" name="hargaProduk" id="editHargaProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <button type="submit" name="edit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fillEditForm(id, nama, kategori, harga) {
            document.getElementById('editIdProduk').value = id;
            document.getElementById('editNamaProduk').value = nama;
            document.getElementById('editKategoriProduk').value = kategori;
            document.getElementById('editHargaProduk').value = harga;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
