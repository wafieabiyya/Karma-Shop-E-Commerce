-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.25-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk karma
CREATE DATABASE IF NOT EXISTS `karma` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `karma`;

-- membuang struktur untuk table karma.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) unsigned NOT NULL,
  `admin_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `admin_address` varchar(255) NOT NULL,
  `admin_email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `admin_phone` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `admin_password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `admin_photo` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel karma.admins: 1 rows
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_address`, `admin_email`, `admin_phone`, `admin_password`, `admin_photo`) VALUES
	(1, 'Uzumaki Boruto', '', 'uzumaki.boruto@gmail.com', '08819201', 'uzumaki', 'boruto.jpeg');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- membuang struktur untuk table karma.blogs
CREATE TABLE IF NOT EXISTS `blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `blog_description` text CHARACTER SET utf8 DEFAULT NULL,
  `blog_quotes` text CHARACTER SET utf8 DEFAULT NULL,
  `blog_quotes_writer` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `blog_image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `blog_image2` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `blog_tags` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `blog_date` date DEFAULT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel karma.blogs: 0 rows
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;

-- membuang struktur untuk table karma.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_cost` decimal(10,2) NOT NULL,
  `order_status` varchar(100) CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(15) CHARACTER SET latin1 NOT NULL,
  `user_city` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel karma.orders: 21 rows
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
	(29, 30.00, 'Paid', 5, '08819212400', 'Bandung', 'Surabaya', '2023-06-03 02:14:38'),
	(30, 100.00, 'Paid', 5, '08819291', 'Bandung, Indonesia', 'cikadut', '2023-06-03 02:29:21'),
	(28, 40.00, 'delivered', 5, '08819291', 'Bandung, Indonesia', 'Cikadut, Mega Regency', '2023-06-03 02:08:34'),
	(27, 195.00, 'delivered', 5, '08819291', 'Bandung, Indonesia', 'Cikadut, Mega Regency', '2023-06-03 01:37:27'),
	(25, 30.00, 'shipped', 1, '08819291', 'Bandung', 'Surabaya', '2023-06-03 02:56:27'),
	(24, 60.00, 'delivered', 1, '08012', 'Bandung', 'Antapani', '2023-06-02 10:06:26'),
	(26, 95.00, 'delivered', 3, '08819291', 'Jawa Barat', 'Sukabumi', '2023-06-03 05:05:35'),
	(31, 30.00, 'Paid', 5, '08819291', 'Bandung, Indonesia', 'Cikadut, Mega Regency', '2023-06-03 02:53:35'),
	(51, 40.00, 'Paid', 3, '08819212400', 'Bandung, Indonesia', 'Karang indah', '2023-06-04 03:48:02'),
	(35, 40.00, 'Paid', 3, '08819291', 'Bandung', 'cikadut', '2023-06-03 03:35:09'),
	(52, 250.00, 'Paid', 1, '', '', '', '2023-06-04 04:09:38'),
	(41, 30.00, 'Paid', 1, '', '', '', '2023-06-04 03:20:26'),
	(58, 10.00, 'Paid', 1, '0881921', 'Banudng', 'Komplek Mega Regency, Cikadut', '2023-06-11 11:42:56'),
	(57, 110.00, 'Paid', 5, '081929012', 'Bandung', 'Komplek Mega Regency, Cikadut', '2023-06-07 04:15:01'),
	(56, 585.00, 'Paid', 1, '0881', 'Banudng', 'CIkadut', '2023-06-06 05:25:57'),
	(55, 195.00, 'Paid', 1, '0881', 'Banudng', 'CIkadut', '2023-06-06 10:42:52'),
	(54, 605.00, 'Paid', 1, '0881', 'Banudng', 'CIkadut', '2023-06-06 09:55:50'),
	(53, 250.00, 'Paid', 3, '08819291', 'Bandung, Indonesia', 'Cikadut, Mega Regency', '2023-06-04 04:15:10'),
	(50, 100.00, 'Paid', 5, '08819212400', 'Bandung, Indonesia', 'Cikadut, Mega Regency', '2023-06-04 03:32:06'),
	(59, 100.00, 'delivered', 1, '07818221', 'Bandung', 'Komplek Mega Regency, Cikadut', '2023-06-11 11:56:50'),
	(60, 100.00, 'Paid', 1, '07818221', 'Banudng', 'CIkadut', '2023-06-11 12:06:34');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- membuang struktur untuk table karma.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `product_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `product_image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel karma.order_items: 11 rows
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
	(2, 25, 3, 'Ventela Slip On', 'p3.jpg', 30.00, 1, 1, '2023-06-03 02:56:27'),
	(3, 24, 3, 'Ventela Slip On', 'p3.jpg', 60.00, 2, 1, '2023-06-02 10:06:26'),
	(4, 41, 3, 'Ventela Slip On', 'p3.jpg', 30.00, 1, 1, '2023-06-04 03:20:26'),
	(5, 42, 2, 'Nike Green Lentern', 'p2.jpg', 95.00, 1, 5, '2023-06-04 03:26:00'),
	(13, 53, 8, 'Nike Phantom Venom', 'Nike_Phantom_Venom1.jpg', 250.00, 1, 3, '2023-06-04 04:15:10'),
	(12, 51, 1, 'Adidas Ultra-Boost', 'p1.jpg', 40.00, 1, 3, '2023-06-04 03:48:02'),
	(11, 50, 7, 'New Balance 550', 'New_Balance_5501.jpg', 100.00, 1, 5, '2023-06-04 03:32:06'),
	(10, 49, 2, 'Nike Green Lentern', 'p2.jpg', 95.00, 1, 5, '2023-06-04 03:29:41'),
	(14, 54, 7, 'New Balance 550', 'New_Balance_5501.jpg', 100.00, 5, 1, '2023-06-06 09:55:51'),
	(15, 57, 7, 'New Balance 550', 'New_Balance_5501.jpg', 100.00, 1, 5, '2023-06-07 04:15:01'),
	(16, 60, 7, 'New Balance 550', 'New_Balance_5501.jpg', 100.00, 1, 1, '2023-06-11 12:06:34');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

-- membuang struktur untuk table karma.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) CHARACTER SET latin1 NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel karma.payments: 24 rows
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`, `payment_date`) VALUES
	(1, 24, 1, '', NULL),
	(4, 26, 3, '90R91141TB319443G', '2023-06-03 05:07:35'),
	(3, 25, 1, '1DE54228AP893364M', '2023-06-03 03:12:23'),
	(5, 27, 5, '7NU03033A9883083R', '2023-06-03 13:38:40'),
	(6, 28, 5, '20E88868PP4431144', '2023-06-03 14:09:03'),
	(7, 29, 5, '4F225703WE240053P', '2023-06-03 14:14:54'),
	(8, 30, 5, '7EL631135V258440W', '2023-06-03 14:30:37'),
	(9, 31, 5, '6EG179729H874611L', '2023-06-03 14:54:28'),
	(10, 35, 3, '4N745426R6290704H', '2023-06-04 02:47:34'),
	(11, 41, 1, '5LA43732Y9327500C', '2023-06-04 03:23:15'),
	(12, 50, 5, '06P3059432920560P', '2023-06-04 03:32:35'),
	(13, 50, 5, '5KT2284495510134F', '2023-06-04 03:35:18'),
	(14, 51, 3, '25C28605MK711903G', '2023-06-04 03:48:29'),
	(15, 52, 1, '02396616NF657371L', '2023-06-04 16:10:16'),
	(16, 53, 3, '65E79086WB636470Y', '2023-06-04 16:15:35'),
	(17, 54, 1, '1PS00430H0287131H', '2023-06-06 10:10:43'),
	(18, 55, 1, '5Y4414962M5738000', '2023-06-06 10:44:46'),
	(19, 56, 1, '5XN98268RH055600S', '2023-06-06 17:26:39'),
	(20, 57, 5, '8G839706S7881904W', '2023-06-07 16:15:49'),
	(21, 57, 5, '7A0425694G658344Y', '2023-06-07 17:03:38'),
	(22, 57, 5, '69Y03208299305319', '2023-06-07 17:04:13'),
	(23, 58, 1, '6P415154WG478194M', '2023-06-11 11:49:29'),
	(24, 59, 1, '8UF45521K6156392X', '2023-06-11 11:57:29'),
	(25, 60, 1, '5TY507936F6151006', '2023-06-11 12:06:55');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;

