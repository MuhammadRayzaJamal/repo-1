-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2025 at 08:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spksaw`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_bobotkriteria` int(3) NOT NULL,
  `id_jenisbarang` int(3) NOT NULL,
  `id_kriteria` int(3) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobotkriteria`, `id_jenisbarang`, `id_kriteria`, `bobot`) VALUES
(1, 1, 1, 0.5),
(2, 1, 2, 1),
(3, 1, 3, 0.75),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 0.5),
(7, 1, 1, 0.5),
(8, 1, 2, 1),
(9, 1, 3, 0.75),
(10, 1, 4, 1),
(11, 1, 5, 1),
(12, 1, 6, 0.5),
(13, 3, 1, 0.25),
(14, 3, 2, 0.25),
(15, 3, 3, 0.25),
(16, 3, 4, 0.75),
(17, 3, 5, 0.25),
(18, 3, 6, 0.5),
(19, 3, 7, 0.25),
(20, 3, 8, 0.25),
(21, 3, 9, 0.25),
(22, 3, 10, 0.25),
(23, 3, 11, 0.75),
(24, 3, 12, 0.25),
(25, 4, 1, 0.25),
(26, 4, 2, 0.25),
(27, 4, 3, 0.5),
(28, 4, 4, 0.25),
(29, 4, 5, 1),
(30, 4, 6, 0.25),
(31, 4, 7, 0.25),
(32, 4, 8, 0.25),
(33, 4, 9, 1),
(34, 4, 10, 0.25),
(35, 4, 11, 0),
(36, 4, 12, 0.5),
(37, 5, 1, 0.25),
(38, 5, 2, 0.5),
(39, 5, 3, 0.25),
(40, 5, 4, 0.25),
(41, 5, 5, 0.5),
(42, 5, 6, 0.5),
(43, 5, 7, 0.25),
(44, 5, 8, 0),
(45, 5, 9, 0.5),
(46, 5, 10, 0.25),
(47, 5, 11, 0.5),
(48, 6, 1, 0.5),
(49, 6, 2, 0.5),
(50, 6, 3, 0.5),
(51, 6, 4, 0),
(52, 6, 5, 0.25),
(53, 6, 6, 0.25),
(54, 6, 7, 0.5),
(55, 6, 8, 0.25),
(56, 6, 9, 0.25),
(57, 6, 10, 0.5),
(58, 6, 11, 0.5),
(59, 6, 12, 0.25),
(60, 7, 1, 0.75),
(61, 7, 2, 0.5),
(62, 7, 3, 0),
(63, 7, 4, 0.5),
(64, 7, 5, 0.75),
(65, 7, 6, 0.5),
(66, 7, 7, 0.25),
(67, 7, 8, 0.25),
(68, 7, 9, 0.5),
(69, 7, 10, 0.25),
(70, 7, 11, 0.25),
(71, 7, 12, 0.25),
(72, 8, 1, 0.75),
(73, 8, 2, 0.25),
(74, 8, 3, 0.5),
(75, 8, 4, 0.25),
(76, 8, 5, 0.25),
(77, 8, 6, 0.5),
(78, 8, 7, 0.25),
(79, 8, 8, 0.5),
(80, 8, 9, 0.25),
(81, 8, 10, 0.25),
(82, 8, 11, 0.5),
(83, 8, 12, 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(3) NOT NULL,
  `id_jenisbarang` int(3) NOT NULL,
  `id_supplier` int(3) NOT NULL,
  `hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_jenisbarang`, `id_supplier`, `hasil`) VALUES
(1, 1, 1, 3.25),
(2, 1, 2, 4.0835),
(3, 1, 3, 3.4795),
(4, 2, 6, 0),
(5, 2, 7, 0),
(6, 3, 4, 0.91675),
(7, 3, 5, 2.16675);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenisbarang` int(3) NOT NULL,
  `namaBarang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenisbarang`, `namaBarang`) VALUES
