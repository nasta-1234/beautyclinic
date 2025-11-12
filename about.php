<?php
// Koneksi database
require_once __DIR__ . '/components/connect.php';

// Cek login
$id_pelanggan = isset($_COOKIE['id_pelanggan']) ? $_COOKIE['id_pelanggan'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NASTA Beauty Clinic</title>
<link rel="stylesheet" href="css/user_style.css">
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<?php include 'components/user_header.php'; ?>

<!-- home section start -->
 <div class="banner">
    <div class="detail">
        <h1>about us</h1>
            <p>Beauty Clinic adalah tempat perawatan kecantikan profesional yang menyediakan berbagai layanan mulai dari perawatan wajah,
            perawatan tubuh, hingga perawatan rambut dan kulit kepala. Kami berkomitmen memberikan pelayanan terbaik
            untuk menjaga keindahan dan kepercayaan diri Anda.</p>
        <span><a href="dashboard.php">Admin</a> <i class="bx bx-right-arrow-alt"></i> about us</span>
    </div>
</div>
<div class="who-container">
    <div class="box-container">
        <div class="box">
            <div class="heading">
                <span>siapa kita</span>
                <h1>kami bersemangat untuk membuat yang indah menjadi lebih indah</h1>
                <img src="image/logo.png" width="100">
            </div>
            <p></p>
            <div class="flex-btn">
                <a href="service.php" class="btn">jelajahi layanan kami</a>
                <a href="service.php" class="btn">kunjungi salon kami</a>
            </div>
        </div>
        <div class="img-box">
            <img src="image/slider.jpg" alt="About Us Image" class="img">
        </div>
    </div>
</div>

<div class="spa-offer">
    <div class="detail">
        <span>layanan baru</span>
        <h1>aromatherapy</h1>
        <h2>hemat 25%</h2>
        <a href="contact.php" class="btn">Hubungi kami</a>
    </div>
</div>
<div class="advntages">
    <div class="detail">
        <div class="heading">
            <span> keuntungan </span>
            <h1>mengapa orang memilih kami</h1>
            <img src="image/layer.jpg" width="100">
        </div>
        <div class="box-container">
            <div class="box">
                <i class="bx bxs-leaf"></i>
                <h1>Profesional & Berpengalaman</h1>
                <p>Tim ahli kami berpengalaman dalam berbagai jenis perawatan kecantikan, menjamin hasil terbaik.</p>
            </div>
            <div class="box">
                <i class="bx bxs-flask"></i>
                <h1>Peralatan Modern</h1>
                <p>Kami menggunakan teknologi dan peralatan terkini untuk kenyamanan dan keamanan pelanggan.</p>
            </div>
            <div class="box">
                <i class="bx bxs-droplet"></i>
                <h1>Layanan Lengkap</h1>
                <p>Dari perawatan wajah, tubuh, hingga rambut, semua tersedia di satu tempat.</p>
            </div>
            <div class="box">
                <i class="bx bxs-user"></i>
                <h1>Lingkungan Nyaman</h1>
                <p>Salon kami dirancang nyaman dan bersih, memberikan pengalaman relaksasi maksimal.</p>
            </div>
        </div>
    </div>
</div>
<div class="massage-offer">
    <div class="detail">
        <h1>DISKON 30%</h1>
        <span>Nikmati diskon spesial untuk semua jenis pijatan di Beauty Clinic</span>
        <p>Segera rasakan relaksasi dan kenyamanan dengan harga lebih hemat. Promo terbatas!</p>
        <a href="" class="btn">buat janji sekarang</a>
    </div>
</div>
<div class="spa-service">
    <div class="heading">
        <span>untuk klien kami</span>
        <h1>Layanan Spa Berkualitas Tinggi untuk Kenyamanan dan Kesehatan Anda</h1>
        <img src="image/layer.jpg" width="100">
        <p>Nikmati perawatan spa eksklusif dengan tenaga ahli profesional dan fasilitas terbaik, khusus untuk Anda.</p>
    </div>
    <div class="box-container">
        <div class="box">
            <img src="image/spa-1.jpg" >
            <h1>Paket Spa Premium</h1>
            <div class="diveder"><div class="separator"></div></div>
            <p>Nikmati perawatan spa eksklusif dengan relaksasi maksimal dan layanan profesional.</p>
            <p class="price"><del>$600.000</p>
        </div>
        <div class="box">
            <img src="image/spa-2.jpg" >
            <h1>Perawatan Anti-Penuaan (Anti-Aging)</h1>
            <div class="diveder"><div class="separator"></div></div>
            <p>Perawatan khusus untuk menjaga kekenyalan kulit, mengurangi kerutan, dan memberikan tampilan lebih muda dan segar.</p>
            <p class="price"><del>$500.000</p>
        </div>
        <div class="box">
            <img src="image/spa-3.jpg" >
            <h1>Hair Growth Treatment untuk Rambut Rontok</h1>
            <div class="diveder"><div class="separator"></div></div>
            <p>Perawatan khusus untuk rambut rontok, menutrisi akar rambut, merangsang pertumbuhan, dan menjaga kesehatan kulit kepala.</p>
            <p class="price"><del>$300.000</p>
        </div>
        <div class="box">
            <img src="image/spa-4.jpg" >
            <h1>Manikur & Pedikur Spa</h1>
            <div class="diveder"><div class="separator"></div></div>
            <p>Perawatan tangan dan kaki lengkap untuk menjaga kebersihan, kesehatan, serta tampilan kuku yang cantik dan rapi.</p>
            <p class="price"><del>$300.000</p>
        </div>
    </div>
</div>
<div class="offe-1">
    <div class="detail">
        <h1><span>50%</span>Diskon Spa Pasangan Pertama</h1>
        <p>Nikmati pengalaman spa romantis bersama pasangan Anda dengan harga spesial. Rasakan relaksasi dan kenyamanan dalam suasana yang intim dan menenangkan.</p>
        <a href="" class="btn">Buat Janji Sekarang</a>
    </div>
</div>
<div class="about">
    <div class="box-container">
        <div class="box">
            <div class="heding">
                <span>about company</span>
                <h1>NASTA Beauty Clinic</h1>
            </div>
        </div>
    </div>
</div>










<?php include 'components/user_footer.php'; ?>

<footer>
    <p>&copy; <?= date("Y"); ?> Beauty Clinic. All rights reserved.</p>
</footer>

<!-- Script tambahan -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/admin_script.js"></script>
<?php include 'components/alert.php'; ?>

<script>
let slides = document.querySelectorAll('.slider_slide');
let index = 0;

function showSlide(i) {
  slides.forEach((slide, idx) => {
    slide.style.display = idx === i ? 'block' : 'none';
  });
}

function nextSlide() {
  index = (index + 1) % slides.length;
  showSlide(index);
}

function prevSlide() {
  index = (index - 1 + slides.length) % slides.length;
  showSlide(index);
}

document.querySelector('.right-arrow').onclick = nextSlide;
document.querySelector('.left-arrow').onclick = prevSlide;

// tampilkan slide pertama
showSlide(index);

// auto-slide setiap 10 detik
setInterval(nextSlide, 10000);
</script>


</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Spa</title>

    <script>
        const labels = document.querySelectorAll('.label');
        labels.forEach(label => {
            label.addEventListener('click', () => {
                const contentBox = label.parentElement;
                contentBox.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
