<?php
include 'koneksi.php';
$id = $_GET['id'];
$anime = mysqli_query($conn, "SELECT * FROM anime_list WHERE id = '$id'");
$data = mysqli_fetch_assoc($anime);
$episodes = mysqli_query($conn, "SELECT * FROM episode_list WHERE id_anime = '$id' ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $data['title'] ?> - Detail Anime</title>
  <link rel="stylesheet" href="style.css">
  <style>
  body {
    font-family: "Poppins", sans-serif;
    background-color: #0b1221; /* sama kayak index */
    margin: 0;
    padding: 0;
    color: #fff;
  }

  header {
    background: linear-gradient(90deg, #007bff, #00b7ff);
    padding: 18px 0;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
    color: white;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
  }

  .back-link {
    display: inline-block;
    margin: 20px;
    text-decoration: none;
    color: #4da3ff;
    font-weight: 600;
  }

  .container {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    gap: 30px;
    width: 90%;
    margin: 30px auto;
    background: #141c2f;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    padding: 25px;
  }

  .container img {
    width: 250px;
    height: 350px;
    object-fit: cover;
    border-radius: 12px;
  }

  .info {
    flex: 1;
  }

  .info h1 {
    color: #4da3ff;
    margin-bottom: 10px;
  }

  .genre, .status {
    font-size: 15px;
    color: #d0d6e1;
    margin: 5px 0;
  }

  .desc {
    margin-top: 15px;
    line-height: 1.6;
    background: #1a2339;
    padding: 12px 15px;
    border-radius: 10px;
    color: #e0e6f0;
  }

  .episode-list {
    margin-top: 25px;
  }

  .episode-list h3 {
    color: #66b3ff;
    margin-bottom: 15px;
  }

  .episode-item {
    background: #1a2339;
    border: 1px solid #223355;
    border-radius: 10px;
    padding: 10px 15px;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background 0.2s ease, transform 0.1s ease;
  }

  .episode-item:hover {
    background: #223355;
    transform: scale(1.01);
  }

  .episode-item span {
    font-weight: 600;
    color: #4da3ff;
  }

  .watch-btn {
    background: linear-gradient(90deg, #007bff, #00b7ff);
    color: white;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: bold;
    transition: opacity 0.2s ease;
  }

  .watch-btn:hover {
    opacity: 0.8;
  }

  footer {
    margin-top: 40px;
    text-align: center;
    padding: 15px;
    color: #888;
    font-size: 14px;
  }

    footer span {
    color: #4da3ff;
  }

  @media (max-width: 768px) {
    .container {
      flex-direction: column;
      align-items: center;
    }

    .container img {
      width: 200px;
      height: 300px;
    }

    .episode-item {
      flex-direction: column;
      align-items: flex-start;
      gap: 5px;
    }
  }
</style>
</head>
<body>
<?php include 'navbar.html'; ?>

  <a href="index.php" class="back-link">⬅ Kembali ke Beranda</a>

  <div class="container">
    <img src="assets/img/<?= $data['image'] ?>" alt="<?= $data['title'] ?>">
    <div class="info">
      <h1><?= $data['title'] ?></h1>
      <p class="genre"><b>Genre:</b> <?= $data['genre'] ?></p>
      <p class="status"><b>Status:</b> <?= $data['status'] ?></p>
      <p class="desc"><?= $data['description'] ?></p>

      <div class="episode-list">
        <h3>Daftar Episode</h3>
        <?php while ($ep = mysqli_fetch_assoc($episodes)) { ?>
          <div class="episode-item">
            <span><?= $ep['episode_num'] ?></span>
            <a href="episode.php?id=<?= $ep['id'] ?>" class="watch-btn">Tonton</a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

<?php include 'footer.html'; ?>

</body>
</html>