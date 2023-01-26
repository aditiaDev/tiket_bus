-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 09:27 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tiket_bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bus`
--

CREATE TABLE `tb_bus` (
  `id_bus` varchar(25) NOT NULL,
  `id_jenis_bus` varchar(25) DEFAULT NULL,
  `no_pol` varchar(12) DEFAULT NULL,
  `jumlah_kursi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bus`
--

INSERT INTO `tb_bus` (`id_bus`, `id_jenis_bus`, `no_pol`, `jumlah_kursi`) VALUES
('2', 'JB000014', 'K 1234 KI', 50),
('BS000001', 'JB000009', 'H 5432 OK', 50),
('BS000002', 'JB000009', 'F 6772 KHQ', 52);

-- --------------------------------------------------------

--
-- Table structure for table `tb_indikator_kepuasan`
--

CREATE TABLE `tb_indikator_kepuasan` (
  `id_indikator_kepuasan` varchar(25) NOT NULL,
  `indikator_kepuasan` enum('PUAS','TIDAK PUAS') DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_indikator_kepuasan`
--

INSERT INTO `tb_indikator_kepuasan` (`id_indikator_kepuasan`, `indikator_kepuasan`, `nilai`) VALUES
('IK000001', 'PUAS', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_item_penilaian`
--

CREATE TABLE `tb_item_penilaian` (
  `id_item_penilaian` varchar(25) NOT NULL,
  `id_penilaian` varchar(25) DEFAULT NULL,
  `id_parameter` varchar(25) DEFAULT NULL,
  `id_indikator` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_bus`
--

CREATE TABLE `tb_jenis_bus` (
  `id_jenis_bus` varchar(25) NOT NULL,
  `nm_jenis_bus` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis_bus`
--

INSERT INTO `tb_jenis_bus` (`id_jenis_bus`, `nm_jenis_bus`) VALUES
('JB000009', 'Bus Non-High Decker (Normal Deck)'),
('JB000011', 'Bus High Decker (HD)'),
('JB000012', 'Bus Super High Decker (SHD)'),
('JB000013', 'Bus High Decker Double Glass (HDD)'),
('JB000014', 'Bus Double Decker (DD)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_parameter`
--

CREATE TABLE `tb_parameter` (
  `id_parameter` varchar(25) NOT NULL,
  `parameter` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_parameter`
--

INSERT INTO `tb_parameter` (`id_parameter`, `parameter`) VALUES
('PM000001', 'Apakah anda puas dengan pelayanan kami ?');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` varchar(25) NOT NULL,
  `id_user` varchar(25) DEFAULT NULL,
  `nm_pelanggan` varchar(35) DEFAULT NULL,
  `no_pelanggan` varchar(13) DEFAULT NULL,
  `alamat_pelanggan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran_tiket`
--

CREATE TABLE `tb_pembayaran_tiket` (
  `id_pembayaran` varchar(25) NOT NULL,
  `id_penjualan_tiket` varchar(25) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `bukti_pembayaran` text DEFAULT NULL,
  `status_validasi` enum('TERUPLOAD','TERVALIDASI') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian_kepuasan`
--

CREATE TABLE `tb_penilaian_kepuasan` (
  `id_penilaian` varchar(25) NOT NULL,
  `id_pelanggan` varchar(25) DEFAULT NULL,
  `id_penjualan_tiket` varchar(25) DEFAULT NULL,
  `nilai_kepuasan` int(11) DEFAULT NULL,
  `saran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan_tiket`
--

CREATE TABLE `tb_penjualan_tiket` (
  `id_penjualan_tiket` varchar(25) NOT NULL,
  `id_tiket_bus` varchar(25) DEFAULT '',
  `id_pelanggan` varchar(25) DEFAULT NULL,
  `nm_pelanggan` varchar(35) DEFAULT NULL,
  `no_pelanggan` varchar(13) DEFAULT NULL,
  `tgl_pembelian` datetime DEFAULT NULL,
  `tgl_keberangkatan` datetime DEFAULT NULL,
  `jumlah_pembelian` int(11) DEFAULT NULL,
  `jenis_penjualan_tiket` enum('OFFLINE','ONLINE') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tiket_bus`
--

CREATE TABLE `tb_tiket_bus` (
  `id_tiket_bus` varchar(25) NOT NULL,
  `id_bus` varchar(25) DEFAULT NULL,
  `lokasi_kumpul` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tgl_keberangkatan` datetime DEFAULT NULL,
  `jumlah_max` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tiket_bus`
--

INSERT INTO `tb_tiket_bus` (`id_tiket_bus`, `id_bus`, `lokasi_kumpul`, `tujuan`, `tgl_keberangkatan`, `jumlah_max`, `harga`) VALUES
('20230100001', 'BS000001', 'Terminal Jati', 'Purwokerto', '2023-01-18 14:18:55', 50, 50000),
('20230100002', 'BS000002', 'Terminal Jati', 'Yogyakarta', '2023-01-20 04:18:55', 52, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(25) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nm_pengguna` varchar(35) DEFAULT NULL,
  `level` enum('DIREKTUR','SEKERTARIS','ADMIN','PELANGGAN') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bus`
--
ALTER TABLE `tb_bus`
  ADD PRIMARY KEY (`id_bus`);

--
-- Indexes for table `tb_indikator_kepuasan`
--
ALTER TABLE `tb_indikator_kepuasan`
  ADD PRIMARY KEY (`id_indikator_kepuasan`);

--
-- Indexes for table `tb_item_penilaian`
--
ALTER TABLE `tb_item_penilaian`
  ADD PRIMARY KEY (`id_item_penilaian`);

--
-- Indexes for table `tb_jenis_bus`
--
ALTER TABLE `tb_jenis_bus`
  ADD PRIMARY KEY (`id_jenis_bus`);

--
-- Indexes for table `tb_parameter`
--
ALTER TABLE `tb_parameter`
  ADD PRIMARY KEY (`id_parameter`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_pembayaran_tiket`
--
ALTER TABLE `tb_pembayaran_tiket`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_penilaian_kepuasan`
--
ALTER TABLE `tb_penilaian_kepuasan`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `tb_penjualan_tiket`
--
ALTER TABLE `tb_penjualan_tiket`
  ADD PRIMARY KEY (`id_penjualan_tiket`);

--
-- Indexes for table `tb_tiket_bus`
--
ALTER TABLE `tb_tiket_bus`
  ADD PRIMARY KEY (`id_tiket_bus`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
