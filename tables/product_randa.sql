-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 25, 2020 at 02:43 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `f32ee`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_randa`
--

CREATE TABLE IF NOT EXISTS `product_randa` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `product_img` varchar(50) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_category` enum('women','men','kids') NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `product_randa`
--

INSERT INTO `product_randa` (`product_id`, `product_name`, `product_img`, `product_desc`, `product_price`, `product_type`, `product_brand`, `product_category`) VALUES
(1, 'Pleated Sleeveless Shirt Dress', 'women/1.jpg', 'Novel design with random, fluttering pleats! A shirt-style dress with a dressy look.\n65% Polyester, 35% Cottom', 39.9, 'one-piece', 'Uniqlo', 'women'),
(2, 'High Wait Belted Flare Midi Skirt', 'women/2.jpg', 'Casual skirt features an ultra-modern cut with a high-waisted, flared design. \n65% Polyester, 35% Cotton', 7.9, 'bottom', 'Uniqlo', 'women'),
(3, 'Roll Sleeve Button Front Blouse', 'women/3.jpg', 'Casual, pastel, dusty pink, plain, collared, regular, buttoned shirt.\r\n65% Cotton, 35% Polyester', 14, 'top', 'Shein', 'women'),
(4, 'Bow Tie Neck Curved Hem Glen Plaid Top', 'women/4.jpg', 'Preppy, khaki, plaid, tie necked, regular top.\r\n55% Cotton, 45% Polyester', 20, 'top', 'Shein', 'women'),
(5, 'Zilyae Trousers', 'women/5.jpg', 'Reveal Isabel Marant Etoile''s designers'' dedication to the essentials of a casual, yet vintage wardrobe, with their visible stitching. ', 360, 'bottom', '24S', 'women'),
(6, 'Slim-fit Business Shirt', 'men/1.jpg', 'Cotton poplin, light blue, slim fit.\r\n100% Cotton', 209, 'top', 'Hugo', 'men'),
(7, 'Crew Neck Short Sleeve T-Shirt', 'men/2.jpg', 'Incredible details, material and cut. The ultimate simple T-shirt.\r\n100% Cotton', 4.9, 'top', 'Uniqlo', 'men'),
(8, 'Ultra Stretch Dry Ex Pants', 'men/3.jpg', 'Great for sports or everyday casual wear! Quick-drying, stretchy easy-waist pants.\r\n100% Polyester', 5.9, 'bottom', 'Uniqlo', 'men'),
(9, 'Dry Stretch Easy Shorts', 'men/4.jpg', 'Dries sweat quickly, and lets you move. For casual or sporty styles.\r\n67% Cotton, 33% Polyester', 9.9, 'bottom', 'Uniqlo', 'men'),
(10, 'Black Jacket', 'men/5.jpg', 'Soft and lightweight material protects you from wind and weather.\r\n100% polyamide.', 89, 'outerwear', 'Nike', 'men'),
(11, 'Baby Lace Collar Romper Double Bowties', 'kids/1.jpg', 'Sweet lace and bowtie decoration, cap sleeves for warmer days.\r\nOuter layer 100% Polyester, Inner layer 100% Cotton', 18.9, 'one-piece', 'LittleKooma', 'kids'),
(12, 'Custom Name Hoodie', 'kids/2.jpg', 'High quality heavyweight custom kids name hoodies!\r\nCotton and Polyester', 35.23, 'outerwear', 'GagaKidz', 'kids'),
(13, 'Marl Blue Ribbed Harem Romper', 'kids/3.jpg', 'Mid weight stretchy romper. Can be worn on its own or layered up for cooler day.\r\nKam snaps, plastic snaps, jersey fabric, ribbed jersey', 18.55, 'one-piece', 'LenasYard', 'kids'),
(14, 'Mustard Dress', 'kids/4.jpg', 'Featuring a delicate floral pattern, it rocks a 70''s vibe. Long sleeved dress, ideal for winter. ', 45.22, 'one-piece', 'OakAndTheLittleFolk', 'kids'),
(15, 'Robot T-Shirt', 'kids/5.jpg', 'Organic cotton shirt for babies and kids. Unisex clothing for children.', 25.97, 'top', 'TubsTogs', 'kids');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
