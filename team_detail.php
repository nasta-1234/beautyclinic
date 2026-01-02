<?php
include 'components/connect.php';

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
<title><?= $row['nama']; ?></title>
<link rel="stylesheet" href="css/user_style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="team-detail">

    <div class="detail-container">

        <div class="image">
            <img src="uploaded_files/<?= $row['foto']; ?>" alt="">
        </div>

        <div class="content">
            <h2><?= $row['nama']; ?></h2>
            <p><b>Profession :</b> <?= $row['profesi']; ?></p>
            <p><b>Degree :</b> <?= $row['gelar']; ?></p>
            <p><b>Email :</b> <?= $row['email']; ?></p>
            <p><b>Address :</b> <?= $row['alamat']; ?></p>

            <p class="desc"><?= $row['deskripsi']; ?></p>

            <a href="team.php" class="btn">Go Back</a>
        </div>

    </div>

</section>

<?php include 'components/user_footer.php'; ?>
</body>
</html>
