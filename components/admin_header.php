<?php
if (!isset($admin_id)) {
    $admin_id = '';
}
?>

<!-- ====== HEADER ====== -->
<header class="admin-header">
  <div class="menu-icon" id="menu-toggle">
    <i class='bx bx-menu'></i>
  </div>

  <h2 class="logo">BeautyClinic Admin</h2>

  <div class="profile" id="profile">
    <img src="../image/admin.png" alt="Admin">
    <div class="dropdown" id="dropdown">
      <a href="#">Profil</a>
      <a href="#">Pengaturan</a>
      <a href="../components/logout.php">Logout</a>
    </div>
  </div>
</header>

<!-- ====== SIDEBAR ====== -->
<aside class="sidebar" id="sidebar">
  <ul>
    <li><a href="dashboard.php"><i class='bx bx-home'></i> Dashboard</a></li>
    <li><a href="karyawan.php"><i class='bx bx-user'></i> Data Karyawan</a></li>
    <li><a href="layanan.php"><i class='bx bx-spa'></i> Layanan</a></li>
    <li><a href="laporan.php"><i class='bx bx-file'></i> Laporan</a></li>
  </ul>
</aside>

<!-- ====== CSS ====== -->
<style>
  body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: #fff6f9;
  }

  /* Header */
  .admin-header {
    background: #ff00c3;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
  }

  .menu-icon {
    font-size: 28px;
    cursor: pointer;
  }

  .logo {
    font-weight: 600;
  }

  /* Sidebar */
  .sidebar {
    position: fixed;
    top: 0;
    left: -250px;
    width: 250px;
    height: 100%;
    background: #fba7d1;
    padding-top: 70px;
    transition: 0.3s;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
  }

  .sidebar.active {
    left: 0;
  }

  .sidebar ul {
    list-style: none;
    padding: 0;
  }

  .sidebar ul li {
    padding: 12px 20px;
  }

  .sidebar ul li a {
    color: #333;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .sidebar ul li a:hover {
    background: #ffcee8;
    border-radius: 8px;
  }

  /* Profile dropdown */
  .profile {
    position: relative;
    cursor: pointer;
  }

  .profile img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
  }

  .dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 45px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    overflow: hidden;
  }

  .dropdown a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
  }

  .dropdown a:hover {
    background: #ffebf5;
  }
</style>

<!-- ====== SCRIPT ====== -->
<script>
  // Sidebar toggle
  const toggle = document.getElementById('menu-toggle');
  const sidebar = document.getElementById('sidebar');
  toggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
  });

  // Dropdown profil
  const profile = document.getElementById('profile');
  const dropdown = document.getElementById('dropdown');

  profile.addEventListener('click', () => {
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  });

  // Klik di luar dropdown menutup menu
  window.addEventListener('click', (e) => {
    if (!profile.contains(e.target)) {
      dropdown.style.display = 'none';
    }
  });
</script>
