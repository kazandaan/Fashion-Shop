-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2020 at 10:29 PM
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
-- Table structure for table `user_randa`
--

CREATE TABLE IF NOT EXISTS `user_randa` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_phone` varchar(11) DEFAULT NULL,
  `user_birthday` varchar(10) DEFAULT NULL,
  `user_address` varchar(100) DEFAULT NULL,
  `user_cardno` varchar(50) DEFAULT NULL,
  `user_cardname` varchar(50) DEFAULT NULL,
  `user_card` enum('Visa','MasterCard') DEFAULT NULL,
  `user_img` varchar(100) DEFAULT 'user/default.jpg',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_randa`
--

INSERT INTO `user_randa` (`user_id`, `user_name`, `user_username`, `user_email`, `user_password`, `user_phone`, `user_birthday`, `user_address`, `user_cardno`, `user_cardname`, `user_card`, `user_img`) VALUES
(1, 'khalisya', 'khal2', 'kha@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', '', 'user/girl.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
