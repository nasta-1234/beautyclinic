<?php
// Koneksi database
require_once __DIR__ . '/components/connect.php';

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
        <h1>teams</h1>
            <p>NASTA Beauty Clinic merupakan pusat perawatan kecantikan yang menyediakan layanan lengkap untuk perawatan tubuh, wajah, dan rambut. Dengan dukungan tenaga ahli yang berpengalaman serta penggunaan teknologi dan produk berkualitas tinggi, setiap layanan dirancang untuk memberikan hasil terbaik sesuai dengan kebutuhan pelanggan. Perawatan tubuh difokuskan untuk menjaga kebugaran dan kehalusan kulit, perawatan wajah membantu meningkatkan kesehatan serta kecerahan kulit secara alami, sementara perawatan rambut memberikan nutrisi dan perawatan intensif agar tetap sehat dan berkilau. Dengan suasana klinik yang nyaman dan elegan, NASTA Beauty Clinic berkomitmen untuk menghadirkan pengalaman perawatan yang aman, menyenangkan, dan memuaskan bagi setiap pelanggan.</p>
        <span><a href="index.php">home</a> <i class="bx bx-right-arrow-alt"></i>teams</span>
    </div>
</div>
<div class="services">
    <div class="box-container">
        <?php
        $select_services = $conn->prepare("SELECT *FROM `layanan` WHERE status = ?");
        $select_services->execute(['active']);

        if ($select_services->rowCount() > 0){
            while($fetch_services = $select_services->fetch(PDO::FETCH_ASSOC)){
        ?>
        
        <?php
            }
        }else{
            echo'
            <div class="empty">
                <p>Tidak ada layanan yang ditambahkan!</p>
            </div>
            ';
        }
        ?>
    </div>
</div>


<!-- Footer -->
<?php include 'components/user_footer.php'; ?>

<footer>
    <p>&copy; <?= date("Y"); ?> Beauty Clinic. All rights reserved.</p>
</footer>

</body>
</html>
