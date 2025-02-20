<?php
class Petshop {
    public $id;
    public $namaProduk;
    public $kategoriProduk;
    public $hargaProduk;
    public $gambar;

    function __construct($id, $namaProduk, $kategoriProduk, $hargaProduk, $gambar) {
        $this->id = $id;
        $this->namaProduk = $namaProduk;
        $this->kategoriProduk = $kategoriProduk;
        $this->hargaProduk = $hargaProduk;
        $this->gambar = $gambar;
    }
}

// Simpan data ke sesi agar CRUD bisa berjalan tanpa database
session_start();
if (!isset($_SESSION['produkList'])) {
    $_SESSION['produkList'] = [
        new Petshop(1, "Makanan Kucing", "Makanan", 50000, "img/cat_food.jpg"),
        new Petshop(2, "Mainan Anjing", "Mainan", 75000, "img/dog_toy.jpg"),
        new Petshop(3, "Shampoo Hewan", "Perawatan", 45000, "img/pet_shampoo.jpg"),
    ];
}

// Fungsi mendapatkan daftar produk
function getProdukList() {
    return $_SESSION['produkList'];
}

// Fungsi tambah produk baru
function tambahProduk($nama, $kategori, $harga, $gambar) {
    $produkList = $_SESSION['produkList'];
    $idBaru = count($produkList) + 1;
    $produkBaru = new Petshop($idBaru, $nama, $kategori, $harga, $gambar);
    array_push($produkList, $produkBaru);
    $_SESSION['produkList'] = $produkList;
}

// Fungsi edit produk
function editProduk($id, $nama, $kategori, $harga, $gambar) {
    $produkList = $_SESSION['produkList'];
    foreach ($produkList as &$produk) {
        if ($produk->id == $id) {
            $produk->namaProduk = $nama;
            $produk->kategoriProduk = $kategori;
            $produk->hargaProduk = $harga;
            if ($gambar) {
                $produk->gambar = $gambar;
            }
            break;
        }
    }
    $_SESSION['produkList'] = $produkList;
}

// Fungsi hapus produk
function hapusProduk($id) {
    $_SESSION['produkList'] = array_filter($_SESSION['produkList'], function ($produk) use ($id) {
        return $produk->id != $id;
    });
}

// Fungsi mencari produk berdasarkan nama atau kategori
function searchProduk($query) {
    $produkList = $_SESSION['produkList'];
    $result = array_filter($produkList, function ($produk) use ($query) {
        return stripos($produk->namaProduk, $query) !== false || stripos($produk->kategoriProduk, $query) !== false;
    });
    return $result;
}

// Fungsi upload gambar
function uploadImage($file) {
    $targetDir = "img/";
    $targetFile = $targetDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return null;
}
?>
