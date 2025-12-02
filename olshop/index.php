<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>Olshop Present</title>
</head>

<body class="bg-gray-100">

    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">OLSHOP</h1>

        <form class="flex justify-center">
            <input type="text" name="cari" placeholder="Cari produk…" class="border p-2 rounded-lg w-72 shadow-sm">
        </form>

        <a href="tambah.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Tambah Produk
        </a>
    </nav>

    <div id="produk-list" class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    </div>

    <script>
        $(document).ready(function () {

            loadProduk("");

            $("[name='cari']").on("keyup", function () {
                let keyword = $(this).val();
                loadProduk(keyword);
            });

            function loadProduk(keyword) {
                $.ajax({
                    url: "ajax_search.php",
                    type: "GET",
                    data: { cari: keyword },
                    success: function (res) {
                        $("#produk-list").html(res);
                    }
                });
            }

        });
    </script>

</body>

</html>