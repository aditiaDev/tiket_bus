-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Mar 2023 pada 14.03
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
  `jumlah_kursi` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_kategori` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bus`
--

INSERT INTO `tb_bus` (`id_bus`, `id_jenis_bus`, `no_pol`, `jumlah_kursi`, `foto`, `deskripsi`, `id_kategori`) VALUES
('2', 'JB000014', 'K 1234 KI', 50, 'bus1.jpg', 'Bus Normal Decker Dengan Fasilitas AC dan TV serta charger HP', 'AKAP'),
('BS000001', 'JB000009', 'H 5432 OK', 50, 'bus2.jpg', 'Bus Normal Decker Dengan Fasilitas AC dan TV serta charger HP', 'AKAP'),
('BS000002', 'JB000009', 'F 6772 KHQ', 52, 'bus3.jpg', 'Bus Normal Decker Dengan Fasilitas AC dan TV serta charger HP', 'AKDP'),
('BS000003', 'JB000009', 'K 1234 JK', 40, '1676789625679.jpg', 'Bus Normal Decker Dengan Fasilitas AC dan TV serta charger HP\r\nKursi Nyaman', 'WISATA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_indikator_kepuasan`
--

CREATE TABLE `tb_indikator_kepuasan` (
  `id_indikator_kepuasan` varchar(25) NOT NULL,
  `indikator_kepuasan` varchar(25) DEFAULT '',
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_indikator_kepuasan`
--

INSERT INTO `tb_indikator_kepuasan` (`id_indikator_kepuasan`, `indikator_kepuasan`, `nilai`) VALUES
('IK000001', 'SANGAT TIDAK PUAS', 1),
('IK000002', 'TIDAK PUAS', 2),
('IK000003', 'Cukup Puas', 3),
('IK000004', 'PUAS', 4),
('IK000005', 'SANGAT PUAS', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_item_penilaian`
--

CREATE TABLE `tb_item_penilaian` (
  `id_item_penilaian` varchar(25) NOT NULL,
  `id_penjualan_tiket` varchar(25) DEFAULT NULL,
  `id_parameter` varchar(25) DEFAULT NULL,
  `id_indikator` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_item_penilaian`
--

INSERT INTO `tb_item_penilaian` (`id_item_penilaian`, `id_penjualan_tiket`, `id_parameter`, `id_indikator`) VALUES
('20230100001', 'J20230100002', 'PM000001', 'IK000005'),
('20230100002', 'J20230100002', 'PM000002', 'IK000004'),
('20230100003', 'J20230100002', 'PM000003', 'IK000004'),
('20230100004', 'J20230100001', 'PM000001', 'IK000004'),
('20230100005', 'J20230100001', 'PM000002', 'IK000003'),
('20230100006', 'J20230100001', 'PM000003', 'IK000003'),
('20230100007', 'J20230100003', 'PM000001', 'IK000002'),
('20230100008', 'J20230100003', 'PM000002', 'IK000002'),
('20230100009', 'J20230100003', 'PM000003', 'IK000003'),
('20230100010', 'J20230100004', 'PM000001', 'IK000004'),
('20230100011', 'J20230100004', 'PM000002', 'IK000004'),
('20230100012', 'J20230100004', 'PM000003', 'IK000004'),
('20230100013', 'J20230100005', 'PM000001', 'IK000005'),
('20230100014', 'J20230100005', 'PM000002', 'IK000004'),
('20230100015', 'J20230100005', 'PM000003', 'IK000005'),
('20230100016', 'J20230100006', 'PM000001', 'IK000003'),
('20230100017', 'J20230100006', 'PM000002', 'IK000003'),
('20230100018', 'J20230100006', 'PM000003', 'IK000003'),
('20230100019', 'J20230100007', 'PM000001', 'IK000004'),
('20230100020', 'J20230100007', 'PM000002', 'IK000005'),
('20230100021', 'J20230100007', 'PM000003', 'IK000004'),
('20230100022', 'J20230100008', 'PM000001', 'IK000005'),
('20230100023', 'J20230100008', 'PM000002', 'IK000005'),
('20230100024', 'J20230100008', 'PM000003', 'IK000005'),
('20230100025', 'J20230100009', 'PM000001', 'IK000004'),
('20230100026', 'J20230100009', 'PM000002', 'IK000004'),
('20230100027', 'J20230100009', 'PM000003', 'IK000004'),
('20230100028', 'J20230100010', 'PM000001', 'IK000002'),
('20230100029', 'J20230100010', 'PM000002', 'IK000001'),
('20230100030', 'J20230100010', 'PM000003', 'IK000001'),
('20230100031', 'J20230100011', 'PM000001', 'IK000004'),
('20230100032', 'J20230100011', 'PM000002', 'IK000004'),
('20230100033', 'J20230100011', 'PM000003', 'IK000004'),
('20230100034', 'J20230100012', 'PM000001', 'IK000005'),
('20230100035', 'J20230100012', 'PM000002', 'IK000005'),
('20230100036', 'J20230100012', 'PM000003', 'IK000005');

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
-- Struktur dari tabel `tb_kategori_bus`
--

CREATE TABLE `tb_kategori_bus` (
  `id_kategori` varchar(10) NOT NULL,
  `nm_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori_bus`
--

INSERT INTO `tb_kategori_bus` (`id_kategori`, `nm_kategori`) VALUES
('AKAP', 'Angkutan Antarkota Antarprovinsi'),
('AKDP', 'Angkutan Antarkota Dalam Provinsi'),
('WISATA', 'BUS PARIWISATA');

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
('PM000001', 'Apakah anda puas dengan pelayanan pemberian informasi kami ?'),
('PM000002', 'Apakah anda puas dengan proses transaksi pemesanan tiket pada website kami ?'),
('PM000003', 'Apakah anda puas dengan pelayanan perjalanan dari kami?');

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
('P2300000', 'U2300000', 'GUEST/Non Member', '', 'GUEST'),
('P2300001', 'U2300001', 'Lastri', '08134558891', 'BAE KUDUS'),
('P2300002', 'U2300002', 'Paijo', '089676726', 'Test Alamat'),
('P2300003', 'U2300005', 'Akuu', '08134558891', 'Kudus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran_tiket`
--

CREATE TABLE `tb_pembayaran_tiket` (
  `id_pembayaran` varchar(25) NOT NULL,
  `id_penjualan_tiket` varchar(25) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `bukti_pembayaran` text DEFAULT NULL,
  `status_validasi` enum('TERUPLOAD','TERVALIDASI') DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembayaran_tiket`
--

INSERT INTO `tb_pembayaran_tiket` (`id_pembayaran`, `id_penjualan_tiket`, `nominal`, `bukti_pembayaran`, `status_validasi`, `tgl_bayar`) VALUES
('B20230100001', 'J20230100003', 120000, 'CASH', 'TERVALIDASI', '2023-01-28 21:11:22'),
('B20230100002', 'J20230100002', 120000, '1675033880091.jpg', 'TERVALIDASI', '2023-01-30 06:11:20'),
('B20230100003', 'J20230100001', 120000, '1675033880091.jpg', 'TERVALIDASI', '2023-02-19 08:17:02'),
('B20230100004', 'J20230100004', 120000, '1675033880091.jpg', 'TERVALIDASI', '2023-01-30 06:11:20'),
('B20230100005', 'J20230100005', 120000, '1675033880091.jpg', 'TERVALIDASI', '2023-01-30 06:11:20'),
('B20230100006', 'J20230100006', 120000, 'CASH', 'TERVALIDASI', '2023-01-30 06:11:20'),
('B20230100007', 'J20230100007', 120000, 'CASH', 'TERVALIDASI', '2023-01-30 06:11:20'),
('B20230100008', 'J20230100008', 120000, 'CASH', 'TERVALIDASI', '2023-01-30 06:11:20'),
('B20230100009', 'J20230100009', 120000, 'CASH', 'TERVALIDASI', '2023-01-30 06:11:20'),
('B20230100011', 'J20230100011', 120000, 'CASH', 'TERVALIDASI', '2023-01-30 06:11:20'),
('B20230100012', 'J20230100012', 120000, 'CASH', 'TERVALIDASI', '2023-01-30 06:11:20'),
('B20230200001', 'J20230200001', 60000, '1676270566251.png', 'TERVALIDASI', '2023-02-19 08:18:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penilaian_kepuasan`
--

CREATE TABLE `tb_penilaian_kepuasan` (
  `id_penilaian` varchar(25) NOT NULL,
  `id_tiket_bus` varchar(25) DEFAULT NULL,
  `nilai_kepuasan` int(11) DEFAULT NULL,
  `saran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penilaian_kepuasan`
--

INSERT INTO `tb_penilaian_kepuasan` (`id_penilaian`, `id_tiket_bus`, `nilai_kepuasan`, `saran`) VALUES
('N20230100001', '20230100002', 75, NULL);

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
  `jenis_penjualan_tiket` enum('OFFLINE','ONLINE') DEFAULT NULL,
  `status_tiket` enum('','BELUM SCAN','SUDAH SCAN') NOT NULL,
  `notif_wa` enum('','TERKIRIM','PENDING') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penjualan_tiket`
--

INSERT INTO `tb_penjualan_tiket` (`id_penjualan_tiket`, `id_tiket_bus`, `id_pelanggan`, `nm_pelanggan`, `no_pelanggan`, `tgl_pembelian`, `tgl_keberangkatan`, `jumlah_pembelian`, `jenis_penjualan_tiket`, `status_tiket`, `notif_wa`) VALUES
('J20230100001', '20230100001', 'P2300001', 'PELANGGAN 1', '08134558891', '2023-01-15 09:19:03', '2023-01-18 14:18:55', 1, 'OFFLINE', 'BELUM SCAN', NULL),
('J20230100002', '20230100003', 'P2300000', 'SAYA', '085643520576', '2023-01-27 13:57:14', '2023-02-14 09:00:00', 2, 'OFFLINE', 'SUDAH SCAN', 'TERKIRIM'),
('J20230100003', '20230100002', 'P2300001', 'PELANGGAN 1', '085643520576', '2023-01-28 20:53:51', '2023-01-20 04:18:55', 2, 'OFFLINE', 'BELUM SCAN', 'TERKIRIM'),
('J20230100004', '20230100002', 'P2300001', 'PELANGGAN 1', '08134558891', '2023-01-30 05:23:32', '2023-01-20 04:18:55', 3, 'ONLINE', 'BELUM SCAN', NULL),
('J20230100005', '20230100002', 'P2300001', 'PELANGGAN 1', '08134558891', '2023-01-30 05:25:31', '2023-01-20 04:18:55', 1, 'ONLINE', 'BELUM SCAN', NULL),
('J20230100006', '20230100002', 'P2300000', 'Painem', '08134558891', '2023-01-30 05:25:31', '2023-01-20 04:18:55', 1, 'OFFLINE', 'BELUM SCAN', NULL),
('J20230100007', '20230100002', 'P2300000', 'Paijo', '08134558891', '2023-01-30 05:25:31', '2023-01-20 04:18:55', 3, 'OFFLINE', 'BELUM SCAN', NULL),
('J20230100008', '20230100002', 'P2300000', 'Paijah', '08134558891', '2023-01-30 05:25:31', '2023-01-20 04:18:55', 2, 'OFFLINE', 'BELUM SCAN', NULL),
('J20230100009', '20230100002', 'P2300000', 'Michel', '08134558892', '2023-01-30 05:25:31', '2023-01-20 04:18:55', 1, 'OFFLINE', 'BELUM SCAN', NULL),
('J20230100010', '20230100002', 'P2300000', 'Cah Bagoes', '08134558893', '2023-01-30 05:25:31', '2023-01-20 04:18:55', 1, 'OFFLINE', 'BELUM SCAN', NULL),
('J20230100011', '20230100002', 'P2300000', 'Agus', '08134558894', '2023-01-30 05:25:31', '2023-01-20 04:18:55', 1, 'OFFLINE', 'BELUM SCAN', NULL),
('J20230100012', '20230100002', 'P2300000', 'Siti', '08134558895', '2023-01-30 05:25:31', '2023-01-20 04:18:55', 3, 'OFFLINE', 'BELUM SCAN', NULL),
('J20230100013', '20230100002', 'P2300000', 'Patrix', '08134558896', '2023-01-30 05:25:31', '2023-01-20 04:18:55', 2, 'OFFLINE', 'BELUM SCAN', NULL),
('J20230200001', '20230100002', 'P2300001', 'Lastri', '085643520576', '2023-02-13 12:21:28', '2023-02-14 04:18:55', 1, 'ONLINE', '', 'TERKIRIM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saran`
--

CREATE TABLE `tb_saran` (
  `id_saran` int(11) NOT NULL,
  `id_penjualan_tiket` varchar(25) NOT NULL,
  `saran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_saran`
--

INSERT INTO `tb_saran` (`id_saran`, `id_penjualan_tiket`, `saran`) VALUES
(6, 'J20230100002', 'Selalu tingkatkan kualitas pelayanan'),
(7, 'J20230100001', 'bagus'),
(8, 'J20230100003', 'Tolong ditingkatkan lagi kualitas pelayanannya'),
(9, 'J20230100004', 'Oke'),
(10, 'J20230100005', 'Siiip'),
(11, 'J20230100006', 'Biasa saja'),
(12, 'J20230100007', 'Okelah'),
(13, 'J20230100008', 'mantab Jiwa'),
(14, 'J20230100009', 'Puaslah'),
(15, 'J20230100010', 'Payah'),
(16, 'J20230100011', 'Lumayan'),
(17, 'J20230100012', 'Recomended');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tiket_bus`
--

CREATE TABLE `tb_tiket_bus` (
  `id_tiket_bus` varchar(25) NOT NULL,
  `id_bus` varchar(25) DEFAULT NULL,
  `kota_keberangkatan` varchar(50) DEFAULT NULL,
  `lokasi_kumpul` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tgl_keberangkatan` datetime DEFAULT NULL,
  `jumlah_max` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `tipe_tiket` enum('ANTAR KOTA','WISATA') DEFAULT NULL,
  `tiket_scanned` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tiket_bus`
--

INSERT INTO `tb_tiket_bus` (`id_tiket_bus`, `id_bus`, `kota_keberangkatan`, `lokasi_kumpul`, `tujuan`, `tgl_keberangkatan`, `jumlah_max`, `harga`, `tipe_tiket`, `tiket_scanned`) VALUES
('20230100001', 'BS000001', 'KUDUS', 'Terminal Jati', 'Purwokerto', '2023-01-18 14:18:55', 50, 50000, 'ANTAR KOTA', 0),
('20230100002', 'BS000002', 'KUDUS', 'Terminal Jati', 'Yogyakarta', '2023-02-14 04:18:55', 52, 60000, 'ANTAR KOTA', 0),
('20230100003', 'BS000002', 'KUDUS', 'Garasi PO. Bus', 'Yogyakarta', '2023-02-14 09:00:00', 52, 60000, 'WISATA', 2),
('20230100004', 'BS000002', 'KUDUS', 'Universitas Muria Kudus (UMK)', 'KKL ke Jakarta', '2023-01-31 07:00:00', 52, 600000, 'WISATA', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(25) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nm_pengguna` varchar(35) DEFAULT NULL,
  `level` enum('DIREKTUR','SEKERTARIS','ADMIN','PELANGGAN','BENDAHARA') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nm_pengguna`, `level`) VALUES
('U2300000', 'admin', 'admin', 'ADMIN', 'ADMIN'),
('U2300001', 'PELANGGAN', 'PELANGGAN', 'Lastri', 'PELANGGAN'),
('U2300002', 'User', 'Password', 'Paijo', 'PELANGGAN'),
('U2300003', 'DIREKTUR', 'DIREKTUR', 'Berlian Direktur', 'DIREKTUR'),
('U2300004', 'SEKERTARIS', 'SEKERTARIS', 'BERLIAN SEKERTARIS', 'SEKERTARIS'),
('U2300005', 'akuu', 'akuu', 'Akuu', 'PELANGGAN'),
('U2300006', 'BENDAHARA', 'BENDAHARA', 'Bendahara PO Berlian', 'BENDAHARA');

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
-- Indeks untuk tabel `tb_kategori_bus`
--
ALTER TABLE `tb_kategori_bus`
  ADD PRIMARY KEY (`id_kategori`);

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
-- Indeks untuk tabel `tb_saran`
--
ALTER TABLE `tb_saran`
  ADD PRIMARY KEY (`id_saran`);

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

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_saran`
--
ALTER TABLE `tb_saran`
  MODIFY `id_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
