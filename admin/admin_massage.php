<?php
session_start();
require_once __DIR__ . '/../components/connect.php';

// proteksi admin
if (!isset($_COOKIE['admin_id'])) {
   header('location:admin_login.php');
   exit();
}

// ambil pesan
$select_msg = $conn->prepare("SELECT * FROM messages ORDER BY created_at DESC");
$select_msg->execute();
?>
<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <title>Pesan Masuk | Admin</title>
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<<div class="container">
   <h1>📩 Pesan Masuk</h1>

   <table class="styled-table">
      <thead>
         <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Subject</th>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
      <?php
      if ($select_msg->rowCount() > 0) {
         $no = 1;
         while ($row = $select_msg->fetch(PDO::FETCH_ASSOC)) {
      ?>
         <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['subject']; ?></td>
            <td class="message"><?= $row['message']; ?></td>
            <td><?= date('d M Y, H:i', strtotime($row['created_at'])); ?></td>
            <td>
               <a href="delete_message.php?id=<?= $row['id']; ?>"
                  onclick="return confirm('Hapus pesan ini?')"
                  class="btn-delete">Hapus</a>
            </td>
         </tr>
      <?php
         }
      } else {
         echo "<tr><td colspan='6'>Belum ada pesan masuk.</td></tr>";
      }
      ?>
      </tbody>
   </table>
</div>

</body>
</html>
