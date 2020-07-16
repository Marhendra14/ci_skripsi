-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 04:38 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_produksi_cup`
--

CREATE TABLE `data_produksi_cup` (
  `id_data_produksi_cup` int(10) NOT NULL,
  `id_petugas` int(10) NOT NULL,
  `id_kantong` int(10) NOT NULL,
  `no_batch` text NOT NULL,
  `total_cup` int(10) NOT NULL,
  `jumlah_cup_reject` int(10) NOT NULL,
  `jumlah_cup_bersih` int(10) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_produksi_cup`
--

INSERT INTO `data_produksi_cup` (`id_data_produksi_cup`, `id_petugas`, `id_kantong`, `no_batch`, `total_cup`, `jumlah_cup_reject`, `jumlah_cup_bersih`, `tanggal_pembuatan`, `id_status`) VALUES
(1, 1, 1, '03062020', 40, 10, 30, '2020-06-04 18:36:49', 1),
(2, 3, 3, '03062020', 40, 10, 30, '2020-06-04 18:32:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_produksi_dan_penjualan_produk`
--

CREATE TABLE `data_produksi_dan_penjualan_produk` (
  `id_data_produksi_dan_penjualan_produk` int(10) NOT NULL,
  `id_petugas` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `no_batch` text NOT NULL,
  `jumlah_produk` int(10) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_vendor` varchar(225) NOT NULL,
  `alamat_vendor` varchar(225) NOT NULL,
  `no_telephone_vendor` varchar(20) NOT NULL,
  `id_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_yang_akan_diramal`
--

CREATE TABLE `data_yang_akan_diramal` (
  `data_ke` int(10) NOT NULL,
  `data_produksi_bulan_lalu` int(10) NOT NULL,
  `perkalian_data` int(10) NOT NULL,
  `data_ke_kuadrat` int(10) NOT NULL,
  `hasil_peramalan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_yang_akan_diramal`
--

INSERT INTO `data_yang_akan_diramal` (`data_ke`, `data_produksi_bulan_lalu`, `perkalian_data`, `data_ke_kuadrat`, `hasil_peramalan`) VALUES
(1, 17118, 17118, 1, 17118),
(2, 16325, 32650, 4, 15532),
(3, 20892, 62676, 9, 21886),
(4, 18546, 74184, 16, 20433),
(5, 22453, 112265, 25, 22934),
(6, 19929, 119574, 36, 22220),
(7, 23109, 161763, 49, 23588);

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int(10) NOT NULL,
  `nama_departemen` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`) VALUES
(1, 'Super Admin'),
(2, 'Logistik'),
(3, 'Manufacturing Area 3'),
(4, 'Pengeluaran');

-- --------------------------------------------------------

--
-- Table structure for table `history_cup`
--

CREATE TABLE `history_cup` (
  `id_history_cup` int(10) NOT NULL,
  `id_kantong` int(10) NOT NULL,
  `no_batch` text NOT NULL,
  `waktu_pembuatan_no` datetime NOT NULL,
  `waktu_setelah_digunakan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_cup`
--

INSERT INTO `history_cup` (`id_history_cup`, `id_kantong`, `no_batch`, `waktu_pembuatan_no`, `waktu_setelah_digunakan`) VALUES
(1, 1, '03062020', '2020-06-03 20:42:49', '0000-00-00 00:00:00'),
(2, 2, '04062020', '2020-06-04 18:31:23', '0000-00-00 00:00:00'),
(3, 3, '04062020', '2020-06-04 18:31:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `history_produk`
--

CREATE TABLE `history_produk` (
  `id_history_produk` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `no_batch` text NOT NULL,
  `waktu_pembuatan_no` datetime NOT NULL,
  `waktu_setelah_digunakan` datetime NOT NULL,
  `id_vendor` int(10) NOT NULL,
  `alamat_vendor` varchar(225) NOT NULL,
  `no_telephone_vendor` varchar(225) NOT NULL,
  `jumlah_produk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_produk`
--

INSERT INTO `history_produk` (`id_history_produk`, `id_produk`, `no_batch`, `waktu_pembuatan_no`, `waktu_setelah_digunakan`, `id_vendor`, `alamat_vendor`, `no_telephone_vendor`, `jumlah_produk`) VALUES
(1, 1, '03062020', '2020-06-03 20:46:53', '0000-00-00 00:00:00', 0, '', '', 0),
(2, 10, '04062020', '2020-06-04 15:13:56', '0000-00-00 00:00:00', 0, '', '', 0),
(3, 9, '04062020', '2020-06-04 17:20:33', '0000-00-00 00:00:00', 0, '', '', 0),
(4, 1, '04062020', '2020-06-04 21:03:43', '0000-00-00 00:00:00', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `isi_logistik`
--

CREATE TABLE `isi_logistik` (
  `id_isi_logistik` int(10) NOT NULL,
  `id_petugas` int(10) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `data_produksi_bulan_lalu` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isi_logistik`
--

INSERT INTO `isi_logistik` (`id_isi_logistik`, `id_petugas`, `bulan`, `tahun`, `data_produksi_bulan_lalu`) VALUES
(1, 2, 1, 2019, 17118),
(2, 2, 2, 2019, 16325),
(3, 2, 3, 2019, 20892),
(4, 2, 4, 2019, 18546),
(5, 2, 5, 2019, 22453),
(6, 2, 6, 2019, 19929),
(7, 2, 7, 2019, 23109);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(10) NOT NULL,
  `nama_jabatan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(3, 'A'),
(4, 'B'),
(5, 'C'),
(6, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `kantong`
--

CREATE TABLE `kantong` (
  `id_kantong` int(10) NOT NULL,
  `id_petugas` int(10) NOT NULL,
  `no_batch` text NOT NULL,
  `no_kantong` int(10) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kantong`
--

INSERT INTO `kantong` (`id_kantong`, `id_petugas`, `no_batch`, `no_kantong`, `tanggal_pembuatan`, `id_status`) VALUES
(1, 3, '03062020', 1, '2020-06-03 20:42:49', 1),
(2, 3, '04062020', 2, '2020-06-04 18:31:23', 1),
(3, 3, '04062020', 3, '2020-06-04 18:31:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(10) NOT NULL,
  `id_petugas` int(10) NOT NULL,
  `id_vendor` int(10) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL,
  `jumlah_produk_keluar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_petugas`, `id_vendor`, `tanggal_pembuatan`, `jumlah_produk_keluar`) VALUES
(1, 1, 1, '2020-05-05 00:00:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `petugas_aplikasi`
--

CREATE TABLE `petugas_aplikasi` (
  `id_petugas` int(100) NOT NULL,
  `nik` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `nama_karyawan` varchar(225) NOT NULL,
  `id_departemen` int(10) NOT NULL,
  `grade` int(10) NOT NULL,
  `id_jabatan` int(10) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas_aplikasi`
--

INSERT INTO `petugas_aplikasi` (`id_petugas`, `nik`, `password`, `nama_karyawan`, `id_departemen`, `grade`, `id_jabatan`, `is_active`) VALUES
(1, '12345', '12345', 'Pratama Putra Marhendra', 1, 9, 3, 1),
(2, '2', '2', 'Dua', 2, 9, 3, 1),
(3, '3', '3', 'Tiga', 3, 9, 3, 1),
(4, '4', '4', 'Empat', 4, 9, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) NOT NULL,
  `id_petugas` int(10) NOT NULL,
  `no_batch` text NOT NULL,
  `no_produk` int(10) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_petugas`, `no_batch`, `no_produk`, `tanggal_pembuatan`, `id_status`) VALUES
(1, 3, '03062020', 1, '2020-06-03 20:46:53', 1),
(2, 3, '04062020', 10, '2020-06-04 15:13:56', 1),
(3, 3, '04062020', 9, '2020-06-04 17:20:33', 1),
(4, 3, '04062020', 1, '2020-06-04 21:03:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(10) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Belum Digunakan'),
(2, 'Sedang Digunakan'),
(3, 'Sudah Digunakan'),
(4, 'Belum Terjual'),
(5, 'Terjual');

-- --------------------------------------------------------

--
-- Table structure for table `storage_cup`
--

CREATE TABLE `storage_cup` (
  `jumlah_cup` int(10) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `storage_produk`
--

CREATE TABLE `storage_produk` (
  `jumlah_produk` int(10) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(10) NOT NULL,
  `nama_vendor` varchar(225) NOT NULL,
  `alamat_vendor` varchar(225) NOT NULL,
  `no_telephone_vendor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `alamat_vendor`, `no_telephone_vendor`) VALUES
(1, 'Rumah Sakit Prima Husada Pandaan', 'Karangjati, Pandaan', '081234567890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_produksi_cup`
--
ALTER TABLE `data_produksi_cup`
  ADD PRIMARY KEY (`id_data_produksi_cup`);

--
-- Indexes for table `data_produksi_dan_penjualan_produk`
--
ALTER TABLE `data_produksi_dan_penjualan_produk`
  ADD PRIMARY KEY (`id_data_produksi_dan_penjualan_produk`);

--
-- Indexes for table `data_yang_akan_diramal`
--
ALTER TABLE `data_yang_akan_diramal`
  ADD PRIMARY KEY (`data_ke`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `history_cup`
--
ALTER TABLE `history_cup`
  ADD PRIMARY KEY (`id_history_cup`);

--
-- Indexes for table `history_produk`
--
ALTER TABLE `history_produk`
  ADD PRIMARY KEY (`id_history_produk`);

--
-- Indexes for table `isi_logistik`
--
ALTER TABLE `isi_logistik`
  ADD PRIMARY KEY (`id_isi_logistik`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kantong`
--
ALTER TABLE `kantong`
  ADD PRIMARY KEY (`id_kantong`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `petugas_aplikasi`
--
ALTER TABLE `petugas_aplikasi`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_produksi_cup`
--
ALTER TABLE `data_produksi_cup`
  MODIFY `id_data_produksi_cup` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `data_produksi_dan_penjualan_produk`
--
ALTER TABLE `data_produksi_dan_penjualan_produk`
  MODIFY `id_data_produksi_dan_penjualan_produk` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `history_cup`
--
ALTER TABLE `history_cup`
  MODIFY `id_history_cup` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `history_produk`
--
ALTER TABLE `history_produk`
  MODIFY `id_history_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `isi_logistik`
--
ALTER TABLE `isi_logistik`
  MODIFY `id_isi_logistik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kantong`
--
ALTER TABLE `kantong`
  MODIFY `id_kantong` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `petugas_aplikasi`
--
ALTER TABLE `petugas_aplikasi`
  MODIFY `id_petugas` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
