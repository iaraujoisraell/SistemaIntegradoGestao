-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2017 at 11:04 AM
-- Server version: 5.5.50
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_sortable`
--

-- --------------------------------------------------------

--
-- Table structure for table `sortable`
--

CREATE TABLE IF NOT EXISTS `sortable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sortable`
--

INSERT INTO `sortable` (`id`, `name`, `position`) VALUES
(1, 'Информационная заметка 1', 1),
(2, 'Информационная заметка 2', 0),
(3, 'Информационная заметка 3', 2),
(4, 'Информационная заметка 4', 3),
(5, 'Информационная заметка 5', 4),
(6, 'Информационная заметка 6', 5),
(7, 'Информационная заметка 7', 6),
(8, 'Информационная заметка 8', 7),
(9, 'Информационная заметка 9', 8),
(10, 'Информационная заметка 10', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sortable`
--
ALTER TABLE `sortable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sortable`
--
ALTER TABLE `sortable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
