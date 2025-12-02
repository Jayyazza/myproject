<?php
include '../koneksi.php';

$anime_list = mysqli_query($conn, "SELECT * FROM anime_list");

// Proses tambah episode
if (isset($_POST['simpan'])) {
    $id_anime = $_POST['id_anime'];
    $episode_num = $_POST['episode_num'];
    $video_link = $_POST['video_link'];

    $query = "INSERT INTO episode_list (id_anime, episode_num, video_link) 
              VALUES ('$id_anime', '$episode_num', '$video_link')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Episode berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan episode!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Episode - Jaynime Streaming</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #0e1628;
      color: white;
      text-align: center;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #1e3a8a;
      padding: 20px;
      font-size: 28px;
      font-weight: bold;
      color: white;
    }

    .container {
      max-width: 500px;
      margin: 50px auto;
      background: #1f2937;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
    }

    label {
      display: block;
      margin-top: 15px;
      font-size: 16px;
      text-align: left;
    }

    input, select {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 8px;
      margin-top: 5px;
      font-size: 15px;
    }

    input[type="submit"] {
      background-color: #2563eb;
      color: white;
      font-weight: bold;
      margin-top: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #1d4ed8;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      color: #60a5fa;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<?php include 'navbar_admin.html'; ?>
<link rel="stylesheet" href="navbar_admin.css">

  <div class="container">
    <h2>Tambah Episode Baru</h2>
    <form method="POST">
      <label for="id_anime">Pilih Anime:</label>
      <select name="id_anime" id="id_anime" required>
        <option value="">-- Pilih Anime --</option>
        <?php while ($row = mysqli_fetch_assoc($anime_list)) { ?>
          <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
        <?php } ?>
      </select>

      <label for="episode_num">Nomor Episode:</label>
      <input type="text" name="episode_num" id="episode_num" placeholder="Contoh: Episode 1" required>

      <label for="video_link">Link Video (Google Drive):</label>
      <input type="text" name="video_link" id="video_link" placeholder="https://drive.google.com/file/d/..." required>

      <input type="submit" name="simpan" value="Simpan Episode">
    </form>

    <a href="index.php">⬅ Kembali ke Dashboard</a>
  </div>

</body>
</html>