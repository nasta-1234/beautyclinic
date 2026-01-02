<?php
require_once __DIR__ . '/components/connect.php';

$id_pelanggan = isset($_COOKIE['id_pelanggan']) ? $_COOKIE['id_pelanggan'] : '';
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

<!-- Banner -->
<div class="banner">
    <div class="detail">
        <h1>Tim Dokter Kami</h1>
        <p>
            NASTA Beauty Clinic didukung oleh tim dokter dan terapis profesional
            yang berpengalaman di bidang kecantikan dan perawatan kulit.
        </p>
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

    <div class="box-container">
        <?php
        $select_team = $conn->prepare("SELECT * FROM `team` WHERE status = ?");
        $select_team->execute(['active']);

        if ($select_team->rowCount() > 0) {
            while ($fetch_team = $select_team->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="box">
            <img src="uploaded_files/<?= $fetch_team['foto']; ?>" alt="">
            <h3><?= $fetch_team['nama']; ?></h3>
            <span><?= $fetch_team['gelar']; ?></span>

            <div class="share">
                <a href="#" class="bx bxl-instagram"></a>
                <a href="#" class="bx bxl-facebook"></a>
                <a href="#" class="bx bxl-whatsapp"></a>
            </div>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">Belum ada data team.</p>';
        }
        ?>
    </div>
</section>

<?php include 'components/user_footer.php'; ?>

<footer>
    <p>&copy; <?= date("Y"); ?> Beauty Clinic. All rights reserved.</p>
</footer>

</body>
</html>

<?php
include 'components/connect.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Our Team</title>
<link rel="stylesheet" href="css/user_style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="team">

    <div class="heading">
        <h2>Meet Our Experts</h2>
        <p>Profesional, berpengalaman, dan terpercaya</p>
    </div>

    <div class="box-container">

    <?php
    $select_team = $conn->prepare("SELECT * FROM team WHERE status = 'active'");
    $select_team->execute();

    if ($select_team->rowCount() > 0) {
        while ($row = $select_team->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <a href="team_detail.php?id=<?= $row['id_team']; ?>" class="box">
            <img src="uploaded_files/<?= $row['foto']; ?>" alt="">
            <h3><?= $row['nama']; ?></h3>
            <span><?= $row['profesi']; ?></span>
        </a>
    <?php
        }
    } else {
        echo '<p class="empty">Belum Ada Data Team</p>';
    }
    ?>

    </div>

</section>

<?php include 'components/user_footer.php'; ?>
</body>
</html>

<?php
include 'config/db.php';
$query = mysqli_query($conn, "SELECT * FROM team WHERE status='active'");
?>

<section class="team">
    <div class="heading">
        <h2>Meet Our Experts</h2>
        <p>Profesional, berpengalaman, dan terpercaya</p>
    </div>

    <div class="team-container">

        <?php while($row = mysqli_fetch_assoc($query)) { ?>
            <div class="team-card">

                <a href="team-detail.php?id=<?= $row['id']; ?>" class="team-link">

                    <div class="team-img">
                        <img src="assets/images/team/<?= $row['foto']; ?>" alt="<?= $row['nama']; ?>">
                    </div>

                    <div class="team-info">
                        <h3><?= $row['nama']; ?></h3>
                        <span><?= $row['profesi']; ?></span>
                    </div>

                </a>

            </div>
        <?php } ?>

    </div>
</section>
