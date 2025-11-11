<?php
require_once '../components/connect.php';
session_start();

// Cek apakah admin sudah login
if(!isset($_SESSION['admin_id'])){
   header('location:admin_login.php');
   exit();
}

// Ambil data booking massage dari database
$query = $conn->query("SELECT * FROM booking_massage ORDER BY tanggal_booking DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Data Booking Massage | Admin BeautyClinic</title>
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      body {
         background: #f6f8fb;
         font-family: 'Poppins', sans-serif;
      }
      .container {
         max-width: 1000px;
         margin: 30px auto;
         background: #fff;
         border-radius: 12px;
         padding: 20px;
         box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      }
      h1 {
         text-align: center;
         color: #333;
         margin-bottom: 20px;
      }
      table {
         width: 100%;
         border-collapse: collapse;
         font-size: 14px;
      }
      th, td {
         border: 1px solid #ddd;
         padding: 10px;
         text-align: center;
      }
      th {
         background-color: #f4f4f4;
         color: #333;
      }
      tr:hover {
         background-color: #f9f9f9;
      }
      .btn-delete {
         color: #fff;
         background: #e74c3c;
         padding: 5px 10px;
         border-radius: 5px;
         text-decoration: none;
      }
      .btn-delete:hover {
         background: #c0392b;
      }
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="container">
   <h1>Daftar Booking Massage</h1>
   <table>
      <thead>
         <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Jenis Massage</th>
            <th>Tanggal Booking</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php
         if($query->num_rows > 0){
            $no = 1;
            while($row = $query->fetch_assoc()){
               echo "<tr>
                     <td>{$no}</td>
                     <td>{$row['nama_pelanggan']}</td>
                     <td>{$row['jenis_massage']}</td>
                     <td>{$row['tanggal_booking']}</td>
                     <td>{$row['jam_booking']}</td>
                     <td>{$row['status']}</td>
                     <td>
                        <a href='delete_booking.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Hapus booking ini?\");'>Hapus</a>
                     </td>
                  </tr>";
               $no++;
            }
         } else {
            echo "<tr><td colspan='7'>Belum ada data booking massage.</td></tr>";
         }
         ?>
      </tbody>
   </table>
</div>

</body>
</html>
