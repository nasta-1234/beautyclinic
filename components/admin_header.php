<header>
  <div class="logo">
    <img src="../image/logo.png" width="130">
</div>
<div class="right">
<div class="bx bxs-user" id="user-btn"></div>
<div class="bx bx-menu" id="toggle-btn"></div>
</div>
<div class="profile_detail">
<?php  

$select_profile = $conn->prepare("SELECT * FROM admin WHERE id = ?");
$select_profile->execute([$admin_id]);

if ($select_profile->rowCount() > 0){
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="profile">
  <img src="../uploaded_files/<?= $fetch_profile['foto']; ?>" class="logo-img">
  <p> <?= $fetch_profile['nama']; ?></p>
</div>
<div class="flex-btn">
  <a href="profile.php" class="btn"> profile </a>
  <a href="../components/admin_logout.php" onclick="return confirm('logout from this website');" class="btn">logout</a>
</div>
<?php

?>
</div>
</header>

<div class="sidebar">
  <div class="profile">
    <img src="../uploaded_files/<?= $fetch_profile['foto']; ?>" class="logo-img">
    <p> <?= $fetch_profile['nama']; ?></p>
</div>
<h5> menu </h5>
<div class="navbar">
  <ul>
    <li> <a href="dashboard.php"><i class="bx bxs-home-smile"></i>dashboard</a></li>
    <li> <a href="add_services.php"><i class="bx bxs-shopping-bags"></i>add services</a></li>
    <li> <a href="view_services.php"><i class="bx bxs-food-menu"></i>view services</a></li>
    <li> <a href="add_employee.php"><i class="bx bxs-shopping-bags"></i>add employee</a></li>
    <li> <a href="view_employee.php"><i class="bx bxs-food-menu"></i>view employee</a></li>
    <li> <a href="view_user.php"><i class="bx bxs-user-detail"></i>account</a></li>
    <li> <a href="../components/admin_logout.php" onclick="return confirm('logout from this website');"><i class="bx bxs-log-out"></i>logout</a></li>
</ul>
</div>
</div>