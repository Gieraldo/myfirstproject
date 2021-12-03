-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2021 at 08:18 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servis`
--

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `no` int(10) NOT NULL,
  `kd_jasa` varchar(15) NOT NULL,
  `kerusakan` varchar(100) NOT NULL,
  `harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`no`, `kd_jasa`, `kerusakan`, `harga`) VALUES
(1, 'KJ-1', 'Ganti Lcd', 350000),
(2, 'KJ-2', 'Stuck Windows', 150000),
(3, 'KJ-3', 'Blue screen', 200000),
(5, 'KJ-4', 'Mati Total', 250000);

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(10) NOT NULL,
  `kd_konsumen` varchar(10) NOT NULL,
  `nm_konsumen` varchar(100) NOT NULL,
  `telepon` varchar(16) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `kd_konsumen`, `nm_konsumen`, `telepon`, `alamat`) VALUES
(1, 'KS-1', 'Livio Tri Gieraldo', '0982312312', 'Ujung Aspal'),
(2, 'KS-2', 'Bpk Rafli', '02199999', 'Jatiasih\r\n'),
(11, 'KS-3', 'Aldoe21', '021989898', 'jatimurni');

-- --------------------------------------------------------

--
-- Table structure for table `servis_detail`
--

CREATE TABLE `servis_detail` (
  `servisdetail_id` int(11) NOT NULL,
  `no_servis` int(11) NOT NULL,
  `id_jasa` char(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_ambil` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servis_detail`
--

INSERT INTO `servis_detail` (`servisdetail_id`, `no_servis`, `id_jasa`, `jumlah`, `tgl_ambil`) VALUES
(53, 20, 'KJ-5', 550000, '0000-00-00'),
(54, 20, 'KJ-4', 250000, '0000-00-00'),
(61, 0, 'KJ-1', 350000, '0000-00-00'),
(62, 0, 'KJ-3', 200000, '0000-00-00'),
(70, 21, 'KJ-4', 250000, '0000-00-00'),
(71, 21, 'KJ-5', 550000, '0000-00-00'),
(72, 21, 'KJ-5', 550000, '0000-00-00'),
(82, 80, 'KJ-4', 250000, '0000-00-00'),
(83, 80, 'KJ-5', 550000, '0000-00-00'),
(84, 80, 'KJ-5', 550000, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `servis_header`
--

CREATE TABLE `servis_header` (
  `no_servis` int(45) NOT NULL,
  `nm_teknisi` varchar(50) NOT NULL,
  `nm_konsumen` varchar(50) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `qty` int(11) NOT NULL,
  `tgl_terima` date NOT NULL,
  `tgl_ambil` date DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servis_header`
--

INSERT INTO `servis_header` (`no_servis`, `nm_teknisi`, `nm_konsumen`, `nm_barang`, `alamat`, `telp`, `qty`, `tgl_terima`, `tgl_ambil`, `harga`, `status`) VALUES
(20, 'Bpk Asep', 'Livio Tri Gieraldo', 'Compaq 510', 'Kp pondok ranggon', '08961236767', 1, '2021-05-20', '2021-05-20', 800000, 'Y'),
(21, 'Bpk Bambang', 'Bpk Rafli', 'Lenovo Legion', 'JATIMURNI', '08961236767', 1, '2021-05-20', '2021-05-20', 1350000, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `no` int(10) NOT NULL,
  `kd_teknisi` varchar(20) NOT NULL,
  `nm_teknisi` varchar(100) NOT NULL,
  `telepon` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`no`, `kd_teknisi`, `nm_teknisi`, `telepon`) VALUES
(1, 'KT-1', 'Bpk Bambang', '089629292'),
(2, 'KT-2', 'Bpk Agus', '02134343'),
(4, 'KT-3', 'Bpk Asep', '0987654321');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Teknisi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(5, 'Livio Tri Gieraldo', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(6, 'Aldoee', 'teknisi', 'e21394aaeee10f917f581054d24b031f', 'Teknisi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `servis_detail`
--
ALTER TABLE `servis_detail`
  ADD PRIMARY KEY (`servisdetail_id`);

--
-- Indexes for table `servis_header`
--
ALTER TABLE `servis_header`
  ADD PRIMARY KEY (`no_servis`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `servis_detail`
--
ALTER TABLE `servis_detail`
  MODIFY `servisdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `servis_header`
--
ALTER TABLE `servis_header`
  MODIFY `no_servis` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
