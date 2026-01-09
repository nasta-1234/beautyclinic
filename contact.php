<?php
// Koneksi database
require_once __DIR__ . '/components/connect.php';

// Cek login
$id_pelanggan = isset($_COOKIE['id_pelanggan']) ? $_COOKIE['id_pelanggan'] : '';
?>

<?php
require_once __DIR__ . '/components/connect.php';

$id_pelanggan = $_COOKIE['id_pelanggan'] ?? '';

$warning_msg = [];
$success_msg = [];

if(isset($_POST['send'])){

   if($id_pelanggan == ''){
      $warning_msg[] = 'please login first';
   }else{

      $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
      $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

      // Cek apakah pesan sama sudah dikirim
      $verify_msg = $conn->prepare(
         "SELECT * FROM `message` 
          WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ?"
      );
      $verify_msg->execute([$id_pelanggan, $name, $email, $subject, $message]);

      if($verify_msg->rowCount() > 0){
         $warning_msg[] = 'message already sent';
      }else{
         $insert_msg = $conn->prepare(
            "INSERT INTO `message`(user_id, name, email, subject, message) 
             VALUES(?,?,?,?,?)"
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
<?php
if(isset($warning_msg)){
   foreach($warning_msg as $msg){
      echo '<script>alert("'.$msg.'");</script>';
   }
}
if(isset($success_msg)){
   foreach($success_msg as $msg){
      echo '<script>alert("'.$msg.'");</script>';
   }
}
?>

<body>

<!-- Header -->
<?php include 'components/user_header.php'; ?>


<div class="banner">
    <div class="detail">
        <h1>Hubungi Kami</h1>
            <p>Hubungi kami untuk mendapatkan informasi lebih lanjut mengenai layanan kami. Tim kami siap membantu dan memberikan solusi yang sesuai dengan kebutuhan Anda.</p>
        <span><a href="index.php">home</a> <i class="bx bx-right-arrow-alt"></i>Hubungi Kami</span>
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
