-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jan 2023 pada 00.11
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `tb_bus`
--

CREATE TABLE `tb_bus` (
  `id_bus` varchar(25) NOT NULL,
  `id_jenis_bus` varchar(25) DEFAULT NULL,
  `no_pol` varchar(12) DEFAULT NULL,
  `jumlah_kursi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bus`
--

INSERT INTO `tb_bus` (`id_bus`, `id_jenis_bus`, `no_pol`, `jumlah_kursi`) VALUES
('2', 'JB000014', 'K 1234 KI', 50),
('BS000001', 'JB000009', 'H 5432 OK', 50),
('BS000002', 'JB000009', 'F 6772 KHQ', 52);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_indikator_kepuasan`
--

CREATE TABLE `tb_indikator_kepuasan` (
  `id_indikator_kepuasan` varchar(25) NOT NULL,
  `indikator_kepuasan` varchar(15) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_indikator_kepuasan`
--

INSERT INTO `tb_indikator_kepuasan` (`id_indikator_kepuasan`, `indikator_kepuasan`, `nilai`) VALUES
('IK000001', 'PUAS', 5),
('IK000002', 'TIDAK PUAS', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_item_penilaian`
--

CREATE TABLE `tb_item_penilaian` (
  `id_item_penilaian` varchar(25) NOT NULL,
  `id_penilaian` varchar(25) DEFAULT NULL,
  `id_parameter` varchar(25) DEFAULT NULL,
  `id_indikator` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_bus`
--

CREATE TABLE `tb_jenis_bus` (
  `id_jenis_bus` varchar(25) NOT NULL,
  `nm_jenis_bus` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jenis_bus`
--

INSERT INTO `tb_jenis_bus` (`id_jenis_bus`, `nm_jenis_bus`) VALUES
('JB000009', 'Bus Non-High Decker (Normal Deck)'),
('JB000011', 'Bus High Decker (HD)'),
('JB000012', 'Bus Super High Decker (SHD)'),
('JB000013', 'Bus High Decker Double Glass (HDD)'),
('JB000014', 'Bus Double Decker (DD)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_parameter`
--

CREATE TABLE `tb_parameter` (
  `id_parameter` varchar(25) NOT NULL,
  `parameter` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_parameter`
--

INSERT INTO `tb_parameter` (`id_parameter`, `parameter`) VALUES
('PM000001', 'Apakah anda puas dengan pelayanan kami ?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` varchar(25) NOT NULL,
  `id_user` varchar(25) DEFAULT NULL,
  `nm_pelanggan` varchar(35) DEFAULT NULL,
  `no_pelanggan` varchar(13) DEFAULT NULL,
  `alamat_pelanggan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `id_user`, `nm_pelanggan`, `no_pelanggan`, `alamat_pelanggan`) VALUES
('P2300000', 'U2300000', 'GUEST', '', 'GUEST'),
('P2300001', 'U2300001', 'PELANGGAN 1', '08134558891', 'BAE KUDUS'),
('P2300002', 'U2300002', 'Test Nama', '089676726', 'Test Alamat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran_tiket`
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
-- Struktur dari tabel `tb_penilaian_kepuasan`
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
-- Struktur dari tabel `tb_penjualan_tiket`
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

--
-- Dumping data untuk tabel `tb_penjualan_tiket`
--

INSERT INTO `tb_penjualan_tiket` (`id_penjualan_tiket`, `id_tiket_bus`, `id_pelanggan`, `nm_pelanggan`, `no_pelanggan`, `tgl_pembelian`, `tgl_keberangkatan`, `jumlah_pembelian`, `jenis_penjualan_tiket`) VALUES
('J20230100001', '20230100001', 'P2300001', 'PELANGGAN 1', '08134558891', '2023-01-15 09:19:03', '2023-01-18 14:18:55', 1, 'OFFLINE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tiket_bus`
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
-- Dumping data untuk tabel `tb_tiket_bus`
--

INSERT INTO `tb_tiket_bus` (`id_tiket_bus`, `id_bus`, `lokasi_kumpul`, `tujuan`, `tgl_keberangkatan`, `jumlah_max`, `harga`) VALUES
('20230100001', 'BS000001', 'Terminal Jati', 'Purwokerto', '2023-01-18 14:18:55', 50, 50000),
('20230100002', 'BS000002', 'Terminal Jati', 'Yogyakarta', '2023-01-20 04:18:55', 52, 60000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(25) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nm_pengguna` varchar(35) DEFAULT NULL,
  `level` enum('DIREKTUR','SEKERTARIS','ADMIN','PELANGGAN') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nm_pengguna`, `level`) VALUES
('U2300001', 'PELANGGAN', 'PELANGGAN', 'PELANGGAN 1', 'PELANGGAN'),
('U2300002', 'User', 'Password', 'Test Nama', 'PELANGGAN');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_bus`
--
ALTER TABLE `tb_bus`
  ADD PRIMARY KEY (`id_bus`);

--
-- Indeks untuk tabel `tb_indikator_kepuasan`
--
ALTER TABLE `tb_indikator_kepuasan`
  ADD PRIMARY KEY (`id_indikator_kepuasan`);

--
-- Indeks untuk tabel `tb_item_penilaian`
--
ALTER TABLE `tb_item_penilaian`
  ADD PRIMARY KEY (`id_item_penilaian`);

--
-- Indeks untuk tabel `tb_jenis_bus`
--
ALTER TABLE `tb_jenis_bus`
  ADD PRIMARY KEY (`id_jenis_bus`);

--
-- Indeks untuk tabel `tb_parameter`
--
ALTER TABLE `tb_parameter`
  ADD PRIMARY KEY (`id_parameter`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_pembayaran_tiket`
--
ALTER TABLE `tb_pembayaran_tiket`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `tb_penilaian_kepuasan`
--
ALTER TABLE `tb_penilaian_kepuasan`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indeks untuk tabel `tb_penjualan_tiket`
--
ALTER TABLE `tb_penjualan_tiket`
  ADD PRIMARY KEY (`id_penjualan_tiket`);

--
-- Indeks untuk tabel `tb_tiket_bus`
--
ALTER TABLE `tb_tiket_bus`
  ADD PRIMARY KEY (`id_tiket_bus`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
