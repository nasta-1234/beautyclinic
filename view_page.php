<?php
// Koneksi database
require_once __DIR__ . '/components/connect.php';

$pid = $_GET['pid'];

// Cek login
$id_pelanggan = isset($_COOKIE['id_pelanggan']) ? $_COOKIE['id_pelanggan'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NASTA Beauty Clinic</title>
<link rel="stylesheet" href="css/user_style.css">
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<?php include 'components/user_header.php'; ?>
<div class="banner">
    <div class="detail">
        <h1>melihat layanan</h1>
            <p>NASTA Beauty Clinic merupakan pusat perawatan kecantikan yang menyediakan layanan lengkap untuk perawatan tubuh, wajah, dan rambut. Dengan dukungan tenaga ahli yang berpengalaman serta penggunaan teknologi dan produk berkualitas tinggi, setiap layanan dirancang untuk memberikan hasil terbaik sesuai dengan kebutuhan pelanggan. Perawatan tubuh difokuskan untuk menjaga kebugaran dan kehalusan kulit, perawatan wajah membantu meningkatkan kesehatan serta kecerahan kulit secara alami, sementara perawatan rambut memberikan nutrisi dan perawatan intensif agar tetap sehat dan berkilau. Dengan suasana klinik yang nyaman dan elegan, NASTA Beauty Clinic berkomitmen untuk menghadirkan pengalaman perawatan yang aman, menyenangkan, dan memuaskan bagi setiap pelanggan.</p>
        <span><a href="index.php">home</a> <i class="bx bx-right-arrow-alt"></i>melihat layanan</span>
    </div>
</div>
<div class="view-service">
   <div class="heading">
        <h1>Detail Layanan</h1>
        <img src="image/logo.png">
   </div>

   <?php
        if(isset($_GET['pid']) && !empty($_GET['pid'])){
            $pid = $_GET['pid'];

            $select_service = $conn->prepare("SELECT * FROM layanan WHERE id_layanan = ?");
            $select_service->execute([$pid]);

            if ($select_service->rowCount() > 0){
                while($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
        <div class="img-box">
            <img src="uploaded_files/<?= htmlspecialchars($fetch_service['foto']); ?>" alt="<?= htmlspecialchars($fetch_service['nama']); ?>">
        </div>
        <div class="detail">
            <p class="harga"><?= number_format($fetch_service['harga'], 0, ',', '.'); ?></p>
            <div class="nama"><?= htmlspecialchars($fetch_service['nama']); ?></div>
            <p class="detail_layanan"><?= htmlspecialchars($fetch_service['detail_layanan']); ?></p>

            <input type="hidden" name="id_layanan" value="<?= $fetch_service['id_layanan']; ?>">

            <div class="flex-btn">
                <a href="appointment.php?get_id=<?= $fetch_service['id_layanan']; ?>" class="btn" style="width: 100%;">Buat Janji Sekarang</a>
            </div>
        </div>
   </form>
   <?php 
                }
            } else {
                echo "<p style='text-align:center;'>Data layanan tidak ditemukan di database.</p>";
            }
        } else {
            echo "<p style='text-align:center;'>ID layanan belum dikirim di URL.</p>";
        }
   ?>
</div>




<!-- Footer -->
<?php include 'components/user_footer.php'; ?>

<footer>
    <p>&copy; <?= date("Y"); ?> Beauty Clinic. All rights reserved.</p>
</footer>

</body>
</html>
