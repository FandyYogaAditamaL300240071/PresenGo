-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2026 at 05:27 PM
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
-- Database: `presengo`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `deskripsi`, `created_at`) VALUES
(1, 'IT', 'Information Technology', '2026-06-07 15:16:16'),
(2, 'Keuangan', 'Financial Department', '2026-06-07 15:16:16'),
(3, 'Marketing', 'Marketing Department', '2026-06-07 15:16:16'),
(4, 'HRD', 'Human Resource Department', '2026-06-07 15:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `kode_karyawan` varchar(20) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `kode_karyawan`, `id_divisi`, `nama_karyawan`, `jabatan`, `no_hp`, `alamat`, `created_at`) VALUES
(1, 'A0124001', 1, 'Fandy Yoga Aditama', 'Network Administrator', '081111111001', 'Boyolali', '2026-06-07 15:17:43'),
(2, 'A0224002', 1, 'Himawan Danendra', 'Software Engineer', '081111111002', 'Surakarta', '2026-06-07 15:17:43'),
(3, 'A0324003', 1, 'Nadzif Ilhami Riyadi', 'Data Analyst', '081111111003', 'Karanganyar', '2026-06-07 15:17:43'),
(4, 'A0424004', 1, 'Fachrul Ikhwan Nur Rasyid', 'Cybersecurity Specialist', '081111111004', 'Sukoharjo', '2026-06-07 15:17:43'),
(5, 'A0224005', 1, 'Raffi Rizkiansyah', 'Software Engineer', '081111111005', 'Klaten', '2026-06-07 15:17:43'),
(6, 'A0324006', 1, 'Ryan Adib Fitra', 'Data Analyst', '081111111006', 'Wonogiri', '2026-06-07 15:17:43'),
(7, 'A0424007', 1, 'Muhammad Gilang Ramadhan', 'Cybersecurity Specialist', '081111111007', 'Sragen', '2026-06-07 15:17:43'),
(8, 'A0224008', 1, 'Dimas Satria Mulyono', 'Software Engineer', '081111111008', 'Boyolali', '2026-06-07 15:17:43'),
(9, 'A0324009', 1, 'Muhammad Java Rahmanda', 'Data Analyst', '081111111009', 'Surakarta', '2026-06-07 15:17:43'),
(10, 'A0424010', 1, 'TB Hilmi Alghifari', 'Cybersecurity Specialist', '081111111010', 'Karanganyar', '2026-06-07 15:17:43'),
(11, 'B0924001', 2, 'Celvin Ardyatmajaya Putra', 'Financial Manager', '082222222001', 'Boyolali', '2026-06-07 15:17:43'),
(12, 'B1024002', 2, 'Valentino Vemas Audrey', 'Akuntan', '082222222002', 'Klaten', '2026-06-07 15:17:43'),
(13, 'B1124003', 2, 'Benediktus Michael Adolf Maydilau Sumapoe', 'Treasury Staff', '082222222003', 'Surakarta', '2026-06-07 15:17:43'),
(14, 'B1224004', 2, 'Darrely Alfarizy Heristiavin S.', 'Financial Consultant', '082222222004', 'Karanganyar', '2026-06-07 15:17:43'),
(15, 'B1024005', 2, 'Novita Fitri Almutavi', 'Akuntan', '082222222005', 'Sukoharjo', '2026-06-07 15:17:43'),
(16, 'B1124006', 2, 'Auliya Andy Nurlaila', 'Treasury Staff', '082222222006', 'Boyolali', '2026-06-07 15:17:43'),
(17, 'B1224007', 2, 'Friatna Egi Setiawan', 'Financial Consultant', '082222222007', 'Wonogiri', '2026-06-07 15:17:43'),
(18, 'B1024008', 2, 'Razico Almadani Sofenda Putra', 'Akuntan', '082222222008', 'Sragen', '2026-06-07 15:17:43'),
(19, 'B1124009', 2, 'Dimas Muhammad Ihram', 'Treasury Staff', '082222222009', 'Klaten', '2026-06-07 15:17:43'),
(20, 'B1224010', 2, 'Mohammad Fahmi', 'Financial Consultant', '082222222010', 'Surakarta', '2026-06-07 15:17:43'),
(21, 'C1324001', 3, 'Khansa Nadhira Sari', 'Marketing Manager', '083333333001', 'Boyolali', '2026-06-07 15:17:43'),
(22, 'C1424002', 3, 'Raissa Mayla Jasmine', 'Digital Marketer', '083333333002', 'Sukoharjo', '2026-06-07 15:17:43'),
(23, 'C1524003', 3, 'Naila Khairunnisa', 'Content Creator', '083333333003', 'Karanganyar', '2026-06-07 15:17:43'),
(24, 'C1624004', 3, 'Latifa Salsabila Hanandini', 'Copywriter', '083333333004', 'Surakarta', '2026-06-07 15:17:43'),
(25, 'C1424005', 3, 'Yola Tria Sitma', 'Digital Marketer', '083333333005', 'Klaten', '2026-06-07 15:17:43'),
(26, 'C1524006', 3, 'Deysilla Afifah Feriz', 'Content Creator', '083333333006', 'Boyolali', '2026-06-07 15:17:43'),
(27, 'C1624007', 3, 'Azzahra Cholifaqul Saqeena Putri', 'Copywriter', '083333333007', 'Wonogiri', '2026-06-07 15:17:43'),
(28, 'C1424008', 3, 'Desatu Shifa', 'Digital Marketer', '083333333008', 'Sragen', '2026-06-07 15:17:43'),
(29, 'C1524009', 3, 'Feriawan Setyoaji Saputro', 'Content Creator', '083333333009', 'Surakarta', '2026-06-07 15:17:43'),
(30, 'C1624010', 3, 'Siska Fatikah', 'Copywriter', '083333333010', 'Karanganyar', '2026-06-07 15:17:43'),
(31, 'D0524001', 4, 'Ixal Thoriq Uni\'am', 'Supervisor HRD', '084444444001', 'Boyolali', '2026-06-07 15:17:43'),
(32, 'D0624002', 4, 'Andika Dwi Prayitno', 'Recruitment Staff', '084444444002', 'Klaten', '2026-06-07 15:17:43'),
(33, 'D0724003', 4, 'Ahmad Kamaludin', 'HR Training', '084444444003', 'Surakarta', '2026-06-07 15:17:43'),
(34, 'D0824004', 4, 'Muhammad Nawawi Al Labib', 'Business Partner', '084444444004', 'Karanganyar', '2026-06-07 15:17:43'),
(35, 'D0624005', 4, 'Ilham Dwi Prasetyo', 'Recruitment Staff', '084444444005', 'Sukoharjo', '2026-06-07 15:17:43'),
(36, 'D0724006', 4, 'Galang Bhakti Praja Utama', 'HR Training', '084444444006', 'Wonogiri', '2026-06-07 15:17:43'),
(37, 'D0824007', 4, 'Miftah Rafid Firdaus', 'Business Partner', '084444444007', 'Sragen', '2026-06-07 15:17:43'),
(38, 'D0624008', 4, 'Raffi Nur Said', 'Recruitment Staff', '084444444008', 'Boyolali', '2026-06-07 15:17:43'),
(39, 'D0724009', 4, 'Al Exsan Muchlis Purnomo', 'HR Training', '084444444009', 'Klaten', '2026-06-07 15:17:43'),
(40, 'D0824010', 4, 'Satria Galuh Saputra', 'Business Partner', '084444444010', 'Surakarta', '2026-06-07 15:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpha') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kepala_divisi','karyawan') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_karyawan`, `username`, `password`, `role`, `created_at`) VALUES
(43, NULL, 'admin', 'admin123', 'admin', '2026-06-07 15:20:33'),
(44, 1, 'fandy', 'fandy123', 'kepala_divisi', '2026-06-07 15:20:33'),
(45, 2, 'himawan', 'himawan123', 'karyawan', '2026-06-07 15:20:33'),
(46, 3, 'nadzif', 'nadzif123', 'karyawan', '2026-06-07 15:20:33'),
(47, 4, 'fachrul', 'fachrul123', 'karyawan', '2026-06-07 15:20:33'),
(48, 5, 'raffi', 'raffi123', 'karyawan', '2026-06-07 15:20:33'),
(49, 6, 'ryan', 'ryan123', 'karyawan', '2026-06-07 15:20:33'),
(50, 7, 'gilang', 'gilang123', 'karyawan', '2026-06-07 15:20:33'),
(51, 8, 'dimas', 'dimas123', 'karyawan', '2026-06-07 15:20:33'),
(52, 9, 'java', 'java123', 'karyawan', '2026-06-07 15:20:33'),
(53, 10, 'hilmi', 'hilmi123', 'karyawan', '2026-06-07 15:20:33'),
(54, 11, 'celvin', 'celvin123', 'kepala_divisi', '2026-06-07 15:20:33'),
(55, 12, 'valentino', 'valentino123', 'karyawan', '2026-06-07 15:20:33'),
(56, 13, 'benediktus', 'benediktus123', 'karyawan', '2026-06-07 15:20:33'),
(57, 14, 'darrely', 'darrely123', 'karyawan', '2026-06-07 15:20:33'),
(58, 15, 'novita', 'novita123', 'karyawan', '2026-06-07 15:20:33'),
(59, 16, 'auliya', 'auliya123', 'karyawan', '2026-06-07 15:20:33'),
(60, 17, 'friatna', 'friatna123', 'karyawan', '2026-06-07 15:20:33'),
(61, 18, 'razico', 'razico123', 'karyawan', '2026-06-07 15:20:33'),
(62, 19, 'ihram', 'ihram123', 'karyawan', '2026-06-07 15:20:33'),
(63, 20, 'fahmi', 'fahmi123', 'karyawan', '2026-06-07 15:20:33'),
(64, 21, 'khansa', 'khansa123', 'kepala_divisi', '2026-06-07 15:20:33'),
(65, 22, 'raissa', 'raissa123', 'karyawan', '2026-06-07 15:20:33'),
(66, 23, 'naila', 'naila123', 'karyawan', '2026-06-07 15:20:33'),
(67, 24, 'latifa', 'latifa123', 'karyawan', '2026-06-07 15:20:33'),
(68, 25, 'yola', 'yola123', 'karyawan', '2026-06-07 15:20:33'),
(69, 26, 'deysilla', 'deysilla123', 'karyawan', '2026-06-07 15:20:33'),
(70, 27, 'azzahra', 'azzahra123', 'karyawan', '2026-06-07 15:20:33'),
(71, 28, 'desatu', 'desatu123', 'karyawan', '2026-06-07 15:20:33'),
(72, 29, 'feriawan', 'feriawan123', 'karyawan', '2026-06-07 15:20:33'),
(73, 30, 'siska', 'siska123', 'karyawan', '2026-06-07 15:20:33'),
(74, 31, 'ixal', 'ixal123', 'kepala_divisi', '2026-06-07 15:20:33'),
(75, 32, 'andika', 'andika123', 'karyawan', '2026-06-07 15:20:33'),
(76, 33, 'ahmad', 'ahmad123', 'karyawan', '2026-06-07 15:20:33'),
(77, 34, 'nawawi', 'nawawi123', 'karyawan', '2026-06-07 15:20:33'),
(78, 35, 'ilham', 'ilham123', 'karyawan', '2026-06-07 15:20:33'),
(79, 36, 'galang', 'galang123', 'karyawan', '2026-06-07 15:20:33'),
(80, 37, 'miftah', 'miftah123', 'karyawan', '2026-06-07 15:20:33'),
(81, 38, 'raffinur', 'raffinur123', 'karyawan', '2026-06-07 15:20:33'),
(82, 39, 'alexsan', 'alexsan123', 'karyawan', '2026-06-07 15:20:33'),
(83, 40, 'satria', 'satria123', 'karyawan', '2026-06-07 15:20:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `kode_karyawan` (`kode_karyawan`),
  ADD KEY `idx_karyawan_divisi` (`id_divisi`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `idx_presensi_karyawan` (`id_karyawan`),
  ADD KEY `idx_presensi_tanggal` (`tanggal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idx_users_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `fk_karyawan_divisi` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON UPDATE CASCADE;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `fk_presensi_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
