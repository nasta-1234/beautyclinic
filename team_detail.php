<?php
require_once __DIR__ . '/components/connect.php';

if(!isset($_GET['id'])){
    header('location:team.php');
    exit;
}

$id = $_GET['id'];

$select = $conn->prepare("SELECT * FROM team WHERE id_team = ?");
$select->execute([$id]);

if($select->rowCount() == 0){
    header('location:team.php');
    exit;
}

$team = $select->fetch(PDO::FETCH_ASSOC);
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

    <div class="detail-card">
        <img src="uploaded_files/<?= $team['foto']; ?>" alt="<?= $team['nama']; ?>">

        <div class="detail-info">
            <h2><?= $team['nama']; ?></h2>
            <span><?= $team['profesi']; ?></span>

            <p><?= nl2br($team['deskripsi']); ?></p>

            <a href="appointment.php?doctor=<?= $team['id_team']; ?>" class="btn-detail">
                Book Appointment
            </a>
        </div>
    </div>

</section>

</body>
</html>
