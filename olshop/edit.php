<?php
include "koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id");
$p = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $deskripsi = $_POST['deskripsi'];
  $stok = $_POST['stok'];

  // Jika gambar diganti
  if ($_FILES['gambar']['name'] != "") {
    $filename = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $filename);
  } else {
    $filename = $p['gambar'];
  }

  mysqli_query($koneksi, "UPDATE produk SET
            nama='$nama',
            harga='$harga',
            deskripsi='$deskripsi',
            stok='$stok',
            gambar='$filename'
        WHERE id=$id");

  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Edit Produk</title>
</head>

<body class="bg-gray-100 p-6">

  <div class="max-w-xl mx-auto bg-white shadow p-6 rounded-2xl">
    <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

    <form method="POST" enctype="multipart/form-data" class="space-y-4">

      <div>
        <label class="font-semibold">Nama Produk</label>
        <input type="text" name="nama" value="<?= $p['nama']; ?>" required class="w-full border p-2 rounded-lg">
      </div>

      <div>
        <label class="font-semibold">Harga</label>
        <input type="number" name="harga" value="<?= $p['harga']; ?>" required class="w-full border p-2 rounded-lg">
      </div>

      <div>
        <label class="font-semibold">Deskripsi</label>
        <textarea name="deskripsi" required class="w-full border p-2 rounded-lg"><?= $p['deskripsi']; ?></textarea>
      </div>

      <div>
        <label class="font-semibold">Stok</label>
        <input type="number" name="stok" value="<?= $p['stok']; ?>" required class="w-full border p-2 rounded-lg">
      </div>

      <div>
        <label class="font-semibold">Gambar</label>
        <input type="file" name="gambar" class="w-full border p-2 rounded-lg">

        <p class="text-sm mt-1">Gambar sekarang:</p>
        <img src="uploads/<?= $p['gambar']; ?>" class="w-24 rounded mt-1">
      </div>

      <button name="submit" class="w-full bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600">
        Update
      </button>

      <a href="index.php" class="block text-center mt-2 text-blue-600">Kembali</a>

    </form>
  </div>

</body>

</html>