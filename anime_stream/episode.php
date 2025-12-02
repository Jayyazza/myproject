<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT e.*, a.title FROM episode_list e JOIN anime_list a ON e.id_anime = a.id WHERE e.id='$id'");
$data = mysqli_fetch_assoc($query);

// Simpan komentar
if (isset($_POST['submit_comment'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $comment = mysqli_real_escape_string($conn, $_POST['comment']);
  mysqli_query($conn, "INSERT INTO comments (id_episode, username, comment) VALUES ('$id', '$username', '$comment')");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['title'] ?> - Episode <?= $data['episode_num'] ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #0f0f10;
      color: #f1f1f1;
    }

    header {
      background: #1e40af;
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 22px;
      font-weight: 600;
      letter-spacing: 1px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #18181b;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.4);
      padding: 30px;
    }

    .title {
      font-size: 24px;
      font-weight: 600;
      color: #60a5fa;
      margin-bottom: 15px;
      text-align: center;
    }

    iframe {
      width: 100%;
      height: 480px;
      border: none;
      border-radius: 10px;
      box-shadow: 0 3px 12px rgba(0,0,0,0.5);
    }

    .back-link {
      display: block;
      width: fit-content;
      margin: 20px auto;
      text-decoration: none;
      color: #60a5fa;
      font-weight: 500;
      transition: 0.2s;
    }

    .back-link:hover {
      color: #93c5fd;
    }

    /* KOMENTAR SECTION */
    .comments-section {
      margin-top: 35px;
    }

    .comments-section h3 {
      color: #60a5fa;
      margin-bottom: 12px;
    }

    .comment-item {
      background: #1f1f22;
      border-radius: 10px;
      padding: 12px 15px;
      margin-bottom: 10px;
    }

    .comment-item strong {
      color: #93c5fd;
    }

    .comment-item .time {
      color: #aaa;
      font-size: 12px;
      margin-left: 8px;
    }

    .comment-item p {
      margin: 6px 0 0;
      line-height: 1.5;
    }

    .comment-form {
      margin-top: 25px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .comment-form input,
    .comment-form textarea {
      padding: 10px;
      border-radius: 8px;
      border: none;
      background: #27272a;
      color: #fff;
      font-family: 'Poppins', sans-serif;
    }

    .comment-form textarea {
      resize: vertical;
      min-height: 80px;
    }

    .comment-form button {
      background: #3b82f6;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
      transition: 0.2s;
    }

    .comment-form button:hover {
      background: #2563eb;
    }

  </style>
</head>
<body>
<?php include 'navbar.html'; ?>

  <a href="javascript:history.back()" class="back-link">⬅ Kembali</a>

  <div class="container">
    <div class="title"><?= $data['title'] ?> - Episode <?= $data['episode_num'] ?></div>

    <iframe src="https://drive.google.com/file/d/<?= explode('/', $data['video_link'])[5] ?>/preview" allowfullscreen></iframe>

    <!-- Komentar -->
    <div class="comments-section">
      <h3>Komentar</h3>

      <?php
      $comments = mysqli_query($conn, "SELECT * FROM comments WHERE id_episode='$id' ORDER BY created_at DESC");
      if (mysqli_num_rows($comments) > 0) {
        while ($c = mysqli_fetch_assoc($comments)) {
          echo "<div class='comment-item'>
                  <strong>{$c['username']}</strong> 
                  <span class='time'>{$c['created_at']}</span>
                  <p>{$c['comment']}</p>
                </div>";
        }
      } else {
        echo "<p>Belum ada komentar.</p>";
      }
      ?>

      <form action="" method="POST" class="comment-form">
        <input type="text" name="username" placeholder="Nama kamu" required>
        <textarea name="comment" placeholder="Tulis komentar..." required></textarea>
        <button type="submit" name="submit_comment">💬 Kirim Komentar</button>
      </form>
    </div>
  </div>
<?php include 'footer.html'; ?>
</body>
</html>