(1, 'Pompa j'),
(2, 'Pompa j'),
(3, 'berlian'),
(4, 'Jaket'),
(5, 'mesin air'),
(6, 'ayam'),
(7, 'handphone'),
(8, 'tablet');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(3) NOT NULL,
  `namaKriteria` varchar(30) NOT NULL,
  `sifat` enum('Benefit','Cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `namaKriteria`, `sifat`) VALUES
(1, 'Harga', 'Cost'),
(2, 'Kualitas', 'Benefit'),
(3, 'Layanan', 'Benefit'),
(4, 'garansi', 'Benefit'),
(5, 'keaslian barang', 'Benefit'),
(6, 'tempo pembayaran', 'Benefit'),
(7, 'kecepatan pengiriman', 'Cost'),
(8, 'Tingkat Diskon', 'Benefit'),
(9, 'Pelayanan', 'Benefit'),
(10, 'garansi', 'Benefit'),
(11, 'keaslian barang', 'Benefit'),
(12, 'tempo pembayaran', 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilaikriteria` int(3) NOT NULL,
  `id_kriteria` int(3) NOT NULL,
  `nilai` float NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilaikriteria`, `id_kriteria`, `nilai`, `keterangan`) VALUES
(1, 2, 0.25, '0% (Tidak ada)'),
(2, 2, 0.5, '1% - 10%'),
(3, 2, 0.75, '11% - 20%'),
(4, 2, 1, '20% lebih'),
(5, 3, 0, 'sangat buruk'),
(6, 3, 0.25, 'buruk'),
(7, 3, 0.5, 'cukup'),
(8, 3, 0.75, 'puas'),
(9, 3, 1, 'sangat memuaskan'),
(10, 4, 0.25, 'tidak ada'),
(11, 4, 0.5, 'kurang dari 1 tahun'),
(12, 4, 0.75, '1 tahun - 2 tahun'),
(13, 4, 1, '2 tahun lebih'),
(14, 5, 0.5, 'KW'),
(15, 5, 1, 'Original / Asli'),
(16, 6, 0.25, 'Kurang dari 1 Minggu'),
(17, 6, 0.5, '1 minggu s/d 2 minggu'),
(18, 6, 0.75, '3 minggu s/d 4 minggu'),
(19, 6, 1, '1 bulan lebih'),
(20, 1, 0.25, '1 Hari'),
(21, 1, 0.5, '2 hari - 7 hari'),
(22, 1, 0.75, '7 hari - 1 bulan'),
(23, 1, 1, '1 bulan lebih'),
(24, 2, 0.25, '0 % (Tidak ada)'),
(25, 2, 0.5, '1% - 10%'),
(26, 2, 0.75, '11% - 20%'),
(27, 2, 1, '20 % lebih'),
(28, 3, 0, 'sangat buruk'),
(29, 3, 0.25, 'buruk'),
(30, 3, 0.5, 'cukup'),
(31, 3, 0.75, 'puas'),
(32, 3, 1, 'sangat memuaskan'),
(33, 4, 0.25, 'tidak ada'),
(34, 4, 0.5, 'kurang dari 1 tahun'),
(35, 4, 0.75, '1 tahun - 2 tahun'),
(36, 4, 1, '2 tahun lebih'),
(37, 5, 0.5, 'KW'),
(38, 5, 1, 'Original / Asli'),
(39, 6, 0.25, 'Kurang dari 1 Minggu'),
(40, 6, 0.5, '1 minggu s/d 2 minggu'),
(41, 6, 0.75, '3 minggu s/d 4 minggu'),
(42, 6, 1, '1 bulan lebih'),
(43, 1, 0.25, '1 Hari'),
(44, 1, 0.5, '2 hari – 7 hari'),
(45, 1, 0.75, '7 hari – 1 bulan'),
(46, 1, 1, '1 bulan lebih'),
(47, 4, 60, 'good'),
(48, 4, 100, 'berlian'),
(49, 6, 100, 'berlian'),
(50, 12, 100, 'berlian'),
(51, 7, 100, 'bagus'),
(52, 3, 100, 'bgus'),
(53, 2, 80, 'promo');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_supplier`
--

CREATE TABLE `nilai_supplier` (
  `id_nilaisupplier` int(3) NOT NULL,
  `id_supplier` int(3) NOT NULL,
  `id_jenisbarang` int(3) NOT NULL,
  `id_kriteria` int(3) NOT NULL,
  `id_nilaikriteria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nilai_supplier`
--

INSERT INTO `nilai_supplier` (`id_nilaisupplier`, `id_supplier`, `id_jenisbarang`, `id_kriteria`, `id_nilaikriteria`) VALUES
(19, 1, 1, 1, 22),
(20, 1, 1, 2, 6),
(21, 1, 1, 3, 13),
(22, 1, 1, 4, 11),
(23, 1, 1, 5, 15),
(24, 1, 1, 6, 17),
(25, 2, 1, 1, 22),
(26, 2, 1, 2, 7),
(27, 2, 1, 3, 13),
(28, 2, 1, 4, 12),
(29, 2, 1, 5, 15),
(30, 2, 1, 6, 18),
(31, 3, 1, 1, 24),
(32, 3, 1, 2, 8),
(33, 3, 1, 3, 12),
(34, 3, 1, 4, 14),
(35, 3, 1, 5, 16),
(36, 3, 1, 6, 18),
(37, 6, 2, 1, 43),
(38, 6, 2, 2, 1),
(39, 6, 2, 3, 9),
(40, 6, 2, 4, 33),
(41, 6, 2, 5, 15),
(42, 6, 2, 6, 17),
(43, 7, 2, 1, 21),
(44, 7, 2, 2, 4),
(45, 7, 2, 3, 7),
(46, 7, 2, 4, 12),
(47, 7, 2, 5, 15),
(48, 7, 2, 6, 16),
(49, 4, 3, 1, 22),
(50, 4, 3, 2, 3),
(51, 4, 3, 3, 28),
(52, 4, 3, 4, 14),
(53, 4, 3, 5, 17),
(54, 5, 3, 1, 21),
(55, 5, 3, 2, 2),
(56, 5, 3, 3, 8),
(57, 5, 3, 4, 13),
(58, 5, 3, 5, 15),
(59, 5, 3, 6, 19);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(3) NOT NULL,
  `namaSupplier` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `namaSupplier`) VALUES
(1, 'Supplier A'),
(2, 'Supplier B'),
(3, 'Supplier C'),
(4, 'CV. A'),
(5, 'CV. B'),
(6, 'CV. C'),
(7, 'berlian'),
(8, 'jaket');

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `Id_admin` int(3) NOT NULL,
  `username` varchar(30) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`Id_admin`, `username`, `PASSWORD`) VALUES
(1, 'Admin', '$2y$10$EJY2v0Z6A3xq0v0jKf1oeOZx1I9Pj3F7k1lVq5M1Tt0vN9xC1yB7G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_bobotkriteria`),
  ADD KEY `id_jenisbarang` (`id_jenisbarang`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_jenisbarang` (`id_jenisbarang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenisbarang`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilaikriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `nilai_supplier`
--
ALTER TABLE `nilai_supplier`
  ADD PRIMARY KEY (`id_nilaisupplier`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_jenisbarang` (`id_jenisbarang`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_nilaikriteria` (`id_nilaikriteria`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`Id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id_bobotkriteria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id_jenisbarang` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilaikriteria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `nilai_supplier`
--
ALTER TABLE `nilai_supplier`
  MODIFY `id_nilaisupplier` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `Id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`id_jenisbarang`) REFERENCES `jenis_barang` (`id_jenisbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bobot_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_jenisbarang`) REFERENCES `jenis_barang` (`id_jenisbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD CONSTRAINT `nilai_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_supplier`
--
ALTER TABLE `nilai_supplier`
  ADD CONSTRAINT `nilai_supplier_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_supplier_ibfk_2` FOREIGN KEY (`id_jenisbarang`) REFERENCES `jenis_barang` (`id_jenisbarang`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_supplier_ibfk_3` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_supplier_ibfk_4` FOREIGN KEY (`id_nilaikriteria`) REFERENCES `nilai_kriteria` (`id_nilaikriteria`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
