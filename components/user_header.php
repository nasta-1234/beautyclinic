<?php
include_once 'connect.php';

if(!isset($id_pelanggan)){
    $id_pelanggan = '';
}
?>

<header class="header">
    <section class="flex">
        <a href="index.php" class="logo"><img src="image/logo.png" width="130"></a>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="about.php">about us</a>
            <a href="service.php">services</a>
            <a href="team.php">team</a>
            <a href="book_appointment.php">appointment</a>
            <a href="contact.php">contact</a>
        </nav>

        <form action="search_service" method="post" class="search-from">
            <input type="text" name="search_service" placeholder="search service.." required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" name="search_service_btn"></button>
        </form>

        <div class="icons">
            <div id="menu-btn" class="bx bx-list-plus"></div>
            <div id="search-btn" class="bx bx-search-alt-2"></div>
            <div id="user-btn" class="bx bxs-user"></div>
        </div>

        <div class="profile">
            <?php 
            $select_profile = $conn->prepare("SELECT * FROM pelanggan WHERE id_pelanggan = ?");
            $select_profile->execute([$id_pelanggan]);

            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
                <img src="uploaded_files/<?= htmlspecialchars($fetch_profile['foto']); ?>">
                <h3 style="margin-bottom: 1rem;"><?= htmlspecialchars($fetch_profile['nama']); ?></h3>
                <div class="flex-btn">
                    <a href="profile.php" class="btn">view profile</a>
                    <a href="components/user_logout.php" onclick="return confirm('Logout from this website?');" class="btn">logout</a>
                </div>
            <?php
            } else {
            ?>
                <img src="image/layer.png">
                <h3 style="margin-bottom: 1rem;">please login or register</h3>
                <div class="flex-btn">
                    <a href="login.php" class="btn">login</a>
                    <a href="register.php" class="btn">register</a>
                </div>
            <?php
            } // tutup if
            ?>
        </div>
    </section>
</header>
