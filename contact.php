<?php
session_start(); // HARUS PALING ATAS
require_once __DIR__ . '/components/connect.php';

// ambil login dari SESSION
$id_pelanggan = $_SESSION['id_pelanggan'] ?? '';

$warning_msg = [];
$success_msg = [];

if (isset($_POST['send'])) {

   if ($id_pelanggan == '') {
      $warning_msg[] = 'please login first';
   } else {

      // sanitasi input (aman & tidak deprecated)
      $name    = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
      $email   = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
      $subject = htmlspecialchars(trim($_POST['subject']), ENT_QUOTES, 'UTF-8');
      $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

      // cek pesan duplikat
      $verify_msg = $conn->prepare(
         "SELECT * FROM messages
          WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ?"
      );
      $verify_msg->execute([$id_pelanggan, $name, $email, $subject, $message]);

      if ($verify_msg->rowCount() > 0) {
         $warning_msg[] = 'message already sent';
      } else {

         $insert_msg = $conn->prepare(
            "INSERT INTO messages (user_id, name, email, subject, message)
             VALUES (?, ?, ?, ?, ?)"
         );
         $insert_msg->execute([$id_pelanggan, $name, $email, $subject, $message]);

         $success_msg[] = 'message sent successfully';
      }
   }
}
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

<?php if (!empty($success_msg)) : ?>
   <div class="toast success">
      💖 Pesan kamu berhasil terkirim!<br>
   </div>
<?php endif; ?>

<?php if (!empty($warning_msg)) : ?>
   <div class="toast error">
      😿 <?= $warning_msg[0]; ?>
   </div>
<?php endif; ?>

<!-- Header -->
<?php include 'components/user_header.php'; ?>

<div class="banner">
   <div class="detail">
      <h1>Hubungi Kami</h1>
      <p>
         Hubungi kami untuk mendapatkan informasi lebih lanjut mengenai layanan kami.
         Tim kami siap membantu dan memberikan solusi yang sesuai dengan kebutuhan Anda.
      </p>
      <span>
         <a href="index.php">home</a>
         <i class="bx bx-right-arrow-alt"></i>
         Hubungi Kami
      </span>
   </div>
</div>

<section class="contact">

   <div class="contact-title">
      <h2>Our Contact Details</h2>
      <p>Silakan hubungi kami untuk konsultasi atau pertanyaan lebih lanjut.</p>
   </div>

   <div class="contact-box">

      <div class="contact-info">

         <div class="info-card">
            <i class="bx bx-map"></i>
            <h3>Address</h3>
            <p>Jl. Ahmad Yani NO 10<br>Bandung</p>
         </div>

         <div class="info-card">
            <i class="bx bx-phone"></i>
            <h3>Phone Number</h3>
            <p>+62 812 3456 7890</p>
         </div>

         <div class="info-card">
            <i class="bx bx-envelope"></i>
            <h3>Email</h3>
            <p>nastabeauty@nastaclinic.com</p>
         </div>

      </div>

      <div class="contact-form">
         <form action="" method="post">
            <h3>Contact Us</h3>

            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" placeholder="Message" required></textarea>

            <input type="submit" name="send" value="Send Message" class="btn">
         </form>
      </div>

   </div>
</section>

<!-- Footer -->
<?php include 'components/user_footer.php'; ?>

<footer>
   <p>&copy; <?= date("Y"); ?> Beauty Clinic. All rights reserved.</p>
</footer>

</body>
</html>
