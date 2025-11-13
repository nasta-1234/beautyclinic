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
<section class="home">
  <div class="slider">

    <!-- slide 1 -->
    <div class="slider_slide slide1">
      <div class="slider-detail">
        <p class="date">12 November 2025</p>
        <h1>Beauty Clinic</h1>
        <p>Selamat datang di NASTA Beauty Clinic, tempat di mana kecantikan dan kenyamanan berpadu sempurna! 
            Kami menghadirkan berbagai layanan perawatan wajah, rambut, dan tubuh dengan teknologi modern serta 
            produk terbaik untuk hasil maksimal. Bersama tim profesional kami, NASTA Beauty Clinic siap membantu kamu 
            tampil lebih percaya diri dan memancarkan pesona alami setiap hari.</p>
        <a href="services.php" class="btn">melihat layanan</a>
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
        <p>Selamat datang di NASTA Beauty Clinic, tempat di mana kecantikan dan kenyamanan berpadu sempurna! 
            Kami menghadirkan berbagai layanan perawatan wajah, rambut, dan tubuh dengan teknologi modern serta 
            produk terbaik untuk hasil maksimal. Bersama tim profesional kami, NASTA Beauty Clinic siap membantu kamu 
            tampil lebih percaya diri dan memancarkan pesona alami setiap hari.</p>
        <a href="services.php" class="btn">melihat layanan</a>
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
        <p>Selamat datang di NASTA Beauty Clinic, tempat di mana kecantikan dan kenyamanan berpadu sempurna! 
            Kami menghadirkan berbagai layanan perawatan wajah, rambut, dan tubuh dengan teknologi modern serta 
            produk terbaik untuk hasil maksimal. Bersama tim profesional kami, NASTA Beauty Clinic siap membantu kamu 
            tampil lebih percaya diri dan memancarkan pesona alami setiap hari.</p>
        <a href="services.php" class="btn">melihat layanan</a>
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
        <p>Selamat datang di NASTA Beauty Clinic, tempat di mana kecantikan dan kenyamanan berpadu sempurna! 
            Kami menghadirkan berbagai layanan perawatan wajah, rambut, dan tubuh dengan teknologi modern serta 
            produk terbaik untuk hasil maksimal. Bersama tim profesional kami, NASTA Beauty Clinic siap membantu kamu 
            tampil lebih percaya diri dan memancarkan pesona alami setiap hari.</p>
        <a href="services.php" class="btn">melihat layanan</a>
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
        <p>Selamat datang di NASTA Beauty Clinic, tempat di mana kecantikan dan kenyamanan berpadu sempurna! 
            Kami menghadirkan berbagai layanan perawatan wajah, rambut, dan tubuh dengan teknologi modern serta 
            produk terbaik untuk hasil maksimal. Bersama tim profesional kami, NASTA Beauty Clinic siap membantu kamu 
            tampil lebih percaya diri dan memancarkan pesona alami setiap hari.</p>
        <a href="services.php" class="btn">melihat layanan</a>
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
                <h1>untuk</h1><h1>Pria</h1>
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
        <a href="services.php" class="btn">melihat layanan kami</a>
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
                    <div href="services.php" class="btn">melihat layanan kami</div>
                </div>
            </div>
            <div class="box-detail">
                <img src="image/frame1.jpg" class="img">
                <div class="detail">
                    <span>jangkauan luas</span>
                    <h1>Perawatan Laser</h1>
                    <p>Solusi modern untuk kulit sehat dan bercahaya.</p>
                    <div href="services.php" class="btn">melihat layanan kami</div>
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
    <video src="image/vidio.jpg" autoplay loop></video>
    <div class="detail">
        <h1>BeautyClinic</h1>
        <p>Salon Beauty Clinic menghadirkan perawatan kecantikan profesional 
            dengan layanan lengkap untuk merawat wajah, rambut, dan tubuh Anda.</p>
        <p>Dengan suasana yang nyaman dan tenaga ahli berpengalaman, Salon Beauty Clinic 
            siap membantu Anda tampil cantik dan percaya diri setiap hari.</p>
        <div class="flex-btn">
            <a href="" class="btn">jelajahi lebih lanjut</a>
            <a href="about.php" class="btn">lebih banyak tentang kita</a>
        </div>
    </div>
</div>

<div class="center">
    <div class="heading">
        <span>menjagamu</span>
        <h1>professional <br> pusat perawatan tubuh & pijat</h1>
        <img src="image/layer.jpg">
    </div>
    <div class="box-container">
        <div class="box">
            <img src="image/center.jpg">
            <span>produk terbaik</span>
            <h1>janji temu online</h1>
            <p>Pesan jadwal perawatan Anda secara online dengan mudah melalui website kami dan nikmati layanan eksklusif di Salon Beauty Clinic.</p>
        </div>
        <div class="box">
            <img src="image/center0.jpg">
            <span>produk terbaik</span>
            <h1>kartu hadiah tersedia</h1>
            <p>Berikan sentuhan kecantikan sebagai hadiah istimewa! Kartu hadiah Salon Beauty Clinic kini tersedia untuk orang tersayang.</p>
        </div>
        <div class="box">
            <img src="image/center1.jpg">
            <span>produk terbaik</span>
            <h1>penawaran khusus</h1>
            <p>Penawaran khusus menanti Anda, rasakan perawatan premium dengan harga istimewa hanya di Salon Beauty Clinic.</p>
        </div>
        <div class="box">
            <img src="image/center2.jpg">
            <span>produk terbaik</span>
            <h1>perlakuan khusus</h1>
            <p>Rasakan perlakuan khusus dari tim profesional kami yang siap memanjakan Anda dengan layanan terbaik</p>
        </div>
    </div>
</div>
<div class="offer">
    <div class="detail">
        <h1>Dibutuhkan Tangan Profesional <br> untuk menghilangkan stres harian Anda....</h1>
        <p>Serahkan perawatan Anda pada tenaga profesional kami dan rasakan sensasi relaksasi yang menenangkan setiap harinya.</p>
        <a href="" class="btn">Buat Janji Sekarang</a>
    </div>
</div>
<div class="accordion">
        <div class="contentBox">
            <div class="label">1. Bagaimana cara saya membuat janji temu?</div>
            <div class="content">
                Anda dapat membuat janji temu dengan menghubungi pihak spa melalui nomor kontak yang tersedia atau menggunakan fitur pemesanan online pada website kami.
            </div>
        </div>

        <div class="contentBox">
            <div class="label">2. Apa saja layanan yang tersedia di spa ini?</div>
            <div class="content">
                Kami menyediakan berbagai layanan seperti pijat relaksasi, facial, body scrub, aromaterapi, dan perawatan tubuh lainnya untuk meningkatkan kenyamanan Anda.
            </div>
        </div>

        <div class="contentBox">
            <div class="label">3. Apakah saya bisa membatalkan janji yang sudah dibuat?</div>
            <div class="content">
                Ya, Anda dapat membatalkan atau mengubah jadwal janji temu minimal 24 jam sebelum waktu yang telah ditentukan dengan menghubungi customer service kami.
            </div>
        </div>

        <div class="contentBox">
            <div class="label">4. Apakah spa ini menerima pembayaran non-tunai?</div>
            <div class="content">
                Kami menerima berbagai metode pembayaran seperti kartu debit/kredit, transfer bank, serta dompet digital seperti GoPay dan OVO.
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
