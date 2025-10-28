<?php
if (!isset($conn)) {
    include 'connect.php';
}

if (!isset($admin_id)) {
    $admin_id = $_COOKIE['admin_id'] ?? ($_SESSION['admin_id'] ?? null);
}

$fetch_profile = null;
if ($admin_id) {
    $select_profile = $conn->prepare("SELECT * FROM admin WHERE id = ?");
    $select_profile->execute([$admin_id]);
    if ($select_profile->rowCount() > 0) {
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<header>
    <div class="logo">
        <img src="../image/logo.png" width="130">
    </div>
    <div class="right">
        <div class="bx bxs-user" id="user-btn"></div>
        <div class="bx bx-menu" id="toggle-btn"></div>
    </div>

    <div class="profile_detail">
        <?php if ($fetch_profile): ?>
            <div class="profile">
                <img src="../uploaded_files/<?= htmlspecialchars($fetch_profile['foto']); ?>" class="logo-img">
                <p><?= htmlspecialchars($fetch_profile['nama']); ?></p>
            </div>
            <div class="flex-btn">
                <a href="profile.php" class="btn">Profil</a>
                <a href="../components/admin_logout.php" onclick="return confirm('Logout dari website ini?')" class="btn">Logout</a>
            </div>
        <?php else: ?>
            <p style="padding: 10px; color: red;">Profil admin tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</header>

<div class="sidebar">
    <?php if ($fetch_profile): ?>
        <div class="profile">
            <img src="../uploaded_files/<?= htmlspecialchars($fetch_profile['foto']); ?>" class="logo-img">
            <p><?= htmlspecialchars($fetch_profile['nama']); ?></p>
        </div>
    <?php endif; ?>

    <h5>Menu</h5>
    <div class="navbar">
        <ul>
            <li><a href="dashboard.php"><i class="bx bxs-home-smile"></i> Dashboard</a></li>
            <li><a href="add_services.php"><i class="bx bxs-shopping-bags"></i> Tambah Layanan</a></li>
            <li><a href="view_services.php"><i class="bx bxs-food-menu"></i> Lihat Layanan</a></li>
            <li><a href="add_employee.php"><i class="bx bxs-user-plus"></i> Tambah Karyawan</a></li>
            <li><a href="view_employee.php"><i class="bx bxs-group"></i> Lihat Karyawan</a></li>
            <li><a href="user_account.php"><i class="bx bxs-user-detail"></i> Akun</a></li>
            <li><a href="../components/admin_logout.php" onclick="return confirm('Logout dari website ini?')"><i class="bx bxs-log-out"></i> Logout</a></li>
        </ul>
    </div>
</div>
