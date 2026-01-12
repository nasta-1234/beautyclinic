<?php
session_start();
$conn = new PDO("mysql:host=localhost;dbname=db_beautyclinic","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['book'])){

    $id_user     = $_POST['id_user'];
    $nama        = $_POST['nama'];
    $no_telp     = $_POST['no_telp'];
    $email       = $_POST['email'];
    $id_layanan  = $_POST['id_layanan'];
    $id_karyawan = $_POST['id_karyawan'];
    $tanggal     = $_POST['tanggal'];
    $jam         = $_POST['jam'];
    $harga       = $_POST['harga'] ?? 0;

    // 🔍 CEK ID USER
    if(empty($id_user)){
        die('ID user kosong, silakan login ulang');
    }

   $stmt = $conn->prepare("
    INSERT INTO janji
    (id_user, nama, no_telp, email, id_layanan, id_karyawan, tanggal, jam, harga, status, status_pembayaran)
    VALUES (?,?,?,?,?,?,?,?,?, 'menunggu', 'belum')
");

$stmt->execute([
    $id_user,
    $nama,
    $no_telp,
    $email,
    $id_layanan,
    $id_karyawan,
    $tanggal,
    $jam,
    $harga
]);

    $success = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <title>Janji Temu</title>
   <link rel="stylesheet" href="css/user_style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="appointment-page">

   <h1 class="heading">Janji Temu</h1>

  <form action="book_appointment.php" method="post" class="appointment-card">

   <div class="form-grid">

      <div class="form-group">
         <label>Nama *</label>
         <input type="text" name="nama" required>
      </div>

      <div class="form-group">
         <label>Pembayaran *</label>
         <select name="status_pembayaran" required>
            <option value="belum">Bayar di Tempat</option>
            <option value="transfer">Transfer</option>
         </select>
      </div>

      <div class="form-group">
         <label>No Telepon *</label>
         <input type="text" name="no_telp" required>
      </div>

      <div class="form-group">
         <label>Dokter *</label>
         <select name="id_karyawan" required>
            <option value="">Pilih Dokter</option>
            <option value="1">dr. Najwa</option>
            <option value="2">dr. Alfi</option>
            <option value="3">dr. Tena</option>
            <option value="4">dr. Sasi</option>
         </select>
      </div>

      <div class="form-group">
         <label>Email *</label>
         <input type="email" name="email" required>
      </div>

      <div class="form-group">
         <label>Tanggal *</label>
         <input type="date" name="tanggal" required>
      </div>

      <div class="form-group">
         <label>Layanan *</label>
         <select name="id_layanan" required>
            <option value="">Pilih layanan</option>
            <option value="1">Facial</option>
            <option value="2">Creambath</option>
         </select>
      </div>

      <div class="form-group">
         <label>Jam *</label>
         <select name="jam" required>
            <option value="">Pilih Jam</option>
            <option value="09:00">09:00</option>
            <option value="11:00">11:00</option>
            <option value="13:00">13:00</option>
            <option value="15:00">15:00</option>
         </select>
      </div>

   </div>

   <!-- hidden -->
   <input type="hidden" name="id_user" value="<?= $_SESSION['id_pelanggan'] ?? ''; ?>">
   <input type="hidden" name="status" value="menunggu">

   <button type="submit" name="book" class="btn-appointment">
      Membuat Janji
   </button>

</form>
