<?php
include 'koneksi.php';

// Ambil huruf dari URL
$huruf = isset($_GET['huruf']) ? $_GET['huruf'] : 'A';

// Ambil data anime berdasarkan huruf awal judul
$query = "SELECT * FROM anime_list WHERE title LIKE '$huruf%' ORDER BY title ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Anime A-Z | Jaynime</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      color: white;
      text-align: center;
      background-color: #0b1221;
      font-family: 'Poppins', sans-serif;
    }

    h1 {
      margin-top: 100px;
      color: #00c8ff;
      text-shadow: 0 0 10px #00c8ff, 0 0 20px #007bff;
      letter-spacing: 1px;
    }

    .alphabet-bar {
      margin: 40px auto;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      max-width: 900px;
    }

    .alphabet-bar a {
      display: inline-block;
      padding: 10px 16px;
      border-radius: 10px;
      background: rgba(255,255,255,0.08);
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      font-size: 16px;
      letter-spacing: 1px;
      border: 1px solid rgba(0,255,255,0.2);
      transition: all 0.25s ease-in-out;
      box-shadow: 0 0 0px rgba(0,255,255,0);
    }

    .alphabet-bar a:hover {
      background: rgba(0,170,255,0.8);
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 0 15px rgba(0,170,255,0.8), 0 0 25px rgba(0,170,255,0.5);
    }

    .alphabet-bar a.active {
      background: rgba(0,200,255,0.9);
      box-shadow: 0 0 20px rgba(0,200,255,0.9), 0 0 30px rgba(0,170,255,0.6);
    }

    .anime-list {
      max-width: 700px;
      margin: 40px auto 80px;
      text-align: left;
      background: rgba(255,255,255,0.05);
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,170,255,0.15);
    }

    .anime-item {
      padding: 10px 12px;
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .anime-item:last-child {
      border-bottom: none;
    }

    .anime-item a {
      color: #00b7ff;
      text-decoration: none;
      font-weight: 600;
      font-size: 15px;
      transition: 0.2s;
    }

    .anime-item a:hover {
      color: #00ffff;
      text-shadow: 0 0 8px #00ffff;
    }
  </style>
</head>
<?php include 'navbar.html'; ?>
<body>
  <h1>Daftar Anime</h1>

  <div class="alphabet-bar">
    <?php 
      foreach (range('A', 'Z') as $char) {
        $active = ($char == $huruf) ? 'active' : '';
        echo "<a href='?huruf=$char' class='$active'>$char</a>";
      }
    ?>
  </div>

  <div class="anime-list">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="anime-item">
          <a href="detail.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a>
        </div>
      <?php } ?>
    <?php else: ?>
      <p>Tidak ada anime berawalan huruf <strong><?= $huruf ?></strong>.</p>
    <?php endif; ?>
  </div>

  <?php include 'footer.html'; ?>
</body>
</html>