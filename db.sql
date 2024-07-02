-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2024 pada 20.59
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bukawarung`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_name`, `username`, `password`, `admin_telp`, `admin_email`, `admin_address`) VALUES
(1, 'Khabib', 'admin', 'admin', '+6282217604816', 'admin@gmail.com', 'Karangrejo, dekat masjid seribu kubah'),
(2, 'Khabib', 'khabib001', 'khabib123', '242342', 'khabib@gmail.com', 'adadaws');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`) VALUES
(4, 'Device Mod'),
(5, 'Liquid'),
(6, 'Device Pod'),
(7, 'Device AIO'),
(8, 'RDA'),
(9, 'Accessoriess'),
(10, 'Tools'),
(11, 'Coil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `order_name` varchar(255) DEFAULT NULL,
  `order_address` text DEFAULT NULL,
  `order_phone` varchar(20) DEFAULT NULL,
  `order_email` varchar(100) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `order_name`, `order_address`, `order_phone`, `order_email`, `order_date`) VALUES
(1, 'efendi', 'adwad', '121e12', 'admin@example.com', '2024-06-16 07:16:58'),
(2, 'efendi', 'adwad', '121e12', 'admin@example.com', '2024-06-16 07:17:39'),
(3, 'kontol gedi', 'karang rejo', '1231321', 'adaw@gmail.com', '2024-06-16 07:58:03'),
(4, 'kontol', 'karangrejo', '9012809318', 'kontol@gmail.com', '2024-06-17 12:59:12'),
(5, 'Rizal Efendi', 'fbdfbf', '9012809318', 'anggitprayogo@gmail.com', '2024-06-17 18:27:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(1, 1, 9, 1, 1500000.00, 1500000.00),
(2, 1, 3, 1, 300000.00, 300000.00),
(3, 1, 11, 1, 50000.00, 50000.00),
(4, 3, 11, 3, 50000.00, 150000.00),
(5, 4, 24, 2, 420000.00, 840000.00),
(6, 5, 3, 2, 300000.00, 600000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_status`, `data_created`) VALUES
(1, 4, 'Hexohm v3', 4000000, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n\r\n<p>spesifikasi :</p>\r\n\r\n<p>1. mantep<br />\r\n2. oke</p>\r\n', 'mod1.jpg', 1, '2020-05-19 01:52:15'),
(2, 5, 'Liquid', 90000, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n', 'liquid.jpg', 1, '2020-05-19 01:52:45'),
(3, 6, 'Pod', 300000, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n', 'pod.jpg', 1, '2020-05-19 01:53:02'),
(8, 7, 'AIO', 1000000, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n', 'barang1.jpg', 2, '2020-05-19 01:53:23'),
(9, 8, 'RDA APIK', 1500000, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n', 'rda.jpg', 1, '2020-05-19 01:53:46'),
(10, 9, 'Lanyard Pod', 30000, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n\r\n<p>tesssssssss</p>\r\n', 'lanyard.jpg', 1, '2020-05-19 01:54:16'),
(11, 10, 'Tang Potong', 50000, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>\r\n', 'tool.jpg', 1, '2020-05-19 01:54:46'),
(24, 8, 'NITROUS RDA DUAL CAP ONLY 22', 420000, '<p>NITROUS RDA DUAL CAP ONLY<br />\r\n<br />\r\nDual Coil<br />\r\nDiameter : 22mm<br />\r\nPost Deck : Postless<br />\r\nTop Cap with AFC lock<br />\r\n<br />\r\nPackage Contens :<br />\r\n1x Nitrous RDA<br />\r\n1x Replacement Driptip<br />\r\n1x Coil lead guide<br />\r\n1x Beauty Ring<br />\r\n1x Spare part bag<br />\r\n1x User manual</p>\r\n', 'produk1718527685.jpeg', 1, '2024-06-16 08:48:05'),
(25, 8, 'Artha RDA Gen 3', 350000, '<p>AUTHENTIC<br />\r\nARTHA RDA Gen 2<br />\r\nBy ADVKEN | Fatriio<br />\r\n<br />\r\nSpesification<br />\r\n- 24MM Diameter RDA<br />\r\n- 2.5MM Diameter Airflow Control Ring Suggested For Single Coil Build<br />\r\n- 3MM Diameter Airflow Control Ring Suggested For Dual Coil Build<br />\r\n- 24K Gold Plated Positive Post<br />\r\n- Diamond Pattern Top Cap<br />\r\n- Compatible With Bottom Feed Box Mod<br />\r\n.<br />\r\nIncludes :<br />\r\n- 1x Artha Gen 2 RDA<br />\r\n- 2x Airflow Control Ring<br />\r\n- 1x ADVKEN Accessories Bag<br />\r\n- 1x 810 Resin Drip Tip<br />\r\n&nbsp;</p>\r\n', 'produk1718527819.jpeg', 1, '2024-06-16 08:50:19'),
(27, 11, 'Nebula Coil', 20000, '<p>&bull;&nbsp;Rasa Cloud yang Intens dan Kaya&bull;&nbsp;Berbagai Pilihan Daya&bull;&nbsp;GT Mesh di Dalam&bull;&nbsp;Tersedia dalam Keramik dan Kapas Tradisional</p>\r\n', 'produk1718528970.jpeg', 1, '2024-06-16 09:09:30'),
(28, 7, 'MANTO AIO 80W KIT (Authentic)', 350000, '<p>Specifications :<br />\r\n🔷Size: 24.3* 45* 80mm<br />\r\n🔷Material: Aluminum Alloy<br />\r\n🔷Battery: single 18650 battery(not included)<br />\r\n🔷Output: max 80W<br />\r\n🔷Screen: 0.49 inch OLED display<br />\r\n🔷Firing speed: 0.001S<br />\r\n🔷Charging: 5V/1A<br />\r\n🔷Capacity: 3ml<br />\r\n🔷Resistance: 0.3ohm Mesh Coil &amp; 1.2ohm Regular Coil<br />\r\n🔷Aluminium alloy construction<br />\r\n🔷Powered by single 18650 battery with max 80W output<br />\r\n🔷0.49 inch OLED screen<br />\r\n🔷Side filling system<br />\r\n🔷Two 510 drip tips for MTL/DTL vapers<br />\r\n🔷Recognize coils and automatically match power<br />\r\n&bull;<br />\r\nProduct Includes:<br />\r\n🔸1* MANTO AIO 80W KIT(DTL Drip Tip)<br />\r\n🔸1* Cartridge(Mesh 0.3&Omega; coil inside)<br />\r\n🔸1* Regular 1.2&Omega; coil<br />\r\n🔸1* Type-C Charging Cable<br />\r\n🔸1* Certificate Card<br />\r\n🔸1* Warranty Card<br />\r\n🔸1* User Manual<br />\r\n🔸1* MTL Drip Tip</p>\r\n', 'produk1718649049.jpg', 1, '2024-06-17 18:30:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `password`) VALUES
(1, 'r_efendii', 'ed6b202e937c3e83cfc9f9ea1aedbe0e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'r_efendii', '$2y$10$r7/eV1mOQj0lXYH6pFyIWOfMBpSHAxp1dVc2riU72YVhgrBzBMHXi', 'efendi@gmail.com', 'admin', '2024-06-16 07:44:58'),
(2, 'kabib', '$2y$10$iDNcmu0YgAqUN08DB5BHnuITS1koqo79DLcBUP5HKPjCUg2eKIIg6', 'kabib@gmail.com', 'user', '2024-06-16 07:46:18'),
(3, 'admin', '$2y$10$eqoDRZDvBD5qhPUdJfS9lOtb6TAnEeD4zg/I0V56xtcfwMI4wQUtS', 'admin@gmail.com', 'admin', '2024-06-16 08:51:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD CONSTRAINT `tb_order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tb_order` (`order_id`),
  ADD CONSTRAINT `tb_order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tb_product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
