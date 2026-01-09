<?php
// Koneksi ke database
include_once __DIR__ . '/connect.php';

// Cek apakah user login
$id_Pelanggan = isset($_COOKIE['id_pelanggan']) ? $_COOKIE['id_pelanggan'] : '';

// Inisialisasi variabel agar tidak Undefined
$fetch_profile = null;

// Ambil data user jika login
if ($id_Pelanggan) {
    $select_profile = $conn->prepare("SELECT * FROM pelanggan WHERE id_pelanggan = ?");
    $select_profile->execute([$id_Pelanggan]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
}
?>

<!-- CSS USER -->
<link rel="stylesheet" href="/beautyclinic/css/user_style.css">

<header class="header">
  <section class="flex">

    <!-- LOGO -->
    <a href="/beautyclinic/index.php" class="logo">
      <img src="/beautyclinic/image/logo.png" alt="Beauty Clinic Logo">
      <span class="clinic-name">Beauty Clinic</span>
    </a>

    <!-- NAVBAR -->
    <nav class="navbar">
      <a href="/beautyclinic/index.php">home</a>
      <a href="/beautyclinic/about.php">about us</a>
      <a href="/beautyclinic/services.php">services</a>
      <a href="/beautyclinic/team.php">team</a>
      <a href="/beautyclinic/book_appointment.php">appointment</a>
      <a href="/beautyclinic/contact.php">contact</a>
    </nav>

    <!-- ICONS -->
    <div class="icons">
      <div id="menu-btn" class="bx bx-list-plus"></div>
      <div id="search-btn" class="bx bx-search"></div>
      <div id="user-btn" class="bx bxs-user"></div>
    </div>

    <!-- PROFILE BOX -->
    <div class="profile">
      <?php if ($fetch_profile): ?>
        <img src="/beautyclinic/uploaded_files/<?= htmlspecialchars($fetch_profile['foto']); ?>" alt="User">
        <h3><?= htmlspecialchars($fetch_profile['nama']); ?></h3>
        <div class="flex-btn">
          <a href="/beautyclinic/user/profile.php" class="btn">View Profile</a>
          <a href="/beautyclinic/components/user_logout.php"
             onclick="return confirm('Logout from this website?');"
             class="btn">Logout</a>
        </div>
      <?php else: ?>
        <img src="/beautyclinic/image/layer.jpg" alt="Guest">
        <h3>Silahkan</h3>
        <div class="flex-btn">
          <a href="/beautyclinic/user/login.php" class="btn">Login</a>
          <a href="/beautyclinic/user/register.php" class="btn">Registrasi</a>
        </div>
      <?php endif; ?>
    </div>

  </section>
</header>

<!-- TOGGLE PROFILE -->
<script>
const userBtn = document.getElementById('user-btn');
const profileBox = document.querySelector('.profile');

userBtn.addEventListener('click', (e) => {
  e.stopPropagation();
  profileBox.classList.toggle('active');
});

document.addEventListener('click', (e) => {
  if (!profileBox.contains(e.target) && !userBtn.contains(e.target)) {
    profileBox.classList.remove('active');
  }
});
</script>
