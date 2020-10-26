-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2020 at 03:03 PM
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
-- Table structure for table `checkoutDetails_randa`
--

CREATE TABLE IF NOT EXISTS `checkoutDetails_randa` (
  `checkout_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `checkoutDetails_date` varchar(10) NOT NULL,
  KEY `checkout_id` (`checkout_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkoutDetails_randa`
--
ALTER TABLE `checkoutDetails_randa`
  ADD CONSTRAINT `checkoutDetails_randa_ibfk_1` FOREIGN KEY (`checkout_id`) REFERENCES `checkout_randa` (`checkout_id`),
  ADD CONSTRAINT `checkoutDetails_randa_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_randa` (`user_id`),
  ADD CONSTRAINT `checkoutDetails_randa_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product_randa` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
