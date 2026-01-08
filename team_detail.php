<?php
require_once 'components/connect.php';

if(!isset($_GET['tid'])){
    header('location:team.php');
    exit;
}

$tid = $_GET['tid'];

$select_team = $conn->prepare("SELECT * FROM team WHERE id_team = ?");
$select_team->execute([$tid]);

if($select_team->rowCount() == 0){
    header('location:team.php');
    exit;
}

$doctor = $select_team->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Dokter</title>
<link rel="stylesheet" href="css/user_style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="team-detail">

    <div class="detail-container">

        <!-- FOTO -->
        <div class="detail-image">
            <img src="uploaded_files/<?= $doctor['foto']; ?>" alt="">
        </div>

        <!-- INFO -->
        <div class="detail-content">
            <h2><?= $doctor['nama']; ?></h2>
            <h4><?= $doctor['gelar']; ?></h4>

            <p class="desc">
                <?= nl2br($doctor['deskripsi']); ?>
            </p>

            <a href="team.php" class="btn">Kembali</a>
        </div>

    </div>

</section>

</body>
</html>
