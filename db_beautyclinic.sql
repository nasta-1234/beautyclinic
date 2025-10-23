-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 01:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_beautyclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `foto`) VALUES
('apD5YrVpdu9OCgIPpEmp', 'najwa', 'sabiranajwa76@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'aeBTzMXaJGU2q00ZAO5F.jpg'),
('lsmqHuLKFmN2o16B8Pid', 'ALFI RESTI ZELIA', 'alfirestizelia@gmail.com', '87b415be0a6e0e827ac6620b18242b4a13508481', 'AmwuyAej8e28XWnGbHs0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `janji`
--

CREATE TABLE `janji` (
  `id_janji` varchar(20) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telp` char(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_layanan` varchar(20) NOT NULL,
  `id_karyawan` varchar(20) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `harga` int(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` char(20) NOT NULL,
  `deskripsi_profil` text NOT NULL,
  `profil` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `pekerjaan`, `email`, `no_telp`, `deskripsi_profil`, `profil`, `status`) VALUES
('1', 'ALFI RESTI ZELIA', 'Dokter Kecantikan', 'alfirestizelia@gmail.com', '085231978234', 'tenaga medis profesional yang memiliki keahlian dalam merawat kesehatan dan estetika kulit, rambut, dan tubuh. Tugasnya meliputi konsultasi kesehatan kulit, mendiagnosis masalah kulit, memberikan perawatan medis dan non-medis seperti facial medis, laser treatment, filler, botox, serta merekomendasikan produk perawatan yang sesuai. Selain mempercantik penampilan, dokter kecantikan juga memastikan setiap prosedur aman, efektif, dan sesuai dengan kondisi kesehatan pasien.', '68f355e14e752.jpg', 'aktif'),
('2', 'TENA ERFIANA', 'Dokter Kecantikan', 'tenaerfiana25@gmail.com', '082434567842', 'tenaga medis profesional yang memiliki keahlian dalam merawat kesehatan dan estetika kulit, rambut, dan tubuh. Tugasnya meliputi konsultasi kesehatan kulit, mendiagnosis masalah kulit, memberikan perawatan medis dan non-medis seperti facial medis, laser treatment, filler, botox, serta merekomendasikan produk perawatan yang sesuai. Selain mempercantik penampilan, dokter kecantikan juga memastikan setiap prosedur aman, efektif, dan sesuai dengan kondisi kesehatan pasien.', '68f355ff01464.jpg', 'aktif'),
('3', 'NAJWA SABHIRA', 'Dokter Kecantikan', 'sabiranajwa76@gmail.com', '089674564345', 'tenaga medis profesional yang memiliki keahlian dalam merawat kesehatan dan estetika kulit, rambut, dan tubuh. Tugasnya meliputi konsultasi kesehatan kulit, mendiagnosis masalah kulit, memberikan perawatan medis dan non-medis seperti facial medis, laser treatment, filler, botox, serta merekomendasikan produk perawatan yang sesuai. Selain mempercantik penampilan, dokter kecantikan juga memastikan setiap prosedur aman, efektif, dan sesuai dengan kondisi kesehatan pasien.', '68f35622b1cf4.jpg', 'aktif'),
('4', 'SASI MAELANI', 'Dokter Kecantikan', 'sasimaelani@gmail.com', '083156748965', 'tenaga medis profesional yang memiliki keahlian dalam merawat kesehatan dan estetika kulit, rambut, dan tubuh. Tugasnya meliputi konsultasi kesehatan kulit, mendiagnosis masalah kulit, memberikan perawatan medis dan non-medis seperti facial medis, laser treatment, filler, botox, serta merekomendasikan produk perawatan yang sesuai. Selain mempercantik penampilan, dokter kecantikan juga memastikan setiap prosedur aman, efektif, dan sesuai dengan kondisi kesehatan pasien.', '68f35641d5b8f.jpg', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `detail_layanan` text NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama`, `harga`, `foto`, `detail_layanan`, `kategori`, `status`) VALUES
('1Hq4XeroTy6KlIk9ggJN', 'Hair Treatment', 150, 'fIWsweXYr5I6i8QMzDdE.jpg', 'Menutrisi rambut kering, rusak, atau bercabang.\r\n\r\nBisa menambahkan vitamin atau protein untuk perbaikan rambut.', 'Perawatan Rambut dan Kulit Kepala', 'active'),
('8m1gBBdHnAHH10msJmMY', 'Manicure & Pedicure', 100, 'qsY7FjqadxfnuTnVM4TZ.jpg', 'Membersihkan, merapikan, dan merawat kuku tangan/kaki.\r\n\r\nBisa ditambahkan cat kuku atau nail art.', 'Perawatan Kuku- Tangan dan Kaki', 'active'),
('cX8c0ixkU2jUJu8Sy73d', 'Konsultasi Kulit / Analisa Kulit', 500, 'JgEE93gZq0lqwEpXmSUq.jpg', 'Menentukan jenis kulit dan perawatan yang tepat.\r\n\r\nBisa berupa skin test atau saran perawatan harian.', 'Konsultasi dan Produk Perawatan', 'active'),
('iKQokvl1KGobYcJjz1vN', 'facial treatment', 200, 'woJ4wKNKQrk7gTXrV7hh.jpg', 'Facial treatment adalah perawatan wajah yang bertujuan untuk menjaga kesehatan dan kecantikan kulit dengan membersihkan, menutrisi, serta memperbaiki kondisi kulit wajah. Prosedur ini biasanya meliputi pembersihan mendalam, eksfoliasi untuk mengangkat sel kulit mati, pemijatan wajah untuk melancarkan peredaran darah, serta penggunaan masker dan serum sesuai jenis kulit. Manfaat facial treatment antara lain membantu mengatasi masalah seperti jerawat, kulit kusam, komedo, penuaan dini, dan kulit kering, sehingga wajah tampak lebih segar, lembap, dan bercahaya. Perawatan ini bisa dilakukan di klinik kecantikan atau salon dengan bantuan tenaga profesional agar hasilnya maksimal dan aman.', 'Perawatan Wajah', 'active'),
('OaOxZj6dyuHPVLvLvosU', 'Hair Spa', 150, 'BKvMVITM3EiGzAr6ycvF.jpg', 'Membersihkan kulit kepala, mengurangi ketombe, dan menyehatkan akar rambut.\r\n\r\nMemberikan relaksasi dan meningkatkan sirkulasi darah di kulit kepala.', 'Perawatan Rambut dan Kulit Kepala', 'active'),
('SXI7Km3BXHf5FU3wPBDD', 'laser treatment', 350, 'Dqc2RYTlclQJ5PrqEA3k.jpg', 'laser treatment adalah perawatan kecantikan yang menggunakan teknologi laser untuk memperbaiki kondisi kulit atau tubuh, seperti menghilangkan bulu secara permanen, meremajakan kulit, mengurangi jerawat dan bekasnya, serta mencerahkan noda hitam atau flek. Perawatan ini biasanya cepat, minim rasa sakit, dan hasilnya lebih tahan lama dibanding metode manual, meskipun diperlukan beberapa sesi untuk hasil optimal, seringkali dikombinasikan dengan perawatan pendukung seperti serum atau krim khusus.', 'Perawatan Wajah', 'active'),
('vlaindL7YuudDLKP5j7m', 'Body Massage', 300, 'E9Rcc5aWCgsGZKUnv3nF.jpg', 'Mengurangi stres, nyeri otot, dan ketegangan tubuh.\r\n\r\nBisa menggunakan minyak aromaterapi atau hot stone.', 'Perawatan Tubuh', 'active'),
('wIpFggQrjky1FGNICDUn', 'Peeling', 200, 'B0jjdLA3YalIOxCWADNr.jpg', 'Mengangkat sel kulit mati untuk regenerasi kulit lebih cepat.\r\n\r\nMengurangi noda hitam, bekas jerawat, dan kulit kusam.', 'Perawatan Wajah', 'active'),
('wqn0edPNI8sK22Qx6MRf', 'Produk Perawatan', 500, '6qk3refMuEMOqdQ9TMLI.jpg', 'Serum, cream, masker, lulur, dan perawatan rambut yang direkomendasikan oleh klinik.', 'Konsultasi dan Produk Perawatan', 'active'),
('WVYJx5JkMwuNP31w3mBG', 'botox', 500, '4GDlXmrVYkCD6L5Pruog.jpg', 'nclchkchskc,sdhx', 'Perawatan Wajah', 'active'),
('XHYBVrpWCaHV4l9imOCd', 'Spa Kaki', 100, 'u1bwHKITOQe4nSfymbxz.jpg', 'Meredakan pegal, melembapkan kulit, dan meningkatkan sirkulasi.', 'Perawatan Rambut dan Kulit Kepala', 'active'),
('Y60ycZ3f28RdNkHfiDIO', 'Body Whitening', 300, 'TQQmnA8Ulj8yelOqH6Nv.png', 'Perawatan untuk mencerahkan kulit tubuh secara bertahap.\r\n\r\nBiasanya berupa lulur khusus atau perawatan laser ringan.', 'Perawatan Tubuh', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(100) NOT NULL,
  `pesanan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `janji`
--
ALTER TABLE `janji`
  ADD PRIMARY KEY (`id_janji`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
