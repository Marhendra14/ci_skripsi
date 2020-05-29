-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 06:26 AM
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
(1, 111, 111, 1, 0),
(2, 222, 444, 4, 0),
(3, 2020, 6060, 9, 0),
(4, 2121, 8484, 16, 0),
(5, 2929, 14645, 25, 0),
(6, 77, 462, 36, 0),
(7, 333, 2331, 49, 0),
(8, 44, 352, 64, 0),
(9, 28, 252, 81, 0),
(10, 19, 190, 100, 0),
(11, 12, 132, 121, 0),
(12, 14, 168, 144, 0),
(13, 21, 273, 169, 0),
(14, 13, 182, 196, 0),
(15, 91, 1365, 225, 0),
(16, 31, 496, 256, 0),
(17, 13, 221, 289, 0);

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
(1, 'Manufacturing Area 1'),
(2, 'Manufacturing Area 2'),
(3, 'Manufacturing Area 3'),
(4, 'Manufacturing Area 4'),
(5, 'Logistik');

-- --------------------------------------------------------

--
-- Table structure for table `isi_admin_produk`
--

CREATE TABLE `isi_admin_produk` (
  `id_data_produk` int(10) NOT NULL,
  `id_petugas` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 4, 1, 2020, 111),
(2, 4, 2, 2020, 222),
(3, 4, 1, 2020, 2020),
(4, 4, 2, 2020, 2121),
(5, 4, 3, 2020, 2929),
(6, 4, 7, 2020, 77),
(7, 4, 3, 2020, 333),
(8, 4, 4, 2020, 44),
(9, 4, 8, 2020, 28),
(10, 4, 2, 2020, 19),
(11, 4, 2, 2020, 12),
(12, 4, 8, 2020, 14),
(13, 4, 3, 2020, 21),
(14, 4, 3, 2020, 13),
(15, 4, 3, 2020, 91),
(16, 4, 1, 2020, 31),
(17, 4, 2, 2020, 13);

-- --------------------------------------------------------

--
-- Table structure for table `isi_storage_cup`
--

CREATE TABLE `isi_storage_cup` (
  `id_data_produksi_cup` int(10) NOT NULL,
  `id_petugas` int(10) NOT NULL,
  `id_kantong` int(10) NOT NULL,
  `total_cup` int(10) NOT NULL,
  `jumlah_cup_reject` int(10) NOT NULL,
  `jumlah_cup_bersih` int(10) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `no_batch` int(10) NOT NULL,
  `no_kantong` int(10) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL,
  `id_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kantong`
--

INSERT INTO `kantong` (`id_kantong`, `no_batch`, `no_kantong`, `tanggal_pembuatan`, `id_status`) VALUES
(5, 29052020, 1, '2020-05-29 00:00:00', 1),
(6, 29042020, 2, '2020-11-11 00:00:00', 1),
(7, 29042020, 3, '2020-11-11 00:00:00', 1),
(8, 29042020, 2, '2020-11-11 00:00:00', 1),
(9, 29042020, 9, '2020-11-11 00:00:00', 1);

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
(1, '1234', '1234', 'M', 1, 9, 3, 1),
(2, '1', '1', '1', 1, 1, 3, 1),
(3, '12', '12', '12', 1, 12, 3, 2),
(4, '12345', '12345', '12345', 3, 12345, 6, 1),
(5, '1010', '1010', 'Agus', 3, 9, 3, 1),
(6, '2', '2', 'Halu', 2, 9, 4, 1),
(7, '2', '2', 'Halu', 2, 9, 4, 2),
(8, '333', '333', 'Tiga Dara', 4, 10, 3, 1),
(9, '5', '5', '5', 5, 10, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) NOT NULL,
  `no_batch` int(10) NOT NULL,
  `no_produk` int(10) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `no_batch`, `no_produk`, `tanggal_pembuatan`, `id_status`) VALUES
(1, 30042020, 1, '2020-04-30 00:00:00', 4);

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
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
-- Table structure for table `tracking_kantong`
--

CREATE TABLE `tracking_kantong` (
  `id_tracking_kantong` int(10) NOT NULL,
  `id_kantong` int(10) NOT NULL,
  `id_data_produksi_cup` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(10) NOT NULL,
  `nama_vendor` varchar(225) NOT NULL,
  `alamat_vendor` varchar(225) NOT NULL,
  `no_telephone_vendor` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `alamat_vendor`, `no_telephone_vendor`) VALUES
(1, 'Abc', 'Panjaitan', 80789);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `isi_admin_produk`
--
ALTER TABLE `isi_admin_produk`
  ADD PRIMARY KEY (`id_data_produk`);

--
-- Indexes for table `isi_logistik`
--
ALTER TABLE `isi_logistik`
  ADD PRIMARY KEY (`id_isi_logistik`);

--
-- Indexes for table `isi_storage_cup`
--
ALTER TABLE `isi_storage_cup`
  ADD PRIMARY KEY (`id_data_produksi_cup`);

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
-- Indexes for table `tracking_kantong`
--
ALTER TABLE `tracking_kantong`
  ADD PRIMARY KEY (`id_tracking_kantong`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `isi_logistik`
--
ALTER TABLE `isi_logistik`
  MODIFY `id_isi_logistik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `isi_storage_cup`
--
ALTER TABLE `isi_storage_cup`
  MODIFY `id_data_produksi_cup` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kantong`
--
ALTER TABLE `kantong`
  MODIFY `id_kantong` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `petugas_aplikasi`
--
ALTER TABLE `petugas_aplikasi`
  MODIFY `id_petugas` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tracking_kantong`
--
ALTER TABLE `tracking_kantong`
  MODIFY `id_tracking_kantong` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
