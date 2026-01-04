<?php
require_once 'components/connect.php';

$id = $_GET['id'] ?? '';

$select = $conn->prepare("SELECT * FROM team WHERE id_team = ?");
$select->execute([$id]);

if ($select->rowCount() == 0) {
    header('location:team.php');
    exit;
}

$row = $select->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $row['nama']; ?> - Detail Dokter</title>
<link rel="stylesheet" href="css/user_style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="team-detail">

    <div class="detail-container">

        <!-- FOTO DOKTER -->
        <div class="image">
            <img src="uploaded_files/<?= $row['foto']; ?>" alt="<?= $row['nama']; ?>">
        </div>

        <!-- INFO -->
        <div class="content">
            <h2><?= $row['nama']; ?></h2>

            <p><strong>Profesi:</strong> <?= $row['profesi']; ?></p>
            <p><strong>Gelar:</strong> <?= $row['gelar']; ?></p>
            <p><strong>Email:</strong> <?= $row['email']; ?></p>
            <p><strong>Alamat:</strong> <?= $row['alamat']; ?></p>

            <p class="desc">
                <?= $row['deskripsi']; ?>
            </p>

            <a href="team.php" class="btn-back">← Kembali ke Tim Dokter</a>
        </div>

    </div>

</section>

<?php include 'components/user_footer.php'; ?>

</body>
</html>
