<?php
session_start();
require_once __DIR__ . '/components/connect.php';

$id_user = $_SESSION['id_pelanggan'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <title>Book Appointment</title>
   <link rel="stylesheet" href="css/user_style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="appointment">

   <h1 class="heading">Book Appointment</h1>

   <form action="book_appointment.php" method="post" class="appointment-form">

      <div class="box-container">

         <div class="box">
            <label>Nama *</label>
            <input type="text" name="nama" required>
         </div>

         <div class="box">
            <label>No Telepon *</label>
            <input type="number" name="no_telp" required>
         </div>

         <div class="box">
            <label>Email *</label>
            <input type="email" name="email" required>
         </div>

         <div class="box">
            <label>Layanan *</label>
            <select name="id_layanan" required>
               <option value="">-- pilih layanan --</option>
               <option value="1">Facial</option>
               <option value="2">Creambath</option>
               <option value="3">Treatment Wajah</option>
            </select>
         </div>

         <div class="box">
            <label>Karyawan *</label>
            <select name="id_karyawan" required>
               <option value="">-- pilih karyawan --</option>
               <option value="1">Therapist A</option>
               <option value="2">Therapist B</option>
            </select>
         </div>

         <div class="box">
            <label>Tanggal *</label>
            <input type="date" name="tanggal" required>
         </div>

         <div class="box">
            <label>Jam *</label>
            <select name="jam" required>
               <option value="">-- pilih jam --</option>
               <option value="09:00">09:00</option>
               <option value="11:00">11:00</option>
               <option value="13:00">13:00</option>
               <option value="15:00">15:00</option>
            </select>
         </div>

      </div>

      <!-- nilai default -->
      <input type="hidden" name="id_user" value="<?= $id_user; ?>">
      <input type="hidden" name="harga" value="0">
      <input type="hidden" name="status" value="pending">
      <input type="hidden" name="status_pembayaran" value="belum bayar">

      <input type="submit" value="Book Appointment" class="btn">

   </form>

</section>

<?php include 'components/user_footer.php'; ?>
</body>
</html>
