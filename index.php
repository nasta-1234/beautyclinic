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
<title>Beauty Clinic - Home</title>
<link rel="stylesheet" href="css/user_style.css">
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<?php include 'components/user_header.php'; ?>

<!-- home section start -->
<section class="home">
  <div class="slider">

    <!-- slide 1 -->
    <div class="slider_slide slide1">
      <div class="slider-detail">
        <p class="date">12 November 2025</p>
        <h1>Beauty Clinic</h1>
        <p>Perawatan Kecantikan Terbaik untuk Anda!</p>
        <a href="service.php" class="btn">melihat layanan</a>
      </div>
      <div class="right-dec-top"></div>
      <div class="right-dec-bottom"></div>
      <div class="left-dec-top"></div>
      <div class="left-dec-bottom"></div>
    </div>

    <!-- slide 2 -->
    <div class="slider_slide slide2">
      <div class="slider-detail">
        <p class="date">12 November 2025</p>
        <h1>Beauty Clinic</h1>
        <p>Perawatan Kecantikan Terbaik untuk Anda!</p>
        <a href="service.php" class="btn">melihat layanan</a>
      </div>
      <div class="right-dec-top"></div>
      <div class="right-dec-bottom"></div>
      <div class="left-dec-top"></div>
      <div class="left-dec-bottom"></div>
    </div>

    <!-- slide 3 -->
    <div class="slider_slide slide3">
      <div class="slider-detail">
        <p class="date">12 November 2025</p>
        <h1>Beauty Clinic</h1>
        <p>Perawatan Kecantikan Terbaik untuk Anda!</p>
        <a href="service.php" class="btn">melihat layanan</a>
      </div>
      <div class="right-dec-top"></div>
      <div class="right-dec-bottom"></div>
      <div class="left-dec-top"></div>
      <div class="left-dec-bottom"></div>
    </div>

    <!-- slide 4 -->
    <div class="slider_slide slide4">
      <div class="slider-detail">
        <p class="date">12 November 2025</p>
        <h1>Beauty Clinic</h1>
        <p>Perawatan Kecantikan Terbaik untuk Anda!</p>
        <a href="service.php" class="btn">melihat layanan</a>
      </div>
      <div class="right-dec-top"></div>
      <div class="right-dec-bottom"></div>
      <div class="left-dec-top"></div>
      <div class="left-dec-bottom"></div>
    </div>

    <!-- slide 5 -->
    <div class="slider_slide slide5">
      <div class="slider-detail">
        <p class="date">12 November 2025</p>
        <h1>Beauty Clinic</h1>
        <p>Perawatan Kecantikan Terbaik untuk Anda!</p>
        <a href="service.php" class="btn">melihat layanan</a>
      </div>
      <div class="right-dec-top"></div>
      <div class="right-dec-bottom"></div>
      <div class="left-dec-top"></div>
      <div class="left-dec-bottom"></div>
    </div>

    <!-- arrows -->
    <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
    <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>

  </div>
</section>
<!-- home section end -->

<div class="for">
    <div class="box-container">
        <div class="box">
            <img src="image/him.jpg">
            <div class="detail">
                <h1>untu</h1><h1>Pria</h1>
            </div>
        </div>
        <div class="box">
            <img src="image/her.jpg">
            <div class="detail">
                <h1>untuk</h1><h1>Perempuan</h1>
            </div>
        </div>
        <div class="box">
            <img src="image/couple.jpg">
            <div class="detail">
                <h1>untuk</h1><h1>Berpasangan</h1>
            </div>
        </div>
    </div>
