<?php
include "koneksi.php";

$cari = "";
if (isset($_GET['cari'])) {
    $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
}

if ($cari != "") {
    $query = "SELECT * FROM produk 
              WHERE nama LIKE '%$cari%' 
              OR deskripsi LIKE '%$cari%' 
              OR stok LIKE '%$cari%'
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM produk ORDER BY id DESC";
}

$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<p class='text-center col-span-4 text-gray-500'>Produk tidak ditemukan</p>";
    exit;
}

while ($p = mysqli_fetch_assoc($result)) {
    ?>
    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4">

        <img src="uploads/<?= $p['gambar']; ?>" class="rounded-xl mb-3 w-full h-40 object-cover">

        <h2 class="font-semibold text-lg"><?= $p['nama']; ?></h2>

        <p class="text-gray-500 text-sm mb-2">
            <?= strlen($p['deskripsi']) > 80
                ? substr($p['deskripsi'], 0, 80) . '...'
                : $p['deskripsi']; ?>
        </p>

        <p class="font-bold text-blue-600 mb-1">
            Rp <?= number_format($p['harga']); ?>
        </p>

        <p class="text-sm text-gray-700 mb-2">
            <span class="font-semibold">Stok:</span> <?= $p['stok']; ?>
        </p>

        <div class="flex gap-2 mt-3">
            <a href="edit.php?id=<?= $p['id']; ?>"
                class="flex-1 bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600 text-center">
                Edit
            </a>

            <a href="hapus.php?id=<?= $p['id']; ?>" onclick="return confirm('Yakin hapus?')"
                class="flex-1 bg-red-600 text-white p-2 rounded-lg hover:bg-red-700 text-center">
                Hapus
            </a>
        </div>

    </div>
<?php } ?>