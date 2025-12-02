<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

// Ambil data anime
$anime = mysqli_query($conn, "SELECT * FROM anime_list ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin | Jaynime</title>
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
      justify-content: center;
      align-items: center;
      max-width: 900px;
      margin: 40px auto;
      background: #141c2f;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }

    h2 {
      color: #4da3ff;
      margin-bottom: 15px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      padding: 10px;
      border-bottom: 1px solid #2c3e57;
      text-align: left;
    }

    th {
      background-color: #1a243b;
      color: #4da3ff;
    }

    .btn-edit {
      background-color: #007bff;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      transition: 0.3s;
    }

    .btn-edit:hover {
      background-color: #0056b3;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      transition: 0.3s;
    }

    .btn-delete:hover {
      background-color: #a71d2a;
    }

    a.btn {
      background: #007bff;
      color: #fff;
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 6px;
      margin-right: 5px;
      font-size: 14px;
    }

    a.btn:hover {
      background: #005fcc;
    }

    .top-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logout {
      color: #ff4c4c;
      text-decoration: none;
      font-weight: 600;
    }

    .logout:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<?php include 'navbar_admin.html'; ?>
<link rel="stylesheet" href="navbar_admin.css">

  <div class="container">
    <table>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Genre</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
      <?php $no = 1; while ($row = mysqli_fetch_assoc($anime)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['title'] ?></td>
        <td><?= $row['genre'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
          <a href="edit_anime.php?id=<?= $row['id'] ?>" class="btn-edit">✏️ Edit</a>
          <a href="hapus.php?id=<?= $row['id'] ?>" class="btn" style="background:#ff4c4c;">🗑 Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>