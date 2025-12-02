<?php
include 'koneksi.php';

// Ambil semua data genre dari tabel anime_list
$result = mysqli_query($conn, "SELECT genre FROM anime_list");

// Bikin array kosong buat nyimpen semua genre unik
$genres = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Pisah genre yang dipisah koma jadi array
    $list = explode(',', $row['genre']);
    foreach ($list as $g) {
        $genre = trim($g); // hapus spasi
        if (!empty($genre) && !in_array($genre, $genres)) {
            $genres[] = $genre;
        }
    }
}

// Urutkan genre secara alfabet
sort($genres);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Genre Anime - Jaynime</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      color: white;
      text-align: center;
    }

    h1 {
      color: #00e5ff;
      text-shadow: 0 0 10px #00e5ff;
      margin-bottom: 30px;
    }

    .genre-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 20px;
      max-width: 900px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .genre-card {
      background: rgba(255, 255, 255, 0.08);
      padding: 18px;
      border-radius: 15px;
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 229, 255, 0.3);
    }

    .genre-card:hover {
      background: rgba(0, 229, 255, 0.15);
      transform: translateY(-5px);
      box-shadow: 0 0 12px rgba(0, 229, 255, 0.4);
    }

    .genre-card a {
      color: #00e5ff;
      font-weight: 600;
      text-decoration: none;
      letter-spacing: 0.5px;
    }

    .back-link {
      display: inline-block;
      margin-top: 50px;
      color: #00e5ff;
      text-decoration: none;
      font-weight: 600;
      background: rgba(255, 255, 255, 0.08);
      padding: 12px 20px;
      border-radius: 25px;
      border: 1px solid rgba(0, 229, 255, 0.3);
      transition: all 0.3s ease;
    }

    .back-link:hover {
      background: rgba(0, 229, 255, 0.15);
      box-shadow: 0 0 10px rgba(0, 229, 255, 0.5);
    }
  </style>
</head>
<?php include 'navbar.html'; ?>
<body>

<h1>🎭 Daftar Genre Anime</h1>

<div class="genre-container">
  <?php foreach ($genres as $g) : ?>
    <div class="genre-card">
      <a href="index.php?genre=<?= urlencode($g) ?>"><?= htmlspecialchars($g) ?></a>
    </div>
  <?php endforeach; ?>
</div>

<a href="index.php" class="back-link">⬅️ Kembali ke Beranda</a>
<?php include 'footer.html'; ?>
</body>
</html>