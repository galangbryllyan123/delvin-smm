-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Mar 2019 pada 07.29
-- Versi server: 5.7.25-log
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instagr8_abc1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(10) NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_setting`
--

CREATE TABLE `api_setting` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `apikey` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `apiurl` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `api_setting`
--

INSERT INTO `api_setting` (`id`, `name`, `apikey`, `apiurl`) VALUES
(6, 'MANUAL', '01234567890', 'http://instagrams.link/'),
(9, 'SALSABILMUS', '96', 'https:/'),
(5, 'SALSA', 'N6EDWUgHLV', 'http://salsabilmus.xyz/api/order/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `category_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `enable` enum('yes','no') COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `category_name`, `enable`) VALUES
(1, 'Instagram Views', 'yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposit`
--

CREATE TABLE `deposit` (
  `id` int(10) NOT NULL,
  `date` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `via` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `via_detail` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jadi` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `sender` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `proof` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `uplink` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` enum('pending','fraud','unpaid','paid') COLLATE latin1_general_ci NOT NULL,
  `approved_by` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposit_r`
--

CREATE TABLE `deposit_r` (
  `id` int(10) NOT NULL,
  `rate` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tujuan` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `provider` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `deposit_r`
--

INSERT INTO `deposit_r` (`id`, `rate`, `tujuan`, `provider`) VALUES
(1, '0.80', '081222328727', 'TELKOMSEL'),
(2, '1.00', '4460361058 - A.n. Salsabila Mustaqimah', 'BANK BCA(Bank Central Asia)'),
(3, '1.00', 'An. ABDURAHAMAN: 4172-01-005812-53-4', 'BANK BRI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `order_id` int(255) NOT NULL,
  `id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `data` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `quantity` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `start` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `remain` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `service_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `price` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `uplink` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `service_id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `date` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`order_id`, `id`, `data`, `quantity`, `start`, `remain`, `service_name`, `status`, `price`, `uplink`, `service_id`, `date`) VALUES
(1, '', 'https://www.instagram.com/p/Bu76Mt9hQ2K/', '1000', '', '', 'instagram views server 1', '', '10', 'salsabilmus', '1', '19-03-2019'),
(2, '', 'https://www.instagram.com/p/Bu76Mt9hQ2K/', '1000', '', '', 'instagram views server 1', '', '10', 'salsabilmus', '1', '19-03-2019'),
(3, '17173227', 'https://www.instagram.com/p/BuoNjZnA0ap/', '100', '', '100', 'instagram views server 1', '1', '1', 'salsabilmus', '1001', '19-03-2019'),
(4, '', 'https://www.instagram.com/p/Bu76Mt9hQ2K/', '1000', '', '', 'instagram views gratis', '', '100', 'Admin', '1', '20-03-2019'),
(5, '', 'https://www.instagram.com/p/Bu76Mt9hQ2K/', '1000', '', '', 'instagram views gratis', '', '100', 'Admin', '1', '20-03-2019'),
(6, '', 'https://www.instagram.com/p/BuoNjZnA0ap/', '1000', '', '', 'instagram views gratis', '', '100', 'Admin', '1', '20-03-2019'),
(7, '', 'https://www.instagram.com/p/BuoNjZnA0ap/', '1000', '', '', 'instagram views gratis', '', '100', 'Admin', '1', '20-03-2019');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_manual`
--

CREATE TABLE `history_manual` (
  `order_id` int(255) NOT NULL,
  `id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `data` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `quantity` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `start` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `remain` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `service_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `price` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `uplink` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `service_id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `date` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id` int(10) NOT NULL,
  `informasi` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `bagian` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `date` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `nama` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level` enum('members','admin') COLLATE latin1_general_ci NOT NULL,
  `saldo` int(100) NOT NULL,
  `uplink` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `regdate` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `lastlogin` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `api` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`nama`, `username`, `password`, `level`, `saldo`, `uplink`, `regdate`, `lastlogin`, `api`) VALUES
('Sri Mulyawati', 'srimulyawati', '06042000', 'members', 0, 'server', '19-03-2019', '', '7f7246243d5fba5d0988268cb5d258a0'),
('Ferdi', 'Ferdi', '01000110', 'members', 0, 'server', '19-03-2019', '', '27fb67e0635af282f64ece6961ebb2ca'),
('Devi Oktavia', 'dvoktavia_', 'dvoktavia123', 'members', 0, 'server', '19-03-2019', '', 'ae05372d2ec4dbcf371724b5511ac002'),
('Michelle', 'Michelle', 'Michelle13', 'members', 0, 'server', '19-03-2019', '', 'a0b843eea7f8bfdd7e96aa0f2aad84e0'),
('Admin', 'Admin', 'admin', 'admin', 89999600, 'server', '19-03-2019', '', '0163a2d59a4b63772ae97cbb5b348737');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `id` int(10) NOT NULL,
  `api_id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `api_s_id` int(255) NOT NULL,
  `service_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `service_min` int(255) NOT NULL,
  `service_max` int(255) NOT NULL,
  `service_price` int(255) NOT NULL,
  `service_category` int(255) NOT NULL,
  `closed` enum('yes','no') COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`id`, `api_id`, `api_s_id`, `service_name`, `service_min`, `service_max`, `service_price`, `service_category`, `closed`) VALUES
(1, '1001', 9, 'instagram views server 1', 100, 10000000, 10, 1, 'no'),
(2, '1', 5, 'instagram views gratis', 1000, 1000, 100, 1, 'no');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `api_setting`
--
ALTER TABLE `api_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deposit_r`
--
ALTER TABLE `deposit_r`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `history_manual`
--
ALTER TABLE `history_manual`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `api_setting`
--
ALTER TABLE `api_setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `deposit_r`
--
ALTER TABLE `deposit_r`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `history_manual`
--
ALTER TABLE `history_manual`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `service`
--
ALTER TABLE `service`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
