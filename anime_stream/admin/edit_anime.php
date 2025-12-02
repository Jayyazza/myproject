<?php
include '../koneksi.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM anime_list WHERE id = '$id'");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $genre = $_POST['genre'];
  $status = $_POST['status'];
  $description = $_POST['description'];
  $image = $_FILES['image']['name'];

  if ($image != '') {
    $target = "../assets/img/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $update = "UPDATE anime_list SET title='$title', genre='$genre', status='$status', description='$description', image='$image' WHERE id='$id'";
  } else {
    $update = "UPDATE anime_list SET title='$title', genre='$genre', status='$status', description='$description' WHERE id='$id'";
  }

  mysqli_query($conn, $update);
  header("Location: index.php?msg=updated");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Anime</title>
  <style>
    body {
      background-color: #0e1f33;
      font-family: Arial, sans-serif;
      color: white;
      padding: 20px;
    }
    .container {
      background: #142b4c;
      padding: 25px;
      border-radius: 12px;
      width: 400px;
      margin: 50px auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }
    h2 {
      text-align: center;
      color: #00aaff;
    }
    label {
      font-weight: bold;
    }
    input, textarea, select {
      width: 100%;
      margin-bottom: 10px;
      padding: 8px;
      border-radius: 6px;
      border: none;
    }
    button {
      background-color: #00aaff;
      color: white;
      padding: 10px;
      width: 100%;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }
    button:hover {
      background-color: #0088cc;
    }
    .back-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      color: #00aaff;
      text-decoration: none;
    }
  </style>
</head>
<body>
<?php include 'navbar_admin.html'; ?>
<link rel="stylesheet" href="navbar_admin.css">

  <div class="container">
    <h2>Edit Anime</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>Judul Anime</label>
      <input type="text" name="title" value="<?= $data['title'] ?>" required>

      <label>Genre</label>
      <input type="text" name="genre" value="<?= $data['genre'] ?>" required>

      <label>Status</label>
      <select name="status" required>
        <option value="Ongoing" <?= $data['status'] == 'Ongoing' ? 'selected' : '' ?>>Ongoing</option>
        <option value="Complete" <?= $data['status'] == 'Complete' ? 'selected' : '' ?>>Complete</option>
      </select>

      <label>Deskripsi</label>
      <textarea name="description" rows="4" required><?= $data['description'] ?></textarea>

      <label>Gambar (opsional)</label>
      <input type="file" name="image">

      <button type="submit" name="submit">Simpan Perubahan</button>
    </form>

    <a href="index.php" class="back-link">⬅ Kembali</a>
  </div>
</body>
</html>