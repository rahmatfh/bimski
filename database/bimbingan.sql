-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2022 at 02:57 PM
-- Server version: 10.5.13-MariaDB-0ubuntu0.21.04.1
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bimbingan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(225) NOT NULL,
  `tgl_registered` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `password`, `tgl_registered`) VALUES
(1, 'Mas Admin', 'admin@umc.ac.id', '21232f297a57a5a743894a0e4a801fc3', '2022-03-02 14:11:56'),
(2, 'Pak Admin2', 'admin2@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2022-03-15 11:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE `bimbingan` (
  `id_bimbingan` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `catatan` text NOT NULL,
  `tgl_bimbingan` datetime NOT NULL DEFAULT current_timestamp(),
  `file_bimbingan` varchar(200) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bimbingan`
--

INSERT INTO `bimbingan` (`id_bimbingan`, `id_mahasiswa`, `id_dosen`, `keterangan`, `catatan`, `tgl_bimbingan`, `file_bimbingan`, `status`) VALUES
(1, 1, 7, 'Bimbingan BAB I', 'Banyak elemen yang berantakan', '2022-03-03 19:59:22', '1647328982Profile.pdf', '0'),
(3, 4, 7, 'Bimbingan BAB I', '<p>Perbaikan pendahuluan<br></p>', '2022-03-15 14:45:39', '', '0'),
(4, 4, 7, 'Bimbingan BAB II', '<p>Revisi bab 2<br></p>', '2022-03-15 14:50:52', '1647330878Profile.pdf', '0'),
(5, 4, 7, 'Sudah Bisa Sidang', '<p>Accc<br></p>', '2022-03-15 14:56:42', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nidn` varchar(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tgl_register` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nidn`, `nama`, `password`, `tgl_register`) VALUES
(5, '10001', 'Freddy Wicaksono, M.Kom', 'ce28eed1511f631af6b2a7bb0a85d636', '2022-03-02 14:32:43'),
(6, '10002', 'Harry Gunawan. M.Kom', 'ce28eed1511f631af6b2a7bb0a85d636', '2022-03-02 14:34:28'),
(7, '10003', 'Maksudi M.T', 'ce28eed1511f631af6b2a7bb0a85d636', '2022-03-02 14:34:28'),
(8, '10004', 'Agus Martinus, M.T', 'ce28eed1511f631af6b2a7bb0a85d636', '2022-03-02 14:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
(1, 'FKIP'),
(2, 'Teknik'),
(3, 'Ekonomi');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `judul` varchar(225) DEFAULT NULL,
  `pembimbing` int(11) DEFAULT NULL,
  `pembimbing_dua` int(11) DEFAULT NULL,
  `penguji` int(11) DEFAULT NULL,
  `penguji_dua` int(11) DEFAULT NULL,
  `file_proposal` varchar(225) DEFAULT NULL,
  `tgl_register` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `id_prodi`, `nim`, `nama`, `password`, `judul`, `pembimbing`, `pembimbing_dua`, `penguji`, `penguji_dua`, `file_proposal`, `tgl_register`) VALUES
(1, 2, '000001', 'Taufik Ismail', '04fc711301f3c784d66955d98d399afb', 'Sistem  Ujian Online Terintegrasi Kampus', 7, 8, 6, 5, '1646709012SS_FollowSocial.pdf', '2022-03-02 13:02:08'),
(3, NULL, '000002', 'Ilham Nugroho', '768c1c687efe184ae6dd2420710b8799', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-15 10:13:06'),
(4, 2, '000003', 'Olga Saputre', 'f7a5c99c58103f6b65c451efd0f81826', 'Sistem Informasi Mesin', 7, 5, 6, 7, '1647329964Profile.pdf', '2022-03-15 14:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `id_fakultas`, `nama_prodi`) VALUES
(1, 2, 'Teknik Industri'),
(2, 2, 'Teknik Informatika'),
(3, 2, 'Peternakan'),
(6, 1, 'PGSD'),
(7, 1, 'Matematika'),
(8, 3, 'Akutansi'),
(9, 3, 'Management');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`id_bimbingan`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `id_bimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
