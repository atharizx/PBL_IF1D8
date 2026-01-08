-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2025 at 02:03 PM
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
-- Database: `pbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `nidn` varchar(10) NOT NULL,
  `pw` varchar(40) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `waktupenambahan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlog`
--

INSERT INTO `adminlog` (`nidn`, `pw`, `nama`, `role`, `waktupenambahan`, `id`) VALUES
('3312501117', '123456', 'SENA', 'admin', '2025-12-22 16:59:30', 1),
('3312501108', '12345678', 'Ihsan Jungler Plenger', 'dosen', '2025-12-23 16:55:32', 10),
('333333333', '123', 'Adrian', 'dosen', '2025-12-29 19:30:32', 15),
('1234567890', '12345678', 'ANJAYAAAA', 'dosen', '2025-12-29 19:57:02', 16),
('1234567888', 'atha123456', 'CUKIMAI', 'dosen', '2025-12-30 20:45:53', 17);

-- --------------------------------------------------------

--
-- Table structure for table `beasiswa`
--

CREATE TABLE `beasiswa` (
  `id` int NOT NULL,
  `namabeasiswa` varchar(255) NOT NULL,
  `deskripsi` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `masaberlaku` varchar(20) NOT NULL,
  `linkpendaftaran` varchar(255) NOT NULL,
  `fotobeasiswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `waktupenerbitan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beasiswa`
--

INSERT INTO `beasiswa` (`id`, `namabeasiswa`, `deskripsi`, `masaberlaku`, `linkpendaftaran`, `fotobeasiswa`, `waktupenerbitan`, `user_id`) VALUES
(69, 'Beasiswa Pertamina 2026', '<p>nigga</p>', '2025-12-30', 'https://docs.google.com/forms/d/e/1FAIpQLSfbHE_3lLuuhkbQsm-_EsaDLwp3rqxhDXUixZj3tsfzDTPY8Q/viewform?usp=dialog', 'Screenshot (128).png', '2025-12-30 12:25:20', 8),
(70, 'Beasiswa Pertamina 2026', '<p>1233131973173y131</p>\r\n<p>fdiandiaodno=adnaojdoadmoajdpoada</p>\r\n<p>adjaskdnijafeoiwjfoeiqbfioejwfiojnwoijfnwijfw</p>', '2025-12-30', 'https://docs.google.com/forms/d/e/1FAIpQLSfbHE_3lLuuhkbQsm-_EsaDLwp3rqxhDXUixZj3tsfzDTPY8Q/viewform?usp=dialog', 'Screenshot (129).png', '2025-12-30 12:42:42', 15),
(71, 'Beasiswa Vivo 2025', '<p>pepek</p>', '2025-12-30', 'https://docs.google.com/forms/d/e/1FAIpQLSfbHE_3lLuuhkbQsm-_EsaDLwp3rqxhDXUixZj3tsfzDTPY8Q/viewform?usp=dialog', 'Screenshot (155).png', '2025-12-30 14:11:15', 16),
(72, 'Beasiswa ITCampTraining', '<p>132323</p>', '2025-12-30', 'https://docs.google.com/forms/d/e/1FAIpQLSfbHE_3lLuuhkbQsm-_EsaDLwp3rqxhDXUixZj3tsfzDTPY8Q/viewform?usp=dialog', 'Screenshot (141).png', '2025-12-30 14:14:14', 16);

-- --------------------------------------------------------

--
-- Table structure for table `jadwalujian`
--

CREATE TABLE `jadwalujian` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `masaberlaku` date NOT NULL,
  `deskripsi` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `exceljadwal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fotojadwal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `waktupenerbitan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwalujian`
--

INSERT INTO `jadwalujian` (`id`, `judul`, `masaberlaku`, `deskripsi`, `jurusan`, `exceljadwal`, `fotojadwal`, `waktupenerbitan`, `user_id`) VALUES
(67, 'Jadwal Ujian Tengah Semester 2025', '2025-12-30', '<p>DESAIN</p>', 'Teknik Mesin', 'download (4).xlsx', '', '2025-12-30 12:37:26', 8),
(68, 'Jadwal Ujian Tengah Semester 2025', '2025-12-30', '<p>nigga</p>\r\n<p>nigga nigga nigga nigga</p>', 'Teknik Elektro', 'jadwal kuliah IF Pagi D (1).xlsx', '', '2025-12-30 12:40:13', 16);

-- --------------------------------------------------------

--
-- Table structure for table `perubahankelas`
--

CREATE TABLE `perubahankelas` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `masaberlaku` date NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `excelkelas` varchar(255) NOT NULL,
  `fotokelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `waktupenerbitan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perubahankelas`
--

INSERT INTO `perubahankelas` (`id`, `judul`, `deskripsi`, `masaberlaku`, `jurusan`, `excelkelas`, `fotokelas`, `waktupenerbitan`, `user_id`) VALUES
(29, 'Perubahan Ruangan Ujian Tengah Semester 2025', '<p>BABI</p>', '2025-12-30', 'Teknik Informatika', 'jadwal kuliah IF Pagi D (1).xlsx', '', '2025-12-30 12:37:47', 8),
(30, 'Perubahan Ruangan ', '<p>NEGGGA</p>', '2025-12-30', 'Teknik Mesin', 'jadwal kuliah IF Pagi D (1).xlsx', 'WhatsApp Image 2025-12-30 at 12.22.57.jpeg', '2025-12-30 14:16:35', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlog`
--
ALTER TABLE `adminlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwalujian`
--
ALTER TABLE `jadwalujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perubahankelas`
--
ALTER TABLE `perubahankelas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlog`
--
ALTER TABLE `adminlog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `beasiswa`
--
ALTER TABLE `beasiswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `jadwalujian`
--
ALTER TABLE `jadwalujian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `perubahankelas`
--
ALTER TABLE `perubahankelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
