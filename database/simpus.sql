-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2015 at 07:20 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_ADMIN` int(11) NOT NULL,
  `NAMA_ADMIN` varchar(25) DEFAULT NULL,
  `ALAMAT_ADMIN` varchar(25) DEFAULT NULL,
  `TELPON` varchar(12) DEFAULT NULL,
  `USERNAME` varchar(16) DEFAULT NULL,
  `PASSWORD` varchar(40) DEFAULT NULL,
  `LEVEL` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `NAMA_ADMIN`, `ALAMAT_ADMIN`, `TELPON`, `USERNAME`, `PASSWORD`, `LEVEL`) VALUES
(1, 'Fendi Septiawan', 'Nganjuk', '085707824789', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `ID_ANTRIAN` int(11) NOT NULL,
  `ID_PUSKESMAS` varchar(12) DEFAULT NULL,
  `ID_POLI` varchar(12) DEFAULT NULL,
  `ID_PASIEN` varchar(12) DEFAULT NULL,
  `TGL_ANTRIAN` date DEFAULT NULL,
  `STATUS_ANTRIAN` varchar(12) DEFAULT NULL,
  `NO_ANTRIAN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `ID_DOKTER` varchar(20) NOT NULL,
  `NAMA_DOKTER` varchar(30) DEFAULT NULL,
  `ALAMAT_DOKTER` varchar(30) DEFAULT NULL,
  `JENIS_KELAMIN` varchar(12) DEFAULT NULL,
  `SPESIALIS` varchar(30) DEFAULT NULL,
  `TELPON` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `ID_KAMAR` varchar(16) NOT NULL,
  `NAMA_KAMAR` varchar(25) DEFAULT NULL,
  `STATUS_KAMAR` varchar(25) DEFAULT NULL,
  `TARIF_KAMAR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medical_record`
--

