-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2016 at 03:58 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bew`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(100) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`) VALUES
(4, 'Calculus'),
(5, ' Mathematics'),
(6, ' Scince'),
(7, 'Social Science'),
(8, 'English'),
(9, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `writter` varchar(40) NOT NULL,
  `rate` varchar(20) NOT NULL,
  `des` text NOT NULL,
  `category` varchar(200) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `book_name`, `writter`, `rate`, `des`, `category`, `u_name`, `date`, `image`) VALUES
(6, 'Social Science book to be sold', 'Social Science Basics', 'Syed Mahmud', '360', 'Good book to learn sociology', ' Scince,Social Science', 'we', '9 Nov, 2016', '175539.2.jpg'),
(8, 'Test Title ', 'Test Book', 'Test writer', '22000', 'Heyyy', ',Test', 'we', '13 Nov, 2016', 'bogg.JPG'),
(9, 'This is to sale', 'Biswajit er Prem Kahini', 'Biswajit', '50', 'Rosher Kotha', 'Social Science', 'we', '13 Nov, 2016', '174875.2.jpg'),
(10, 'English book to be sold', 'Textbook of English', 'MR. Bata', '950', 'Very good read', 'English', 'we', '13 Nov, 2016', '190191.2.jpg'),
(11, 'English Text Book to be Sold', 'Text de English', 'MD. Jalil', '1050', 'Excellent book for English', 'English', 'romeo', '13 Nov, 2016', '193269.3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `address`, `mobile`, `sex`, `email`, `username`, `password`, `bio`) VALUES
(2, 'Aamra', 'CSE KU, Gollamari', '+8802', 'male', 'cse@ku.com', 'we', '12345', 'CSE Discipline is one of the starting discipline in Khulna University. We are very proud to bring you this Book Exchange Website...'),
(3, 'S. M. Shakir Ahsan Romeo', 'Monirampur, Jessore', '+8801747604969', 'male', 'romeo.fbfan@gmail.com', 'romeo', '12345', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
