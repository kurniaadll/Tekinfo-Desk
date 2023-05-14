-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 01:00 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tekinfodesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stock`, `harga`) VALUES
(1, 'pena', 20, 2000),
(2, 'buku', 10, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(50) NOT NULL,
  `kabid` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `nama_bidang`, `kabid`, `keterangan`) VALUES
(1, 'Ketua Umum', 2111082008, 'Ketua Umum HMJ Tekinfo'),
(2, 'Sekretaris', 2101091007, 'Sekretaris'),
(3, 'Bendahara', 2111081002, 'Bendahara HMJ Tekinfo'),
(4, 'KOMINFO', 2111083014, 'Bidang Komunikasi dan Informasi'),
(5, 'DANUS', 2111082034, 'Bidang Dana Usaha'),
(6, 'MIKAT', 2111082012, 'Bidang Minat dan Bakat'),
(7, 'HUMAS', 2111081009, 'Bidang Hubungan Masyarakat'),
(8, 'KOMDIS', 2102092062, 'Bidang Komisi Disiplin'),
(9, 'PSDM', 2111081008, 'Bidang Pengembangan Sumber Daya Manusia');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detailtransaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detailtransaksi`, `id_transaksi`, `id_barang`, `qty`) VALUES
(1, 1, 2, 1),
(2, 2, 1, 1),
(3, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(11) NOT NULL,
  `id_pengurus` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `status` enum('terlambat','tidak terlambat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id_kas`, `id_pengurus`, `tanggal`, `bulan`, `status`) VALUES
(1, 2111082008, 11, 3, 'terlambat'),
(2, 2111083014, 5, 3, 'tidak terlambat'),
(3, 2111081009, 12, 3, 'terlambat'),
(4, 2101091007, 12, 2, 'terlambat'),
(5, 2111081002, 9, 4, 'tidak terlambat');

-- --------------------------------------------------------

--
-- Table structure for table `ormawa`
--

CREATE TABLE `ormawa` (
  `id_ormawa` int(11) NOT NULL,
  `nama_ormawa` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ormawa`
--

INSERT INTO `ormawa` (`id_ormawa`, `nama_ormawa`, `keterangan`) VALUES
(1, 'HMJ E', 'Himpunan Mahasiswa Jurusan Elektro'),
(2, 'HMJ BI', 'Himpunan Mahasiswa Jurusan Bahasa Inggris'),
(3, 'HMJ AN', 'Himpunan Mahasiswa Jurusan Administrasi Niaga'),
(4, 'HMJ AK', 'Himpunan Mahasiswa Jurusan Akuntansi'),
(5, 'HMTS', 'Himpunan Mahasiswa Teknik Sipil'),
(6, 'HMM', 'Himpunan Mahasiswa Mesin');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id_pengurus` int(11) NOT NULL,
  `nama_pengurus` varchar(50) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id_pengurus`, `nama_pengurus`, `id_bidang`, `id_prodi`) VALUES
(22111111, 'Rifa Febria', 2, 1),
(221081000, 'Mai tasa', 3, 1),
(2101091007, 'Mia Aprilia', 2, 2),
(2102092062, 'Qurratu Aini', 8, 2),
(2111081002, 'Arshifa Demuna', 3, 1),
(2111081008, 'Libryan Adetya', 9, 1),
(2111081009, 'Messy Widianti', 7, 1),
(2111082008, 'Aulia Razak Akmal', 1, 2),
(2111082012, 'Dinda Gatya Rabbani', 6, 1),
(2111082034, 'Nadia Monika Putri', 5, 1),
(2111083014, 'Jesica Sanditia Putri', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`) VALUES
(1, 'Teknologi Rekayasa Perangkat Lunak'),
(2, 'Manajemen Informatika'),
(3, 'Teknik Komputer');

-- --------------------------------------------------------

--
-- Table structure for table `proker`
--

CREATE TABLE `proker` (
  `id_proker` int(11) NOT NULL,
  `nama_proker` varchar(50) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `keterangan_proker` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proker`
--

INSERT INTO `proker` (`id_proker`, `nama_proker`, `id_bidang`, `keterangan_proker`) VALUES
(1, 'Workshop wirausaha', 5, 'Menajalankan kewirausahaan di kesekeretaritan hima tekinfo'),
(2, 'Mengumpulkan uang kas', 3, 'Mencatat siapa saja yang sudah membayar uang kas'),
(3, 'Menulis surat', 2, 'Mencatat surat yang masuk dan keluar'),
(4, 'Mengecek jalannya organisasi', 1, 'Memastikan proker berjalan sesuai ketentuan'),
(5, 'Pembagian takjil ', 7, 'Membagikan takjil di bulan Ramadhan kepada masyarakat sekitar'),
(6, 'Posting peringatan hari besar', 4, 'Mmemposting di instagram setiap ada peringatan hari besar');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL,
  `no_surat` int(11) NOT NULL,
  `kode_surat` varchar(20) NOT NULL,
  `id_ormawa` int(11) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jenis_surat` enum('surat masuk','surat keluar') NOT NULL,
  `keterangan_surat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id_surat`, `no_surat`, `kode_surat`, `id_ormawa`, `bulan`, `tahun`, `jenis_surat`, `keterangan_surat`) VALUES
(1, 1, 'ph', 6, 'I', 2023, 'surat masuk', 'surat masuk undangan mengikuti mubes'),
(3, 1, 'sh', 1, 'II', 2023, 'surat keluar', 'Undangan acara');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kasir` int(20) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kasir`, `waktu`, `keterangan`) VALUES
(1, 2111082034, '2023-04-28 07:09:55', ''),
(2, 2111082034, '2023-04-28 07:09:59', ''),
(3, 2111082008, '2023-04-28 12:15:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_pengurus` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','sekretaris','bendahara','danus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_pengurus`, `username`, `password`, `level`) VALUES
(22111111, 'rifa', 'd41d8cd98f00b204e9800998ecf8427e', 'sekretaris'),
(221081000, 'tasa', 'd41d8cd98f00b204e9800998ecf8427e', 'bendahara'),
(2101091007, 'sekretaris', 'ce1023b227de5c34b98c470cda4699bb', 'sekretaris'),
(2111081002, 'bendahara', 'c9ccd7f3c1145515a9d3f7415d5bcbea', 'bendahara'),
(2111082008, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2111082034, 'danus', 'b931999581a17d90438ed7416188db8b', 'danus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`),
  ADD KEY `id_pengurus` (`kabid`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detailtransaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`),
  ADD KEY `id_pengurus` (`id_pengurus`);

--
-- Indexes for table `ormawa`
--
ALTER TABLE `ormawa`
  ADD PRIMARY KEY (`id_ormawa`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id_pengurus`),
  ADD KEY `id_bidang` (`id_bidang`,`id_prodi`),
  ADD KEY `pengurus_ibfk_2` (`id_prodi`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `proker`
--
ALTER TABLE `proker`
  ADD PRIMARY KEY (`id_proker`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_ormawa` (`id_ormawa`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_pengurus`),
  ADD KEY `id_pengurus` (`id_pengurus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detailtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id_kas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ormawa`
--
ALTER TABLE `ormawa`
  MODIFY `id_ormawa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proker`
--
ALTER TABLE `proker`
  MODIFY `id_proker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidang`
--
ALTER TABLE `bidang`
  ADD CONSTRAINT `bidang_ibfk_1` FOREIGN KEY (`kabid`) REFERENCES `pengurus` (`id_pengurus`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `kas`
--
ALTER TABLE `kas`
  ADD CONSTRAINT `kas_ibfk_1` FOREIGN KEY (`id_pengurus`) REFERENCES `pengurus` (`id_pengurus`) ON UPDATE CASCADE;

--
-- Constraints for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `pengurus_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pengurus_ibfk_3` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`);

--
-- Constraints for table `proker`
--
ALTER TABLE `proker`
  ADD CONSTRAINT `proker_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`);

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`id_ormawa`) REFERENCES `ormawa` (`id_ormawa`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_pengurus`) REFERENCES `pengurus` (`id_pengurus`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
