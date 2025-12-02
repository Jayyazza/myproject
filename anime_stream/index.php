<?php
include 'koneksi.php';

// --- konfigurasi pagination ---
$limit = 5; // jumlah anime per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// --- ambil filter & pencarian ---
$search = isset($_GET['search']) ? $_GET['search'] : '';
$genre  = isset($_GET['genre']) ? $_GET['genre'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$query = "SELECT * FROM anime_list WHERE 1";

// tambahkan filter
if (!empty($search)) {
    $query .= " AND title LIKE '%$search%'";
}
if (!empty($genre)) {
    $query .= " AND genre LIKE '%$genre%'";
}
if (!empty($status)) {
    $query .= " AND status = '$status'";
}

$query .= " LIMIT $start, $limit";

$result = mysqli_query($conn, $query);

$countQuery = "SELECT COUNT(*) AS total FROM anime_list WHERE 1";
if (!empty($search)) {
    $countQuery .= " AND title LIKE '%$search%'";
}
if (!empty($genre)) {
    $countQuery .= " AND genre LIKE '%$genre%'";
}
if (!empty($status)) {
    $countQuery .= " AND status = '$status'";
}
$countResult = mysqli_query($conn, $countQuery);
$total = mysqli_fetch_assoc($countResult)['total'];
$total_pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jaynime Streaming</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<?php include 'navbar.html'; ?>
<body>
  
<div class="search-box">
    <form method="GET">
        <input type="text" name="search" placeholder="Cari anime..." value="<?= htmlspecialchars($search) ?>">
    </form>
</div>

<div class="anime-container">
    
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    
    <div class="anime-card">
        <a href="detail.php?id=<?= $row['id'] ?>">
            <img src="assets/img/<?= $row['image'] ?>" alt="<?= $row['title'] ?>">
            <h3><?= $row['title'] ?></h3>
        </a>
    </div>
<?php } ?>
</div>

<div class="pagination">
  <?php if ($page > 1): ?>
    <a href="?page=<?= $page - 1 ?>&search=<?= $search ?>&genre=<?= $genre ?>&status=<?= $status ?>" class="page-btn">« Prev</a>
  <?php endif; ?>

  <?php for ($i = 1; $i <= $total_pages; $i++): ?>
    <a href="?page=<?= $i ?>&search=<?= $search ?>&genre=<?= $genre ?>&status=<?= $status ?>" 
       class="page-btn <?= $i == $page ? 'active' : '' ?>">
      <?= $i ?>
    </a>
  <?php endfor; ?>

  <?php if ($page < $total_pages): ?>
    <a href="?page=<?= $page + 1 ?>&search=<?= $search ?>&genre=<?= $genre ?>&status=<?= $status ?>" class="page-btn">Next »</a>
  <?php endif; ?>
</div>

<?php include 'footer.html'; ?>

</body>
</html>