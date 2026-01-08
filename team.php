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
        <h1>Team Dokter</h1>
            <p>Team Dokter NASTA Beauty Clinic terdiri dari tenaga medis profesional yang berpengalaman di bidang estetika dan perawatan kecantikan. Setiap dokter memiliki latar belakang pendidikan kedokteran dari universitas ternama serta kompetensi di bidangnya masing-masing, mulai dari perawatan kulit, wajah, hingga perawatan tubuh berbasis teknologi modern.

Dengan mengutamakan konsultasi yang menyeluruh dan pendekatan yang personal, team dokter kami berkomitmen untuk memahami kebutuhan serta kondisi setiap pasien sebelum menentukan jenis perawatan yang tepat. Setiap tindakan dilakukan dengan standar medis yang aman, menggunakan teknologi dan produk berkualitas tinggi, demi memberikan hasil yang optimal dan alami.

Didukung oleh suasana klinik yang nyaman dan pelayanan yang ramah, Team Dokter NASTA Beauty Clinic siap memberikan pengalaman perawatan yang profesional, aman, dan menyenangkan, serta membantu setiap pasien tampil lebih sehat, segar, dan percaya diri.</p>
        <span><a href="index.php">home</a> <i class="bx bx-right-arrow-alt"></i>Team</span>
    </div>
</div>
<div class="team">
    <div class="box-container">
      <?php
    $select_team = $conn->prepare("SELECT * FROM `team` WHERE status = ?");
    $select_team->execute(['active']);

if ($select_team->rowCount() > 0){
    while($fetch_team = $select_team->fetch(PDO::FETCH_ASSOC)){
?>
<div class="box">
    <img src="uploaded_files/<?= $fetch_team['foto']; ?>" class="image">

    <div class="content">
        <h3><?= $fetch_team['nama']; ?></h3>
        <p class="role"><?= $fetch_team['gelar']; ?></p>
        <p class="profesi"><?= $fetch_team['profesi']; ?></p>


        <a href="team_detail.php?tid=<?= $fetch_team['id_team']; ?>" class="btn">
            Detail Dokter
        </a>
    </div>
</div>
<?php
    }
} else {
    echo '
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
