-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2021 at 07:54 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jantung_bayes`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_probabilitas_p`
--

CREATE TABLE `nilai_probabilitas_p` (
  `kd_penyakit` varchar(4) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_probabilitas_p`
--

INSERT INTO `nilai_probabilitas_p` (`kd_penyakit`, `nilai`) VALUES
('P001', 0.3),
('P002', 0.3),
('P003', 0.4),
('P004', 0.3),
('P005', 0.3);

-- --------------------------------------------------------

--
-- Table structure for table `tbgejala`
--

CREATE TABLE `tbgejala` (
  `kd_gejala` char(4) NOT NULL,
  `gejala` varchar(100) NOT NULL,
  `kd_penyakit` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbgejala`
--

INSERT INTO `tbgejala` (`kd_gejala`, `gejala`, `kd_penyakit`) VALUES
('G001', 'Tidak dapat melepaskan pakaian dan memakai pakaian sendiri', ''),
('G002', 'Anak belum bisa duduk, berdiri, dan berjalan', ''),
('G003', 'Anak bisa duduk, berdiri, dan berjalan sesuai tahap tersebut', ''),
('G004', 'Sulit beradaptasi dengan aturan dan lingkungan yang tiba-tiba', ''),
('G005', 'Dapat menangkap, menendang dan melempar bola', ''),
('G006', 'Bisa bicara namun tidak dipakai untuk berkomunikasi', ''),
('G008', 'suka melakukan gerakan memutar ', ''),
('G009', 'Sering berlari, melompat, dan memanjat tidak terkontrol', ''),
('G010', 'tidak dapat meminta sesuatu yang diinginkan atau melakukan ', ''),
('G011', 'Menarik tangan orang dewasa ketika menginginkan sesuatu', ''),
('G012', 'Anak tidak suka keramaian atau tempat baru', ''),
('G013', 'Menangis saat menginginkan sesuatu', ''),
('G014', 'Susunan kalimat yang berantakan atau terbalik saat berkomunikasi', ''),
('G015', 'Bicara terlambat atau bahkan sama sekali tidak berkembang', ''),
('G016', 'Memiliki kontak mata selama 5 detik ketika dipanggil namanya', ''),
('G017', 'Anak sering mengucapkan kata-kata yang tidak jelas', ''),
('G018', 'Anak menghindari kontak mata dan kontak fisik dengan orang lain', ''),
('G019', 'Tidak menoleh atau menjawab saat dipanggil', ''),
('G020', 'Jika ditanya, bukan menjawab tapi mengulang pertanyaan yang ditanyakan', ''),
('G021', 'Senang dengan kontak fisik, seperti dicium, dipeluk, dibelai, dan digelitik', ''),
('G022', 'Dapat bermain dengan teman sebaya', ''),
('G023', 'Tidak bisa menanggapi perilaku orang lain baik secara lisan maupun non-lisan', ''),
('G024', 'Tidak menunjukan ekspresi wajah, saat sedih ataupun senang', ''),
('G025', 'Suka mengayunkan tangan dan kaki saat merasa kesal dan terganggu', ''),
('G026', 'Tidak dapat melawan ketika bertengkar atau hanya bisa menangis saat bertengkar', ''),
('G027', 'Tidak peduli dengan lingkungan sekitar', ''),
('G028', 'Dapat berhitung 1-10', ''),
('G029', 'Tantrum(ledakan emosi yang muncul saat keinginan tidak terpenuhi)', ''),
('G030', 'Menyakiti diri sendiri, seperti memukul kepala, menjatuhkan badan, dll', ''),
('G031', 'Menyakiti orang lain, seperti memukul tanpa sebab', ''),
('G032', 'Melakukan hal berbahaya, seperti memegang listrik atau berlari ke tengah jalan ketika marah', ''),
('G034', 'Menolak kontak fisik', ''),
('G035', 'Dapat duduk tenang saat diberi instruksi', ''),
('G036', 'Dapat salam yang baik dengan orang dewasa', ''),
('G037', 'Tidak ada kata yang dimengerti saat anak diajak berkomunikasi', ''),
('G038', 'Tidak bisa memegang alat tulis dengan benar, seperti memegang pensil saat mencoret kertas atau memeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbhasil`
--

CREATE TABLE `tbhasil` (
  `idhasil` int(4) NOT NULL,
  `idpasien` int(4) NOT NULL,
  `kd_penyakit` varchar(4) NOT NULL,
  `bobotpenyakit` double NOT NULL,
  `tanggal_diagnosa` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbhasil`
--

INSERT INTO `tbhasil` (`idhasil`, `idpasien`, `kd_penyakit`, `bobotpenyakit`, `tanggal_diagnosa`) VALUES
(1, 23, 'P003', 1.478, '2017-11-11 15:58:03'),
(2, 23, 'P002', 1, '2017-11-11 15:58:03'),
(3, 23, 'P005', 0.434, '2017-11-11 15:58:03'),
(4, 23, 'P001', 0.086, '2017-11-11 15:58:03'),
(5, 24, 'P004', 2.454, '2017-11-11 16:32:03'),
(6, 24, 'P001', 0.545, '2017-11-11 16:32:03'),
(7, 25, 'P003', 2, '2017-11-11 16:32:56'),
(8, 25, 'P001', 1, '2017-11-11 16:32:56'),
(9, 25, 'P002', 1, '2017-11-11 16:32:56'),
(10, 26, 'P005', 1.434, '2017-11-11 16:33:33'),
(11, 26, 'P004', 1, '2017-11-11 16:33:33'),
(12, 26, 'P002', 1, '2017-11-11 16:33:33'),
(13, 26, 'P003', 0.478, '2017-11-11 16:33:33'),
(14, 26, 'P001', 0.086, '2017-11-11 16:33:33'),
(15, 27, 'P004', 1, '2018-09-03 09:39:52'),
(16, 28, 'P004', 2, '2018-09-04 10:58:53'),
(17, 28, 'P002', 1, '2018-09-04 10:58:53'),
(18, 28, 'P003', 1, '2018-09-04 10:58:53'),
(19, 29, 'P004', 2, '2018-09-04 12:48:00'),
(20, 29, 'P003', 1, '2018-09-04 12:48:00'),
(21, 31, 'P005', 1.434, '2021-10-16 22:30:13'),
(22, 31, 'P002', 1, '2021-10-16 22:30:13'),
(23, 31, 'P003', 0.478, '2021-10-16 22:30:13'),
(24, 31, 'P001', 0.086, '2021-10-16 22:30:13'),
(25, 32, 'P003', 3, '2021-10-16 22:50:15'),
(26, 32, 'P001', 1, '2021-10-16 22:50:15'),
(27, 32, 'P004', 1, '2021-10-16 22:50:15'),
(28, 32, 'P005', 1, '2021-10-16 22:50:15'),
(29, 33, 'P002', 3.333, '2021-10-20 23:03:02'),
(30, 33, 'P003', 2.666, '2021-10-20 23:03:02'),
(31, 33, 'P001', 2.285, '2021-10-20 23:03:02'),
(32, 33, 'P004', 0.714, '2021-10-20 23:03:02'),
(33, 34, 'P002', 3.333, '2021-11-02 13:22:19'),
(34, 34, 'P001', 3, '2021-11-02 13:22:19'),
(35, 34, 'P003', 2.666, '2021-11-02 13:22:19'),
(36, 35, 'P003', 1.647, '2021-11-02 13:39:25'),
(37, 35, 'P001', 0.352, '2021-11-02 13:39:25'),
(38, 36, 'P003', 1.647, '2021-11-02 13:49:54'),
(39, 36, 'P001', 0.352, '2021-11-02 13:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbpasien`
--

CREATE TABLE `tbpasien` (
  `idpasien` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kelamin` varchar(10) NOT NULL,
  `umur` varchar(3) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpasien`
--

INSERT INTO `tbpasien` (`idpasien`, `nama`, `kelamin`, `umur`, `alamat`, `tanggal`, `email`) VALUES
(29, 'Test lagi', 'Laki-laki', '25', 'Jabar', '2018-09-04', 'test@gmail.com'),
(28, 'Testing', 'Laki-laki', '25', 'Jabar', '2018-09-04', 'test@yahoo.co'),
(34, 'fitra', 'Laki-laki', '3', 'jeuh', '2021-11-02', 'jajaja@gmail.com'),
(31, 'keke', 'Wanita', '27', 'jeuh', '2021-10-16', 'pppp@nekopoi.com'),
(32, 'fitra', 'Laki-laki', '18', 'letkolatmo', '2021-10-16', 'jajaja@gmail.com'),
(33, 'lele', 'Wanita', '11', 'letkolatmo2', '2021-10-20', 'pppp@nekochan.com'),
(35, 'lala', 'Wanita', '2', 'jeuh', '2021-11-02', 'pppp@nekoi.com'),
(36, 'suci', 'Wanita', '4', 'letkolatmo2', '2021-11-02', 'jajaja@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbpenyakit`
--

CREATE TABLE `tbpenyakit` (
  `kd_penyakit` char(4) NOT NULL,
  `nama_penyakit` varchar(50) DEFAULT NULL,
  `definisi` text DEFAULT NULL,
  `solusi` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpenyakit`
--

INSERT INTO `tbpenyakit` (`kd_penyakit`, `nama_penyakit`, `definisi`, `solusi`) VALUES
('P001', 'Keterlambatan Motorik/Gerak', 'Keterlambatan pada keterampilan motorik akan mengganggu kemampuan anak untuk mengendalikan otot di lengan, kaki, dan tangan. Keterlambatan perkembangan motorik pada bayi ditandai dengan gejala kesulitan berguling atau merangkak. Sementara anak yang lebih besar akan sulit melakukan pekerjaan dasar seperti memegang benda-benda kecil atau menyikat gigi', '- Membawa anak ke puskesmas atau rumah sakit terdekat untuk diperiksa tenaga medis\r\n- Menindaklanjuti hasil pemeriksaan dari tenaga medis dengan mengikuti petunjuk dan saran yang diberikan \r\n-Memerlukan latihan rutin, dan menggunakan alat bantu untuk mencegah bertambahnya gangguan dan memudahkan melakukan kegiatan sehari-hari.'),
('P002', 'Keterlambatan berbicara', 'Sering kali anak dengan keterlambatan perkembangan akan mengalami keterlambatan bicara secara reseptif dan ekspresif. Gangguan bahasa reseptif merupakan kondisi di mana seorang anak mengalami kesulitan untuk memahami kata-kata yang diucapkan orang lain. Anak menjadi sulit dalam mengidentifikasi warna, bagian tubuh, atau bentuk-bentuk.\r\n\r\nSementara itu, anak juga mengalami gangguan bahasa ekspresif yang ditandai dengan kurangnya kosakata dan kalimat rumit yang dimiliki untuk anak seusianya. Anak menjadi lebih lambat dalam bercakap, berbicara, dan membuat kalimat.', '- Membawa anak ke puskesmas atau rumah sakit terdekat untuk diperiksa tenaga medis\r\n\r\n- Dianjurkan ke Rumah Sakit yang pelayanan sudah lengkap dengan speech therapy (terapi wicara) \r\n\r\n- Menindaklanjuti hasil pemeriksaan dari tenaga medis dengan mengikuti petunjuk dan saran yang diberikan. \r\n'),
('P003', 'Keterlambatan sosial, emosional, dan perilaku', 'Keterlambatan sosial, emosional, dan perilaku disebabkan oleh perbedaan otak dalam memproses informasi, atau bereaksi terhadap lingkungan sekitar. Akibatya, kemampuan anak untuk belajar, berkomunikasi, dan berinteraksi dengan orang lain akan terganggu.', '- Membawa anak ke puskesmas atau rumah sakit terdekat untuk diperiksa tenaga medis \r\n\r\n- Menindaklanjuti hasil pemeriksaan dari tenaga medis dengan mengikuti petunjuk dan saran yang diberikan \r\n\r\n- Memasukkan anak ke sekolah yang sesuai dan kembangkan potensi yang dimiliki anak \r\n\r\n- Orangtua, keluarga harus memberikan contoh tentang sikap dan nilai, dan perilaku baik yang bisa menjadi tauladan bagi anak \r\n\r\n- Membangun suasana emosi positif dalam mendampingi anak, sehingga secara psikologis anak merasa dirinya lebih diterima\r\n \r\n- Memberi perhatian positif dan mengajak anak berperilaku baik \r\n\r\n- Memberi perintah yang efektif dan langsung ke tujuan\r\n\r\n '),
('P004', 'Normal', 'kondisi dimana seorang anak yang sempurna fisik, mental dan sosialnya, tidak mengidap penyakit dan kelemahan-kelemahan tertentu', 'Tetap berikan anak stimulasi yang baik dan sesuai tahapan perkembangan anak, berikan fasilitas untuk mendukung pertumbuhan dan perkembangan anak menjadi lebih baik lagi'),
('P005', 'Stimulasi OK', 'Stimulasi OK adalah kemampuan anak yang telah memenuhi semua aspek perkembangn, seperti motorik, perilaku, dan aspek lainnya.', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbrule`
--

CREATE TABLE `tbrule` (
  `id_rule` int(4) NOT NULL,
  `kd_gejala` char(4) NOT NULL,
  `kd_penyakit` char(4) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbrule`
--

INSERT INTO `tbrule` (`id_rule`, `kd_gejala`, `kd_penyakit`, `bobot`) VALUES
(1, 'G001', 'P001', 1),
(2, 'G002', 'P001', 1),
(3, 'G007', 'P001', 1),
(4, 'G008', 'P001', 1),
(5, 'G009', 'P001', 1),
(6, 'G015', 'P001', 1),
(8, 'G024', 'P001', 1),
(9, 'G025', 'P001', 1),
(10, 'G029', 'P001', 1),
(11, 'G032', 'P001', 1),
(13, 'G038', 'P001', 1),
(14, 'G006', 'P002', 1),
(18, 'G010', 'P002', 1),
(19, 'G014', 'P002', 1),
(20, 'G017', 'P002', 1),
(21, 'G019', 'P002', 1),
(22, 'G020', 'P002', 1),
(23, 'G023', 'P002', 1),
(24, 'G024', 'P002', 1),
(25, 'G037', 'P002', 1),
(26, 'G004', 'P003', 1),
(28, 'G012', 'P003', 1),
(29, 'G017', 'P003', 1),
(30, 'G018', 'P003', 1),
(31, 'G026', 'P003', 1),
(32, 'G027', 'P003', 1),
(33, 'G029', 'P003', 1),
(34, 'G030', 'P003', 1),
(35, 'G031', 'P003', 1),
(36, 'G032', 'P003', 1),
(37, 'G033', 'P003', 1),
(38, 'G034', 'P003', 1),
(39, 'G003', 'P004', 1),
(40, 'G009', 'P004', 1),
(41, 'G011', 'P004', 1),
(42, 'G013', 'P004', 1),
(43, 'G016', 'P004', 1),
(44, 'G021', 'P004', 1),
(45, 'G022', 'P004', 1),
(46, 'G033', 'P004', 1),
(47, 'G036', 'P004', 1),
(48, 'G003', 'P005', 1),
(49, 'G005', 'P005', 1),
(50, 'G011', 'P005', 1),
(51, 'G016', 'P005', 1),
(52, 'G021', 'P005', 1),
(53, 'G022', 'P005', 1),
(54, 'G028', 'P005', 1),
(55, 'G035', 'P005', 1),
(56, 'G036', 'P005', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_analisa`
--

CREATE TABLE `tmp_analisa` (
  `kd_proses` varchar(10) NOT NULL,
  `kd_penyakit` varchar(4) NOT NULL,
  `kd_gejala` varchar(4) NOT NULL,
  `nilaiPH` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_analisa`
--

INSERT INTO `tmp_analisa` (`kd_proses`, `kd_penyakit`, `kd_gejala`, `nilaiPH`) VALUES
('Proses2', 'P001', 'G032', 0.12),
('Proses2', 'P002', 'G032', 0),
('Proses2', 'P003', 'G032', 0.22),
('Proses2', 'P004', 'G032', 0),
('Proses2', 'P005', 'G032', 0),
('Proses2', 'P006', 'G032', 0),
('Proses2', 'P007', 'G032', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_gejala`
--

CREATE TABLE `tmp_gejala` (
  `noip` int(3) NOT NULL,
  `kd_gejala` char(4) NOT NULL,
  `bobot` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_gejala`
--

INSERT INTO `tmp_gejala` (`noip`, `kd_gejala`, `bobot`) VALUES
(130965, 'G031', 0),
(130966, 'G032', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_penyakit`
--

CREATE TABLE `tmp_penyakit` (
  `kd_penyakit` varchar(4) NOT NULL,
  `kd_gejala` varchar(4) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_penyakit`
--

INSERT INTO `tmp_penyakit` (`kd_penyakit`, `kd_gejala`, `nilai`) VALUES
('P001', 'G031', 0.22),
('P001', 'G032', 0.33999999999999997),
('P002', 'G031', 0.22),
('P002', 'G032', 0.33999999999999997),
('P003', 'G031', 0.22),
('P003', 'G032', 0.33999999999999997),
('P005', 'G031', 0.22),
('P005', 'G032', 0.33999999999999997);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_totalbayes`
--

CREATE TABLE `tmp_totalbayes` (
  `kd_penyakit` varchar(4) NOT NULL,
  `kd_gejala` varchar(4) NOT NULL,
  `totalbayes` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_totalbayes`
--

INSERT INTO `tmp_totalbayes` (`kd_penyakit`, `kd_gejala`, `totalbayes`) VALUES
('P001', 'G031', 0),
('P001', 'G032', 0.35294117647059),
('P002', 'G031', 0),
('P002', 'G032', 0),
('P003', 'G031', 1),
('P003', 'G032', 0.64705882352941),
('P005', 'G031', 0),
('P005', 'G032', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tbgejala`
--
ALTER TABLE `tbgejala`
  ADD PRIMARY KEY (`kd_gejala`);

--
-- Indexes for table `tbhasil`
--
ALTER TABLE `tbhasil`
  ADD PRIMARY KEY (`idhasil`);

--
-- Indexes for table `tbpasien`
--
ALTER TABLE `tbpasien`
  ADD PRIMARY KEY (`idpasien`);

--
-- Indexes for table `tbpenyakit`
--
ALTER TABLE `tbpenyakit`
  ADD PRIMARY KEY (`kd_penyakit`);

--
-- Indexes for table `tbrule`
--
ALTER TABLE `tbrule`
  ADD PRIMARY KEY (`id_rule`);

--
-- Indexes for table `tmp_gejala`
--
ALTER TABLE `tmp_gejala`
  ADD PRIMARY KEY (`noip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbhasil`
--
ALTER TABLE `tbhasil`
  MODIFY `idhasil` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbpasien`
--
ALTER TABLE `tbpasien`
  MODIFY `idpasien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbrule`
--
ALTER TABLE `tbrule`
  MODIFY `id_rule` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tmp_gejala`
--
ALTER TABLE `tmp_gejala`
  MODIFY `noip` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130967;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
