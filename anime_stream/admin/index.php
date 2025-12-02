<?php
session_start();

// cek kalau form dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // contoh sederhana (nanti bisa kamu ganti cek ke database)
    if ($username === "anomali" && $password === "910233") {
        $_SESSION["login"] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="login.css?v=2">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="box">
    <div class="container">
      <div class="top-header">
              <span>Jayy Web</span>
              <header>Log In</header>
        </div>
        <form method="POST" action="">
            <div class="input-field">
                <input type="text" name="username" class="input" placeholder="username?" required>
            </div>

            <div class="input-field">
                <input type="password" name="password" class="input" placeholder="password?" required>
            </div>

            <div class="input-field">
                <input type="submit" class="submit" value="done">
            </div>
        </form>

        <?php if (!empty($error)) : ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>

        <div class="bottom">
            <div class="left">
                <input type="checkbox" id="check">
                <label for="check">Ingat</label>
            </div>
            <div class="right">
                <label><a href="#">Lupa password</a></label>
            </div>
        </div>
    </div>
</div>
<a href="../index.php" class="back-home">⬅️ Kembali ke Stream</a>
</body>
</html>