CREATE TABLE `medical_record` (
  `ID_MEDICAL` int(11) NOT NULL,
  `ID_PERIKSA` int(11) DEFAULT NULL,
  `TGL_RECORD` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `KD_OBAT` varchar(6) NOT NULL,
  `NM_OBAT` varchar(25) DEFAULT NULL,
  `TGL_KADALUARSA` date DEFAULT NULL,
  `STOK` int(11) DEFAULT NULL,
  `HARGA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `ID_PASIEN` varchar(12) NOT NULL,
  `NAMA_PASIEN` varchar(25) DEFAULT NULL,
  `ALAMAT_PASIEN` varchar(25) DEFAULT NULL,
  `TLPN` varchar(12) DEFAULT NULL,
  `JK` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `ID_PERIKSA` int(11) NOT NULL,
  `ID_PENYAKIT` int(11) DEFAULT NULL,
  `ID_PERAWAT` varchar(20) DEFAULT NULL,
  `ID_DOKTER` varchar(20) DEFAULT NULL,
  `ID_PASIEN` varchar(12) DEFAULT NULL,
  `ID_RAWAT_INAP` int(11) DEFAULT NULL,
  `ID_POLI` varchar(12) DEFAULT NULL,
  `ID_TINDAKAN` int(11) DEFAULT NULL,
  `ID_PUSKESMAS` varchar(12) DEFAULT NULL,
  `KD_OBAT` varchar(6) DEFAULT NULL,
  `KONDISI` varchar(50) DEFAULT NULL,
  `KELUHAN` varchar(50) DEFAULT NULL,
  `DIAGNOSIS` varchar(50) DEFAULT NULL,
  `TGL_PERIKSA` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `ID_PENYAKIT` int(11) NOT NULL,
  `NAMA_PENYAKIT` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perawat`
--

CREATE TABLE `perawat` (
  `ID_PERAWAT` varchar(20) NOT NULL,
  `NAMA_PERAWAT` varchar(25) DEFAULT NULL,
  `ALAMAT_PERAWAT` varchar(30) DEFAULT NULL,
  `TLPN` varchar(12) DEFAULT NULL,
  `JK_PERAWAT` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `ID_POLI` varchar(12) NOT NULL,
  `ID_DOKTER` varchar(20) DEFAULT NULL,
  `ID_PUSKESMAS` varchar(12) DEFAULT NULL,
  `ID_ADMIN` int(11) DEFAULT NULL,
  `NAMA_POLI` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `puskesmas`
--

CREATE TABLE `puskesmas` (
  `ID_PUSKESMAS` varchar(12) NOT NULL,
  `ID_DOKTER` varchar(20) DEFAULT NULL,
  `NAMA_PUSKESMAS` varchar(25) DEFAULT NULL,
  `ALAMAT_PUSKESMAS` varchar(25) DEFAULT NULL,
  `TELPON_PUSKESMAS` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rawat_inap`
--

CREATE TABLE `rawat_inap` (
  `ID_RAWAT_INAP` int(11) NOT NULL,
  `ID_KAMAR` varchar(16) DEFAULT NULL,
  `ID_TINDAKAN` int(11) DEFAULT NULL,
  `TGL_MASUK` date DEFAULT NULL,
  `TGL_KELUAR` date DEFAULT NULL,
  `KETERANGAN` varchar(50) DEFAULT NULL,
  `BIAYA_INAP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `struk`
--

CREATE TABLE `struk` (
  `ID_STRUK` int(11) NOT NULL,
  `ID_PERIKSA` int(11) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `ID_TINDAKAN` int(11) NOT NULL,
  `NAMA_TINDAKAN` varchar(25) DEFAULT NULL,
  `BIAYA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`),
  ADD UNIQUE KEY `ADMIN_PK` (`ID_ADMIN`);

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`ID_ANTRIAN`),
  ADD UNIQUE KEY `ANTRIAN_PK` (`ID_ANTRIAN`),
  ADD KEY `RELATIONSHIP_5_FK` (`ID_PUSKESMAS`),
  ADD KEY `RELATIONSHIP_6_FK` (`ID_POLI`),
  ADD KEY `RELATIONSHIP_7_FK` (`ID_PASIEN`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`ID_DOKTER`),
  ADD UNIQUE KEY `DOKTER_PK` (`ID_DOKTER`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`ID_KAMAR`),
  ADD UNIQUE KEY `KAMAR_PK` (`ID_KAMAR`);

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`ID_MEDICAL`),
  ADD UNIQUE KEY `MEDICAL_RECORD_PK` (`ID_MEDICAL`),
  ADD KEY `RELATIONSHIP_3_FK` (`ID_PERIKSA`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`KD_OBAT`),
  ADD UNIQUE KEY `OBAT_PK` (`KD_OBAT`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`ID_PASIEN`),
  ADD UNIQUE KEY `PASIEN_PK` (`ID_PASIEN`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`ID_PERIKSA`),
  ADD UNIQUE KEY `PEMERIKSAAN_PK` (`ID_PERIKSA`),
  ADD KEY `RELATIONSHIP_12_FK` (`ID_POLI`),
  ADD KEY `RELATIONSHIP_13_FK` (`ID_DOKTER`),
  ADD KEY `RELATIONSHIP_14_FK` (`ID_TINDAKAN`),
  ADD KEY `RELATIONSHIP_15_FK` (`KD_OBAT`),
  ADD KEY `RELATIONSHIP_16_FK` (`ID_RAWAT_INAP`),
  ADD KEY `RELATIONSHIP_17_FK` (`ID_PUSKESMAS`),
  ADD KEY `RELATIONSHIP_18_FK` (`ID_PENYAKIT`),
  ADD KEY `RELATIONSHIP_19_FK` (`ID_PERAWAT`),
  ADD KEY `RELATIONSHIP_20_FK` (`ID_PASIEN`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`ID_PENYAKIT`),
  ADD UNIQUE KEY `PENYAKIT_PK` (`ID_PENYAKIT`);

--
-- Indexes for table `perawat`
--
ALTER TABLE `perawat`
  ADD PRIMARY KEY (`ID_PERAWAT`),
  ADD UNIQUE KEY `PERAWAT_PK` (`ID_PERAWAT`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`ID_POLI`),
  ADD UNIQUE KEY `POLI_PK` (`ID_POLI`),
  ADD KEY `RELATIONSHIP_9_FK` (`ID_PUSKESMAS`),
  ADD KEY `RELATIONSHIP_10_FK` (`ID_ADMIN`),
  ADD KEY `RELATIONSHIP_11_FK` (`ID_DOKTER`);

--
-- Indexes for table `puskesmas`
--
ALTER TABLE `puskesmas`
  ADD PRIMARY KEY (`ID_PUSKESMAS`),
  ADD UNIQUE KEY `PUSKESMAS_PK` (`ID_PUSKESMAS`),
  ADD KEY `RELATIONSHIP_8_FK` (`ID_DOKTER`);

--
-- Indexes for table `rawat_inap`
--
ALTER TABLE `rawat_inap`
  ADD PRIMARY KEY (`ID_RAWAT_INAP`),
  ADD UNIQUE KEY `RAWAT_INAP_PK` (`ID_RAWAT_INAP`),
  ADD KEY `RELATIONSHIP_1_FK` (`ID_TINDAKAN`),
  ADD KEY `RELATIONSHIP_2_FK` (`ID_KAMAR`);

--
-- Indexes for table `struk`
--
ALTER TABLE `struk`
  ADD PRIMARY KEY (`ID_STRUK`),
  ADD UNIQUE KEY `STRUK_PK` (`ID_STRUK`),
  ADD KEY `RELATIONSHIP_4_FK` (`ID_PERIKSA`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`ID_TINDAKAN`),
  ADD UNIQUE KEY `TINDAKAN_PK` (`ID_TINDAKAN`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `FK_ANTRIAN_RELATIONS_PASIEN` FOREIGN KEY (`ID_PASIEN`) REFERENCES `pasien` (`ID_PASIEN`),
  ADD CONSTRAINT `FK_ANTRIAN_RELATIONS_POLI` FOREIGN KEY (`ID_POLI`) REFERENCES `poli` (`ID_POLI`),
  ADD CONSTRAINT `FK_ANTRIAN_RELATIONS_PUSKESMA` FOREIGN KEY (`ID_PUSKESMAS`) REFERENCES `puskesmas` (`ID_PUSKESMAS`);

--
-- Constraints for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD CONSTRAINT `FK_MEDICAL__RELATIONS_PEMERIKS` FOREIGN KEY (`ID_PERIKSA`) REFERENCES `pemeriksaan` (`ID_PERIKSA`);

--
-- Constraints for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `FK_PEMERIKS_RELATIONS_DOKTER` FOREIGN KEY (`ID_DOKTER`) REFERENCES `dokter` (`ID_DOKTER`),
  ADD CONSTRAINT `FK_PEMERIKS_RELATIONS_OBAT` FOREIGN KEY (`KD_OBAT`) REFERENCES `obat` (`KD_OBAT`),
  ADD CONSTRAINT `FK_PEMERIKS_RELATIONS_PASIEN` FOREIGN KEY (`ID_PASIEN`) REFERENCES `pasien` (`ID_PASIEN`),
  ADD CONSTRAINT `FK_PEMERIKS_RELATIONS_PENYAKIT` FOREIGN KEY (`ID_PENYAKIT`) REFERENCES `penyakit` (`ID_PENYAKIT`),
  ADD CONSTRAINT `FK_PEMERIKS_RELATIONS_PERAWAT` FOREIGN KEY (`ID_PERAWAT`) REFERENCES `perawat` (`ID_PERAWAT`),
  ADD CONSTRAINT `FK_PEMERIKS_RELATIONS_POLI` FOREIGN KEY (`ID_POLI`) REFERENCES `poli` (`ID_POLI`),
  ADD CONSTRAINT `FK_PEMERIKS_RELATIONS_PUSKESMA` FOREIGN KEY (`ID_PUSKESMAS`) REFERENCES `puskesmas` (`ID_PUSKESMAS`),
  ADD CONSTRAINT `FK_PEMERIKS_RELATIONS_RAWAT_IN` FOREIGN KEY (`ID_RAWAT_INAP`) REFERENCES `rawat_inap` (`ID_RAWAT_INAP`),
  ADD CONSTRAINT `FK_PEMERIKS_RELATIONS_TINDAKAN` FOREIGN KEY (`ID_TINDAKAN`) REFERENCES `tindakan` (`ID_TINDAKAN`);

--
-- Constraints for table `poli`
--
ALTER TABLE `poli`
  ADD CONSTRAINT `FK_POLI_RELATIONS_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`),
  ADD CONSTRAINT `FK_POLI_RELATIONS_DOKTER` FOREIGN KEY (`ID_DOKTER`) REFERENCES `dokter` (`ID_DOKTER`),
  ADD CONSTRAINT `FK_POLI_RELATIONS_PUSKESMA` FOREIGN KEY (`ID_PUSKESMAS`) REFERENCES `puskesmas` (`ID_PUSKESMAS`);

--
-- Constraints for table `puskesmas`
--
ALTER TABLE `puskesmas`
  ADD CONSTRAINT `FK_PUSKESMA_RELATIONS_DOKTER` FOREIGN KEY (`ID_DOKTER`) REFERENCES `dokter` (`ID_DOKTER`);

--
-- Constraints for table `rawat_inap`
--
ALTER TABLE `rawat_inap`
  ADD CONSTRAINT `FK_RAWAT_IN_RELATIONS_KAMAR` FOREIGN KEY (`ID_KAMAR`) REFERENCES `kamar` (`ID_KAMAR`),
  ADD CONSTRAINT `FK_RAWAT_IN_RELATIONS_TINDAKAN` FOREIGN KEY (`ID_TINDAKAN`) REFERENCES `tindakan` (`ID_TINDAKAN`);

--
-- Constraints for table `struk`
--
ALTER TABLE `struk`
  ADD CONSTRAINT `FK_STRUK_RELATIONS_PEMERIKS` FOREIGN KEY (`ID_PERIKSA`) REFERENCES `pemeriksaan` (`ID_PERIKSA`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
