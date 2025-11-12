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

<header class="header">
  <section class="flex">
    <!-- LOGO + NAMA KLINIK -->
    <a href="index.php" class="logo"><img src="image/logo.png" alt="Beauty Clinic Logo"><span class="clinic-name">Beauty Clinic</span></a>
    <nav class="navbar">
      <a href="home.php">home</a>
      <a href="about.php">about us</a>
      <a href="services.php">services</a>
      <a href="team.php">team</a>
      <a href="book_appointment.php">appointment</a>
      <a href="contact.php">contact</a>
    </nav>

    <!-- ICONS KANAN -->
    <div class="icons">
      <div id="menu-btn" class="bx bx-list-plus"></div>
      <div id="search-btn" class="bx bx-search"></div>
      <div id="user-btn" class="bx bxs-user"></div>
    </div>

    <!-- PROFIL / LOGIN-REGISTER BOX -->
    <div class="profile">
      <?php if ($fetch_profile): ?>
        <img src="uploaded_files/<?= htmlspecialchars($fetch_profile['foto']); ?>" alt="User Logo">
        <h3><?= htmlspecialchars($fetch_profile['nama']); ?></h3>
        <div class="flex-btn">
          <a href="profile.php" class="btn">View Profile</a>
          <a href="components/user_logout.php" onclick="return confirm('Logout from this website?');" class="btn">Logout</a>
        </div>
      <?php else: ?>
        <img src="image/layer.jpg" alt="Guest Logo">
        <h3>Silahkan</h3>
        <div class="flex-btn">
          <a href="login.php" class="btn">Login</a>
          <a href="register.php" class="btn">Registrasi</a>
        </div>
      <?php endif; ?>
    </div>

  </section>
</header>

<!-- JS Toggle Profile -->
<script>
const userBtn = document.getElementById('user-btn');
const profileBox = document.querySelector('.profile');

userBtn.addEventListener('click', (e) => {
    e.stopPropagation(); // mencegah klik bubble
    profileBox.classList.toggle('active');
});

document.addEventListener('click', (e) => {
    if (!profileBox.contains(e.target) && !userBtn.contains(e.target)) {
        profileBox.classList.remove('active');
    }
});
</script>
