<?php
require_once __DIR__ . '/components/connect.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Team - NASTA Beauty Clinic</title>

<link rel="stylesheet" href="css/user_style.css">
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- BANNER -->
<div class="banner">
    <div class="detail">
        <h1>Tim Dokter Kami</h1>
        <p>NASTA Beauty Clinic didukung oleh dokter profesional dan berpengalaman.</p>
        <span>
            <a href="index.php">home</a>
            <i class="bx bx-right-arrow-alt"></i>
            team
        </span>
    </div>
</div>

<!-- TEAM SECTION -->
<section class="team">

    <div class="heading">
        <h2>Meet Our Experts</h2>
        <p>Profesional, berpengalaman, dan terpercaya</p>
    </div>
    
<div class="team-container">

<?php
$select_team = $conn->prepare("SELECT * FROM team WHERE status = 'active'");
$select_team->execute();

if ($select_team->rowCount() > 0) {
    while ($team = $select_team->fetch(PDO::FETCH_ASSOC)) {
?>

<div class="team-card">
    <a href="team_detail.php?id=<?= $team['id_team']; ?>" class="team-link">

        <div class="team-img">
            <img src="uploaded_files/<?= htmlspecialchars($team['foto']); ?>" alt="<?= htmlspecialchars($team['nama']); ?>">
        </div>

        <div class="team-info">
            <h3><?= htmlspecialchars($team['nama']); ?></h3>
            <span><?= htmlspecialchars($team['profesi']); ?></span>
        </div>

    </a>
</div>

<?php
    }
} else {
    echo '<p class="empty">Belum ada data team.</p>';
}
?>

</div>

<div class="team-card">

    <div class="team-img">
        <img src="uploaded_files/<?= htmlspecialchars($team['foto']); ?>" 
             alt="<?= htmlspecialchars($team['nama']); ?>">
    </div>

    <div class="team-info">
        <h3><?= htmlspecialchars($team['nama']); ?></h3>
        <span>Profession : <?= htmlspecialchars($team['profesi']); ?></span>

        <a href="team_detail.php?id=<?= $team['id_team']; ?>" class="btn-detail">
            View Details
        </a>
    </div>

</div>



