-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tintuc
CREATE DATABASE IF NOT EXISTS `tintuc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tintuc`;

-- Dumping structure for table tintuc.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tintuc.categories: ~10 rows (approximately)
REPLACE INTO `categories` (`id`, `name`) VALUES
	(1, 'Trang chủ'),
	(2, 'Thể thao'),
	(3, 'Giải trí'),
	(4, 'Khoa học'),
	(5, 'Thế giới'),
	(6, 'Kinh doanh'),
	(7, 'Bất động sản'),
	(8, 'Giáo dục'),
	(9, 'Pháp luật'),
	(10, 'Đời sống');

-- Dumping structure for table tintuc.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tintuc.news: ~10 rows (approximately)
REPLACE INTO `news` (`id`, `title`, `content`, `image`, `created_at`, `category_id`) VALUES
	(1, 'Ms', '19w2tGrDLgT6CiAcSa8BU6qE9Hk9E2SRgb', '1', '2024-06-20 00:00:00', 8),
	(2, 'Rev', '1Hu9nuEiACvJ3yMrsRPuZJy4bkPcr6qd1v', '2', '2024-01-14 00:00:00', 7),
	(3, 'Mr', '1EaPC6LGLgBNCwxUZEpnzGY66WdNTTFVQv', '3', '2024-10-20 00:00:00', 3),
	(4, 'Rev', '1Q3bYAwdy7ZapXLzFgE28VgABN14rRADa2', '4', '2024-12-02 00:00:00', 2),
	(5, 'Ms', '1BAqTAf7DcmS97t6ibvgbDzRXjuUwYTjLs', '5', '2024-09-28 00:00:00', 4),
	(6, 'Dr', '16euaH7TSnodhzTsw3NK6F3FfpZi7zQ4Dc', '6', '2024-05-04 00:00:00', 5),
	(7, 'Mr', '1Fojoofc1BLjGjpb9q9EbKiU91cPtEYhLb', '7', '2024-05-08 00:00:00', 6),
	(8, 'Honorable', '1NVU8vy9rjL2ZUqfCFLzNyw3ycnCvRuoep', '8', '2024-03-04 00:00:00', 1),
	(9, 'Dr', '1L4djyx6oJ3gpoP9vjfembBRZEU6LSzEd8', '9', '2024-11-20 00:00:00', 9),
	(10, 'Mrs', '13gdLdEuEuVD4eKJfi9KDauR1Kc5iAUDXZ', '10', '2023-12-31 00:00:00', 10);

-- Dumping structure for table tintuc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `users_chk_1` CHECK ((`role` in (0,1)))
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table tintuc.users: ~2 rows (approximately)
REPLACE INTO `users` (`id`, `username`, `password`, `role`) VALUES
	(1, 'dlucey0', 'wB4~8_%&', 1),
	(2, 'mcornejo1', 'sJ2$VIMl|m{Zzasa', 0),
	(3, 'ffurphy2', 'dQ3)>TEOa', 1),
	(4, 'tbassilashvili3', 'kE0>%&pXu9zj"', 0),
	(5, 'mdawidowsky4', 'jG6|9hj$', 0),
	(6, 'cbaldick5', 'sP0=MN~h?#>+hb2', 0),
	(7, 'blegen6', 'nV6(lic*Rd>q@P', 1),
	(8, 'bverdey7', 'mA1q=,D', 1),
	(9, 'esagrott8', 'nG4_YfK9?p', 0),
	(10, 'biban9', 'jF9<G6!\'3B?Yu', 0),
	(11, 'kkimbrougha', 'wA1$1Mnm1P.ia,d', 0),
	(12, 'mharmestonb', 'nJ1+4~Z~sI', 0),
	(13, 'blemeryc', 'mD6_n%#?s"paQ', 1),
	(14, 'civantyevd', 'vU6\'o!?EO_', 1),
	(15, 'rhilande', 'gZ5~,oyuiV}ht5', 1),
	(16, 'ltointonf', 'eN1!>A"cI<iwR', 0),
	(17, 'tfeaseyg', 'sI9#ZgI*&$Kc)+C{', 0),
	(18, 'fcarish', 'cT3<},<GEA', 1),
	(19, 'lyeendi', 'jT3/I?P7cz_', 0),
	(20, 'ksholemj', 'iG0(6zBXX{BHgh', 1),
	(21, 'jmatthewsonk', 'mC0$kevx~U', 1),
	(22, 'pheaml', 'hR4(xdJ|', 0),
	(23, 'asecrettm', 'yV7!hB{ea', 1),
	(24, 'aboltwoodn', 'yJ0(b>m<f$yqT@$U', 0),
	(25, 'ksmitheramo', 'jU1@QOR9(bnU8K', 1),
	(26, 'dbastonp', 'oH2{\'uyO*c', 1),
	(27, 'nfickq', 'pQ1{!2(\\%', 0),
	(28, 'epieterr', 'bP3!7GLr>$`"@', 0),
	(29, 'cwynrehames', 'wG1\'zyR}', 1),
	(30, 'ypomeroyt', 'iI2#d.e<=qb', 1),
	(31, 'kdampu', 'uA0,BPb_U!MMI', 1),
	(32, 'ofarfolomeevv', 'zX1}0p!B`|1>SRc', 0),
	(33, 'rculleyw', 'jI8,gWyx19PNIXcB', 0),
	(34, 'cbouldonx', 'oD9=Bs*@@P', 0),
	(35, 'lcheverelly', 'cV5*9o,IkgxYOZ', 0),
	(36, 'mfortesquieuz', 'kA5*5N3vgg~', 0),
	(37, 'cshalders10', 'pJ6+G$"c+}', 0),
	(38, 'dmorhall11', 'aA1/bV@&=KxvWV', 1),
	(39, 'tglasson15', 'lA6!kE{hD1_*', 0),
	(40, 'bkytley16', 'qE2\\_{jI0?', 0),
	(41, 'pbox17', 'dK2//(eQ', 1),
	(42, 'gcrewther18', 'xQ1*E"e~1zq|', 1),
	(43, 'pguess19', 'yF0"28*S$"o3N', 0),
	(44, 'fbathurst1a', 'aN5/oG.Gb', 0),
	(45, 'svanhove1b', 'kF0\'GZVhse_k~40', 1),
	(46, 'llemarquand1c', 'kD3@0b1P{', 0),
	(47, 'hrallings1d', 'oN5/p6)&W1x`m%j/', 1),
	(48, 'ksayse0', 'yI5/`VLZ', 0),
	(49, 'amanuelli1', 'xQ2@}x#u}aJc}4,3', 1),
	(50, 'hwalhedd2', 'eQ2MX,KL/wx5', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