-- membuang struktur untuk table karma.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) DEFAULT NULL,
  `product_brand` varchar(100) DEFAULT NULL,
  `product_category` varchar(100) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `product_criteria` varchar(50) DEFAULT NULL,
  `product_image1` varchar(100) DEFAULT NULL,
  `product_image2` varchar(100) DEFAULT NULL,
  `product_image3` varchar(100) DEFAULT NULL,
  `product_image4` varchar(100) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `special_offer` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel karma.products: 8 rows
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`product_id`, `product_name`, `product_brand`, `product_category`, `product_description`, `product_criteria`, `product_image1`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `special_offer`) VALUES
	(12, 'Ventela Slip On', 'Ventela', 'casual', 'Ventela slip on yang nyaman dan mudah untuk digunakan siapa saja dan di mana saja', 'Coming Soon', 'Ventela_Slip_On1.jpg', 'Ventela_Slip_On2.jpg', 'Ventela_Slip_On3.jpg', 'Ventela_Slip_On4.jpg', 40.00, 15.00),
	(7, 'New Balance 550', 'New Balance', 'sport', 'New Balance yang sangat bagus untuk digunakan dalam bermain maupun pada saat berolahraga, indoor maupun outdoor, semua nya dilibas \r\n', 'Latest Product', 'New_Balance_5501.jpg', 'New_Balance_5502.jpg', 'New_Balance_5503.jpg', 'New_Balance_5504.jpg', 120.00, 100.00),
	(10, 'Adidas Red Dragon ', 'Adidas', 'Sport', 'Adidas Red Dragon, kulit naga berkualitas tinggi dan berkualitas super duper manjur, uhuyy\r\n', 'Latest Product', 'aa1.jpg', 'aa2.jpg', 'aa3.jpg', 'aa4.jpg', 12.00, 10.00),
	(13, 'Adidas Ultra Boost', 'Adidas', 'Unisex', 'Adias ultra boost yang bakalan bikin kamu ngeboost', 'Latest Product', 'Adidas_Ultra_Boost1.jpg', 'Adidas_Ultra_Boost2.jpg', 'Adidas_Ultra_Boost3.jpg', 'Adidas_Ultra_Boost4.jpg', 70.00, 68.00),
	(11, 'Nike Green Lantern ', 'Nike', 'sport', 'Nike Green Lantern merupakan sebuah sepatu sporty trendy yang diproduksi oleh Nike, sepatu ini dapat membuat para pengguna nya merasa seprti tidak mengenakan sepatu yang disebabkan sepatu ini memiliki bobo yang sangat ringan', 'Latest Product', 'Nike_Green_Lantern_1.jpg', 'Nike_Green_Lantern_2.jpg', 'Nike_Green_Lantern_3.jpg', 'Nike_Green_Lantern_4.jpg', 80.00, 40.00),
	(14, 'Nike Pinky', 'Nike', 'Sport', 'For women that loves running', 'Coming Soon', 'Nike_Pinky1.jpg', 'Nike_Pinky2.jpg', 'Nike_Pinky3.jpg', 'Nike_Pinky4.jpg', 120.00, 90.00),
	(16, 'Nike Pinky V.02', 'Nike', 'casual', 'Upgrade from the latest product', 'Coming Soon', 'Nike_Pinky_V.021.jpg', 'Nike_Pinky_V.022.jpg', 'Nike_Pinky_V.023.jpg', 'Nike_Pinky_V.024.jpg', 100.00, 89.00),
	(18, 'Nike Air Pinky', 'Nike', 'sport', 'Nike Pinky untuk semua gender', 'Coming Soon', 'Nike_Air_Pinky1.jpg', 'Nike_Air_Pinky2.jpg', 'Nike_Air_Pinky3.jpg', 'Nike_Air_Pinky4.jpg', 80.00, 50.00);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- membuang struktur untuk table karma.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `user_email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `user_password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `user_phone` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `user_address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `user_city` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `user_photo` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel karma.users: 4 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_address`, `user_city`, `user_photo`) VALUES
	(1, 'elabiyya', 'el@gmail.com', '123', '088190912', 'Cikadut', 'Bandung', NULL),
	(2, 'raihan', 'rai@gmail.com', '15a4f79a36539b337bd20fd30d336336', '08819291', 'Antapani', 'Bandung', NULL),
	(3, 'jella', 'naj@gmail.com', 'najila123', '08819291', 'TMP Pahlawan', 'Bandung, Indonesia', NULL),
	(5, 'Wafie', 'waf@gmail.com', 'waf12345', '08819212400', 'Cikadut, Mega Regency', 'Bandung, Indonesia', 'about_wafie.jpeg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
