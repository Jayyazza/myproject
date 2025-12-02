<?php include "koneksi.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $gambar);

    mysqli_query($koneksi, "INSERT INTO produk VALUES('', '$nama', '$harga', '$deskripsi', '$stok', '$gambar')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-10 max-w-xl bg-white p-8 rounded-xl shadow">

        <h2 class="text-2xl font-bold mb-5 text-blue-600">Tambah Produk</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-4">

            <div>
                <label class="block mb-1 font-medium">Nama Produk</label>
                <input type="text" name="nama" required
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
            </div>

            <div>
                <label class="block mb-1 font-medium">Harga</label>
                <input type="number" name="harga" required
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
            </div>

            <div>
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="deskripsi" required rows="4"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"></textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium">Stok</label>
                <input type="number" name="stok" required
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
            </div>

            <div>
                <label class="block mb-1 font-medium">Gambar Produk</label>
                <input type="file" name="gambar" required class="w-full p-3 border rounded-lg bg-white">
            </div>

            <button name="submit"
                class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                Simpan Produk
            </button>

        </form>

    </div>

</body>

</html>