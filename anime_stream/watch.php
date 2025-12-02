<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tonton Anime</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container mt-5">
    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $anime = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM anime_list WHERE id=$id"));
      $eps = mysqli_query($conn, "SELECT * FROM episode_list WHERE id_anime=$id ORDER BY id DESC");
    ?>
      <h2 class="mb-3 text-info"><?php echo $anime['title']; ?></h2>
      <p class="text-secondary"><?php echo $anime['description']; ?></p>

      <?php while ($e = mysqli_fetch_assoc($eps)): ?>
        <div class="mb-5">
          <h5>Episode <?php echo $e['episode_num']; ?></h5>
          <div class="ratio ratio-16x9">
            <iframe src="<?php echo $e['video_link']; ?>" allowfullscreen></iframe>
          </div>
        </div>
      <?php endwhile; ?>

    <?php } else { ?>
      <p>Tidak ada anime yang dipilih.</p>
    <?php } ?>
  </div>
</body>
</html>
