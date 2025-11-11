<?php
include_once __DIR__ . '/connect.php';

if (isset($_COOKIE['id_pengguna'])) {
    $id_pengguna = $_COOKIE['id_pengguna'];
} else {
    $id_pengguna = '';
}
?>

<?php
include_once __DIR__ . '/connect.php';

if (isset($_COOKIE['user_id'])) {
  $user_id = $_COOKIE['user_id'];
} else {
  $user_id = '';
}
?>

<header class="header">
  <section class="flex">
    <!-- LOGO + NAMA KLINIK -->
    <a href="index.php" class="logo">
      <img src="image/logo.png" alt="Beauty Clinic Logo">
      <span class="clinic-name">Beauty Clinic</span>
    </a>

    <!-- SEARCH FORM -->
    <form action="search_service.php" method="post" class="search-from">
      <input type="text" name="search_service" placeholder="Search service..." maxlength="100" required>
      <button type="submit" class="bx bx-search-alt-2"></button>
    </form>

    <!-- ICONS KANAN -->
    <div class="icons">
      <div id="menu-btn" class="bx bx-list-plus"></div>
      <div id="search-btn" class="bx bx-search"></div>
      <div id="user-btn" class="bx bxs-user"></div>
    </div>

    <!-- PROFIL / LOGIN-REGISTER BOX -->
    <div class="profile">
      <?php 
      if ($user_id) {
        $select_profile = $conn->prepare("SELECT * FROM pelanggan WHERE id_pelanggan = ?");
        $select_profile->execute([$user_id]);
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
        <img src="uploaded_files/<?= htmlspecialchars($fetch_profile['foto']); ?>" alt="User">
        <h3><?= htmlspecialchars($fetch_profile['nama']); ?></h3>
        <div class="flex-btn">
          <a href="profile.php" class="btn">View Profile</a>
          <a href="components/user_logout.php" onclick="return confirm('Logout from this website?');" class="btn">Logout</a>
        </div>
      <?php } else { ?>
        <img src="image/layer.png" alt="Guest">
        <h3>Please login or register</h3>
        <div class="flex-btn">
          <a href="login.php" class="btn">Login</a>
          <a href="register.php" class="btn">Register</a>
        </div>
      <?php } ?>
    </div>
  </section>
</header>


<style>
/* ===== Header Minimalis Elegan ===== */
.header {
    background-color: #ffb6c1;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* Flex container */
.header .flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 30px;           /* tinggi total sekitar 55-60px */
}

/* Logo */
.logo img {
    width: 100px;
    height: auto;
}

/* Icons kanan */
.icons {
    display: flex;
    align-items: center;
    gap: 10px;
}

.icons i {
    color: white;
    font-size: 20px;
    cursor: pointer;
    transition: transform 0.2s, color 0.2s;
}

.icons i:hover {
    transform: scale(1.1);
    color: #fff0f5;
}

/* Profil popup (jika dipakai) */
.profile {
    display: none;
    position: absolute;
    top: 55px;
    right: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    padding: 12px;
    text-align: center;
    width: 210px;
}

.profile img {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 8px;
}

.profile h3 {
    font-size: 14px;
    margin-bottom: 8px;
}

.profile .btn {
    background-color: #ff69b4;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 12px;
    margin: 4px 0;
    display: inline-block;
}

.profile .btn:hover {
    background-color: #ff85c1;
}
</style>
