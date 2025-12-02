<?php
include "koneksi.php";

$id = $_GET['id'];

// ambil gambar agar bisa dihapus
$get = mysqli_query($koneksi, "SELECT gambar FROM produk WHERE id=$id");
$data = mysqli_fetch_assoc($get);

// hapus file gambar
unlink("uploads/" . $data['gambar']);

mysqli_query($koneksi, "DELETE FROM produk WHERE id=$id");

header("Location: index.php");