</div>
<div class="service">
    <div class="heading">
        <h1>layanan kami</h1>
    </div>
    <div class="box-container">
        <div class="box">
            <div class="icon">
                <div class="icon-box">
                    <img src="image/service-icon.png" class="img1">
                </div>
            </div>
            <div class="detail">
                <h4>Perawatan Wajah</h4>
            </div>
        </div>
        <div class="box">
            <div class="icon">
                <div class="icon-box">
                    <img src="image/service-icon0.png" class="img1">
                </div>
            </div>
            <div class="detail">
                <h4>Perawatan Tubuh</h4>
            </div>
        </div>
        <div class="box">
            <div class="icon">
                <div class="icon-box">
                    <img src="image/service-icon1.png" class="img1">
                </div>
            </div>
            <div class="detail">
                <h4>Perawatan Rambut dan Kulit Kepala</h4>
            </div>
        </div>
    </div>
    <div class="detail">
        <p>Penata gaya utama kami yang sangat berbakat akan terhubung dengan Anda secara personal, menggabungkan kreativitas dan keterampilan mereka untuk menciptakan gaya alami siap pakai sekaligus memberikan perawatan wajah, perawatan tubuh, serta perawatan rambut dan kulit kepala yang menonjolkan individualitas dan gaya hidup Anda.</p>
        <a href="service.php" class="btn">melihat layanan kami</a>
    </div>
</div>
<img src="image/sub-banner.jpg" class="sub-banner">

<div class="frame-container">
    <div class="box-container">
        <div class="box">
            <div class="box-detail">
                <img src="image/frame.png" class="img">
                <div class="detail">
                    <span>jangkauan luas </span>
                    <h1>spa & pijat</h1>
                    <p>Rasakan relaksasi menyeluruh dengan perawatan spa terbaik kami.</p>
                    <div href="service.php" class="btn">melihat layanan kami</div>
                </div>
            </div>
            <div class="box-detail">
                <img src="image/frame1.jpg" class="img">
                <div class="detail">
                    <span>jangkauan luas</span>
                    <h1>Perawatan Laser</h1>
                    <p>Solusi modern untuk kulit sehat dan bercahaya.</p>
                    <div href="service.php" class="btn">melihat layanan kami</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about-us">
    <div class="box-container">
        <div class="img-box">
            <img src="image/choose.jpg" class="img">
            <img src="image/choose0.jpg" class="img1">
            <div class="play"><i class="bx bx-play"></i></div>
        </div>
        <div class="box">
            <div class="heading">
                <span>mengapa memilih kami?</span>
                <h1>mengapa NASTA_BeautyClinic?</h1>
                <img src="image/logo.png" alt="" width="100">
            </div>
            <p>Pekerjaan yang dilakukan dengan kesadaran dan tujuan memberi kepuasan sejati. 
                Mengabaikan tanggung jawab melemahkan diri, sementara memahami keinginan kita 
                membuat setiap langkah lebih bermakna</p>
            <a href="about.php" class="btn"> tahu lebih banyak</a>
            <a href="contact.php" class="btn">Hubungi kami</a>
        </div>
    </div>
</div>

<div class="vid-banner">
    <div class="overaly"> </div>
    <video src="image/vidio.mp" autoplay loop></video>
    <div class="detail">
        <h1>BeautyClinic</h1>
        <p></p>
        <p></p>
        <div class="flex-btn">
            <a href="" class="btn">jelajahi lebih lanjut</a>
            <a href="about.php" class="btn">lebih banyak tentang kita</a>
        </div>
    </div>

</div>






<!-- Hero Section -->
<section class="hero">
    <h2>Selamat Datang di Beauty Clinic<br>Perawatan Kecantikan Terbaik untuk Anda!</h2>
</section>

<!-- Tentang Kami -->
<section class="content">
    <h3>Tentang Kami</h3>
    <p>
        Beauty Clinic adalah tempat perawatan kecantikan profesional yang menyediakan berbagai layanan mulai dari perawatan wajah,
        perawatan tubuh, hingga perawatan rambut dan kulit kepala. Kami berkomitmen memberikan pelayanan terbaik
        untuk menjaga keindahan dan kepercayaan diri Anda.
    </p>
</section>

<!-- Footer -->
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
