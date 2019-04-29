-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2019 at 08:51 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surveyplanet`
--

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` varchar(100) NOT NULL,
  `id_soal` varchar(100) NOT NULL,
  `jawaban` varchar(100) NOT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_soal`, `jawaban`, `poin`) VALUES
('5cc4350b7f2c7', '5cc4350b7ee57', 'lari', 35),
('5cc4350b7f435', '5cc4350b7ee57', 'jongkok', 18),
('5cc4350b7f566', '5cc4350b7ee57', 'lemparbatu', 17),
('5cc4350b7f99d', '5cc4350b7ee57', 'diam', 15),
('5cc4350b7fb1c', '5cc4350b7ee57', 'teriak', 7),
('5cc4352e4a8e0', '5cc4352e4a700', 'daun', 29),
('5cc4352e4addb', '5cc4352e4a700', 'airhujan', 22),
('5cc4352e4af37', '5cc4352e4a700', 'buah', 15),
('5cc4352e4b308', '5cc4352e4a700', 'layang-layang', 14),
('5cc4352e4b446', '5cc4352e4a700', 'ranting', 11),
('5cc4355cdbb75', '5cc4355cdb9df', 'nasi', 60),
('5cc4355cdbcb9', '5cc4355cdb9df', 'gado-gado', 24),
('5cc4355cdbdc1', '5cc4355cdb9df', 'ketoprak', 16),
('5cc435acc2ca0', '5cc435acc2ae2', 'diam', 40),
('5cc435acc30dd', '5cc435acc2ae2', 'menghindar', 22),
('5cc435acc322e', '5cc435acc2ae2', 'senyum', 12),
('5cc435acc3492', '5cc435acc2ae2', 'takut', 10),
('5cc435acc35a6', '5cc435acc2ae2', 'menghindar', 10);

-- --------------------------------------------------------

--
-- Table structure for table `poin`
--

CREATE TABLE `poin` (
  `id_poin` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `id_quiz` varchar(100) NOT NULL,
  `poin` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poin`
--

INSERT INTO `poin` (`id_poin`, `id_user`, `id_quiz`, `poin`) VALUES
('5cc67ed5b2b3f', '5cc5e81ac0925', '552518', 76.324786324786),
('5cc67f338bf16', '5cc4350b7ee4e', '552518', 39.190110826939),
('5cc6830e383cc', '5cc4412cdcb69', '552518', 71.187845303867),
('5cc68628e71c8', '5cc4350b7ee4e', '552518', 38.211009174312),
('5cc69af83ae7b', '5cc4350b7ee4e', '552518', 39.685534591195);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `id_user`) VALUES
('552518', '5cc4350b7ee4e');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` varchar(100) NOT NULL,
  `id_quiz` varchar(100) NOT NULL,
  `soal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_quiz`, `soal`) VALUES
('5cc4350b7ee57', '552518', 'Apa yang orang lakukan ketika seekor anjing galak mendekat?'),
('5cc4352e4a700', '552518', 'Benda apa yang sering jatuh diatas genteng?'),
('5cc4355cdb9df', '552518', 'Makanan apa yang dibungkus memakai kertas cokelat dan karet daput?'),
('5cc435acc2ae2', '552518', 'Apa reaksi murid ketika bertemu guru galak?');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`) VALUES
('5cc4350b7ee4e', 'Bayok'),
('5cc4412cdcb69', 'Muhammad Rizqi Mubarak'),
('5cc59155dd2d9', 'Rika'),
('5cc5e81ac0925', 'firza');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `poin`
--
ALTER TABLE `poin`
  ADD PRIMARY KEY (`id_poin`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_quiz` (`id_quiz`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_quiz` (`id_quiz`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`);

--
-- Constraints for table `poin`
--
ALTER TABLE `poin`
  ADD CONSTRAINT `poin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `poin_ibfk_2` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id_quiz`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id_quiz`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
