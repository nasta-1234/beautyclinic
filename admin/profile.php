<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    header('location:login.php');
    exit();
}

// Daftar admin manual
$admins = [
    [
        'nama' => 'Dokter Tena',
        'email' => 'tenaerfiana25@email.com',
        'foto' => 'dokter_tena.jpg',
        'jabatan' => 'Dokter Kecantikan',
        'spesialis' => 'Facial & Skin Care',
        'jadwal' => 'Senin - Jumat, 09:00 - 17:00'
    ],
    [
        'nama' => 'Dokter Alfi',
        'email' => 'alfirestizelia@email.com',
        'foto' => 'dokter_alfi.jpg',
        'jabatan' => 'Dokter Kecantikan',
        'spesialis' => 'Anti-aging & Injectables',
        'jadwal' => 'Selasa - Sabtu, 10:00 - 18:00'
    ],
    [
        'nama' => 'Dokter Najwa',
        'email' => 'sabhiranajwa@email.com',
        'foto' => 'dokter_najwa.jpg',
        'jabatan' => 'Dokter Kecantikan',
        'spesialis' => 'Laser & Body Treatments',
        'jadwal' => 'Senin - Kamis, 09:00 - 16:00'
    ],
    [
        'nama' => 'Dokter Sasi',
        'email' => 'sasimaelani@email.com',
        'foto' => 'dokter_sasi.jpg',
        'jabatan' => 'Dokter Kecantikan',
        'spesialis' => 'Dermatologi & Konsultasi Kulit',
        'jadwal' => 'Rabu - Minggu, 10:00 - 19:00'
    ],
];

// Default foto jika file tidak ada
$default_photo = '/beautyclinic/images/default-user.png';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Admin - NASTA Beauty Clinic</title>
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
<style>
body {
    background: #fff0f5;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    overflow-y: auto;
}
.banner {
    background: linear-gradient(135deg, #ffb6c1, #ff69b4);
    padding: 60px 20px;
    color: #fff;
    text-align: center;
    border-radius: 0 0 40px 40px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.banner h1 {
    font-size: 2.4em;
    margin-bottom: 10px;
    letter-spacing: 1px;
}
.banner p {
    font-size: 1.1em;
    max-width: 700px;
    margin: 0 auto;
}
section.profile-container {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    justify-content: center;
    padding: 40px 20px;
}
.profile-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    width: 280px;
    padding: 20px;
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.profile-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}
.profile-card img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
    border: 3px solid #ff69b4;
}
h3 {
    color: #d63384;
    margin: 10px 0 4px;
    font-size: 1.3em;
}
p {
    color: #555;
    margin: 5px 0;
    font-size: 0.95em;
}
.role, .spesialis, .jadwal {
    font-size: 0.9em;
    color: #333;
}
</style>
</head>
<body>
<?php include '../components/admin_header.php'; ?>

<section class="banner">
    <h1>Tim Admin Profesional NASTA Beauty Clinic 💖</h1>
    <p>
        Mereka adalah wajah di balik kesempurnaan layanan kami — para profesional yang siap
        membantu mengelola kecantikan dan kenyamanan Anda dengan senyum ramah dan penuh dedikasi.
    </p>
</section>

<section class="profile-container">
    <?php foreach ($admins as $admin): ?>
        <div class="profile-card">
            <?php 
                $img_path = '/beautyclinic/uploaded_files/' . $admin['foto'];
            ?>
            <img src="<?= htmlspecialchars($img_path); ?>" 
                 onerror="this.src='<?= $default_photo ?>';" alt="Foto Admin">
            <h3><?= htmlspecialchars($admin['nama']); ?></h3>
            <p class="role"><b>Jabatan:</b> <?= htmlspecialchars($admin['jabatan']); ?></p>
            <p class="spesialis"><b>Spesialis:</b> <?= htmlspecialchars($admin['spesialis']); ?></p>
            <p class="jadwal"><b>Jadwal:</b> <?= htmlspecialchars($admin['jadwal']); ?></p>
            <p><b>Email:</b> <?= htmlspecialchars($admin['email']); ?></p>
        </div>
    <?php endforeach; ?>
</section>

<?php include '../components/admin_footer.php'; ?>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>



</html>
