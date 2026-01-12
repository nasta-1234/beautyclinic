<?php
session_start();
if (!isset($_SESSION['id_pelanggan'])) {
   header('Location: /beautyclinic/user/login.php');
   exit;
}

/* Cek login */
$id_pelanggan = $_SESSION['id_pelanggan'] ?? '';

if ($id_pelanggan == '') {
   header('location: ../login.php');
   exit;
}

/* Ambil data profil user */
$get_user = $conn->prepare("SELECT * FROM pelanggan WHERE id_pelanggan = ?");
$get_user->execute([$id_pelanggan]);
$user = $get_user->fetch(PDO::FETCH_ASSOC);

/* Hitung jumlah janji */
$total_janji = $conn->prepare("SELECT COUNT(*) FROM janji WHERE id_user = ?");
$total_janji->execute([$id_pelanggan]);
$jumlah_janji = $total_janji->fetchColumn();

/* Hitung jumlah pesan */
$total_pesan = $conn->prepare("SELECT COUNT(*) FROM messages WHERE user_id = ?");
$total_pesan->execute([$id_pelanggan]);
$jumlah_pesan = $total_pesan->fetchColumn();
?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <title>Profil Saya</title>
   <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>

<?php include '../components/user_header.php'; ?>

<!-- GANTI class profile → profile-page (WAJIB) -->
<section class="profile-page">

   <h1 class="heading">Profil Saya</h1>

   <!-- KARTU PROFIL (TENGAH) -->
   <div class="profile-card">
      <img src="../uploaded_files/<?= htmlspecialchars($user['foto']); ?>" 
           alt="User" class="profile-img">

      <h3><?= htmlspecialchars($user['nama']); ?></h3>
      <p><?= htmlspecialchars($user['email']); ?></p>

      <a href="edit_profil.php" class="btn update-btn">Update Profil</a>
   </div>

   <!-- INFO DI BAWAH (KIRI & KANAN) -->
   <div class="profile-info">

      <div class="info-box">
         <i class="bx bx-calendar"></i>
         <h3>Total Janji</h3>
         <p><?= $jumlah_janji; ?></p>
         <a href="janji_saya.php" class="btn small">Lihat Janji</a>
      </div>

      <div class="info-box">
         <i class="bx bx-message-rounded"></i>
         <h3>Total Pesan</h3>
         <p><?= $jumlah_pesan; ?></p>
         <a href="../contact.php" class="btn small">Kirim Pesan</a>
      </div>

   </div>

</section>

<?php include '../components/user_footer.php'; ?>

</body>
</html>
