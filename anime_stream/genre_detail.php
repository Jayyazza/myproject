<?php
include 'koneksi.php';

$genre = $_GET['genre'] ?? '';
$genre_safe = mysqli_real_escape_string($conn, $genre);
$result = mysqli_query($conn, "SELECT * FROM anime_list WHERE genre='$genre_safe'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($genre) ?> Anime</title>
  <link rel="stylesheet" href="assets/genre.css">
</head>
<body>
  <header>
    <h1>Genre: <?= htmlspecialchars($genre) ?></h1>
    <p>Daftar anime dengan genre ini</p>
  </header>

  <main class="genre-container">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="genre-card" style="flex-direction: column;">
          <img src="anime_stream/assets/img<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" style="width:120px; height:160px; border-radius:10px; margin-bottom:8px;">
          <span><?= htmlspecialchars($row['title']) ?></span>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>Tidak ada anime untuk genre ini.</p>
    <?php endif; ?>
  </main>

  <a href="genre.php" class="back-home">⬅️ Kembali</a>
</body>
</html>