<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $genre = $_POST['genre'];
  $status = $_POST['status'];
  $description = $_POST['description'];

  // upload gambar
  $image = $_FILES['image']['name'];
  $tmp_name = $_FILES['image']['tmp_name'];
  $target_dir = "../assets/img/" . basename($image);

  if (move_uploaded_file($tmp_name, $target_dir)) {
    $query = "INSERT INTO anime_list (title, genre, status, description, image) 
              VALUES ('$title', '$genre', '$status', '$description', '$image')";
    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Anime berhasil ditambahkan!'); window.location='dashboard.php';</script>";
    } else {
      echo "<script>alert('Gagal menambahkan anime!');</script>";
    }
  } else {
    echo "<script>alert('Gagal upload gambar!');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Anime | Jaynime</title>
  <style>
    body {
      background-color: #0b1221;
      color: #fff;
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background: linear-gradient(90deg, #007bff, #00b7ff);
      padding: 18px;
      text-align: center;
      font-weight: bold;
      font-size: 22px;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background: #141c2f;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }

    h2 {
      text-align: center;
      color: #4da3ff;
      margin-bottom: 20px;
    }

    label {
      font-weight: 600;
      display: block;
      margin-top: 10px;
    }

    input[type="text"], textarea, select {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      margin-top: 5px;
      margin-bottom: 10px;
      background: #1a243b;
      color: #fff;
    }

    input[type="file"] {
      margin-top: 8px;
      color: #ccc;
    }

    button {
      background: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      display: block;
      width: 100%;
      margin-top: 15px;
    }

    button:hover {
      background: #005fcc;
    }

    a.back {
      color: #4da3ff;
      text-decoration: none;
      display: inline-block;
      margin-top: 10px;
    }

    a.back:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<?php include 'navbar_admin.html'; ?>
<link rel="stylesheet" href="navbar_admin.css">

  <div class="container">
    <h2>Tambah Anime</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>Judul Anime</label>
      <input type="text" name="title" required>

      <label>Genre</label>
      <input type="text" name="genre" placeholder="misal: Action, Comedy, Drama" required>

      <label>Status</label>
      <select name="status" required>
        <option value="Ongoing">Ongoing</option>
        <option value="Complete">Complete</option>
      </select>

      <label>Deskripsi</label>
      <textarea name="description" rows="5" required></textarea>

      <label>Gambar Cover</label>
      <input type="file" name="image" accept="image/*" required>

      <button type="submit">💾 Simpan Anime</button>
    </form>

    <a href="dashboard.php" class="back">⬅ Kembali ke Dashboard</a>
  </div>
</body>
</html>