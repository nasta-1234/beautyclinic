<?php
require_once __DIR__ . '/components/connect.php';

$keyword = $_GET['search'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <title>Hasil Pencarian</title>
   <link rel="stylesheet" href="css/user_style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="search-result">

<h1 class="heading">
   Hasil Pencarian "<?= htmlspecialchars($keyword); ?>"
</h1>

<?php
if ($keyword != '') {

   $search = $conn->prepare("
      SELECT * FROM layanan
      WHERE nama LIKE ?
   ");
   $search->execute(["%$keyword%"]);

   if ($search->rowCount() > 0) {
      while ($row = $search->fetch(PDO::FETCH_ASSOC)) {
?>
      <div class="box">
         <h3><?= htmlspecialchars($row['nama']); ?></h3>
         <p><?= htmlspecialchars($row['deskripsi'] ?? ''); ?></p>
      </div>
<?php
      }
   } else {
      echo '<p class="empty">Layanan tidak ditemukan</p>';
   }
}
?>

</section>

<?php include 'components/user_footer.php'; ?>

</body>
</html>
