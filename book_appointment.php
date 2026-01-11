<?php
session_start();
require_once __DIR__ . '/components/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   $insert = $conn->prepare("
      INSERT INTO janji 
      (id_user, nama, no_telp, email, id_layanan, id_karyawan, tanggal, jam, harga, status, status_pembayaran)
      VALUES (?,?,?,?,?,?,?,?,?,?,?)
   ");

   $insert->execute([
      $_POST['id_user'],
      $_POST['nama'],
      $_POST['no_telp'],
      $_POST['email'],
      $_POST['id_layanan'],
      $_POST['id_karyawan'],
      $_POST['tanggal'],
      $_POST['jam'],
      $_POST['harga'],
      $_POST['status'],
      $_POST['status_pembayaran']
   ]);

   header('location: user/profile.php');
   exit;
}
