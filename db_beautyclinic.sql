-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2025 at 01:03 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `foto`) VALUES
('apD5YrVpdu9OCgIPpEmp', 'najwa', 'sabiranajwa76@gmail.com', '6f27d168f94af9ed71dab4725a86bde9128974f0', 'aeBTzMXaJGU2q00ZAO5F.jpg'),
('lsmqHuLKFmN2o16B8Pid', 'ALFI RESTI ZELIA', 'alfirestizelia@gmail.com', '87b415be0a6e0e827ac6620b18242b4a13508481', 'AmwuyAej8e28XWnGbHs0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `janji`
--

CREATE TABLE `janji` (
  `id_janji` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` char(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_layanan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_karyawan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `jam` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status_pembayaran` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `pekerjaan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` char(20) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_profil` text COLLATE utf8mb4_general_ci NOT NULL,
  `profil` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
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
  `id_layanan` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail_layanan` text,
  `kategori` varchar(100) DEFAULT NULL,
  `status` enum('active','deactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama`, `harga`, `foto`, `detail_layanan`, `kategori`, `status`) VALUES
('layanan_6900b97a764187.53482060', 'Facial Glow Treatment', 150, 'foto_6900b97a760205.36696210.jpg', 'Perawatan wajah untuk mengangkat sel kulit mati, membersihkan komedo, dan mencerahkan kulit dengan masker vitamin C. Cocok untuk semua jenis kulit.', 'Perawatan Wajah', 'active'),
('layanan_6900c49c113f60.22139476', 'Peeling Facial Brightening', 200, 'foto_6900c49c10e1f7.77090093.jpg', 'Menggunakan bahan peeling alami untuk mengangkat sel kulit mati dan mempercepat regenerasi kulit. Hasilnya kulit tampak lebih halus dan cerah', 'Perawatan Wajah', 'active'),
('layanan_6900c4d3c1e7d9.91071165', 'Body Spa & Massage', 250, 'foto_6900c4d3c1add0.44443231.jpg', 'Relaksasi seluruh tubuh dengan pijat aromaterapi, lulur, dan mandi susu untuk melembutkan kulit dan mengurangi stres', 'Perawatan Tubuh', 'active'),
('layanan_6900c4fb27d7e4.72805253', 'Manicure-Pedicure Spa', 170, 'foto_6900c4fb279043.16526802.jpg', 'Membersihkan, menghaluskan, dan melembutkan kulit kaki dan tangan dengan rendaman aromaterapi serta scrub alami.', 'Perawatan Tubuh', 'deactive'),
('layanan_6900c523873a56.83297906', 'Konsultasi Dokter Kulit & Estetika', 100, 'foto_6900c52386efc0.30241720.jpg', 'Pemeriksaan kulit oleh dokter estetika profesional untuk menentukan jenis perawatan yang sesuai dengan kondisi kulit.', 'Perawatan Wajah', 'active'),
('layanan_6900c5508646c2.18072263', 'Whitening Injection', 400, 'foto_6900c55085ee98.83930709.png', 'Menutrisi kulit dari dalam menggunakan vitamin C dan kolagen untuk mencerahkan serta memperbaiki elastisitas kulit.', 'Perawatan Tubuh', 'active'),
('layanan_6900c57720b244.96339813', 'Natural Skincare Product Package', 200, 'foto_6900c577205d00.12051472.jpg', 'Paket perawatan kulit harian berisi day cream, night cream, toner, dan serum berbahan alami.', 'Perawatan Wajah', 'active'),
('layanan_6900c5b18aef21.65291845', 'Perawatan Wajah Anti-Aging', 300, 'foto_6900c5b18aa204.64247662.jpg', 'Menggunakan teknologi dan serum khusus untuk mengurangi garis halus, mencerahkan wajah, dan menjaga elastisitas kulit.', 'Perawatan Wajah', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pesanan` text COLLATE utf8mb4_general_ci NOT NULL
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
