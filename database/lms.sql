-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2021 at 07:29 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `accountType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `dateCreated`, `dateModified`, `accountType`) VALUES
(27, 'admin', 'admin', '2021-01-02 18:27:07', '2021-01-10 16:05:04', 'admin'),
(32, 'student', 'student', '2021-01-03 19:35:14', '2021-01-07 23:07:44', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `accountId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `address`, `gender`, `accountId`) VALUES
(14, 'Administrator', 'Lucap Alaminos Pangasinan', 'Male', 27),
(15, 'Myline C. Montemayor', 'Dulacac Alaminos Pangasinan', 'Female', 28),
(17, 'Admin1', 'Bolaney Alaminos City Pangasinan', 'Male', 36);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `author` varchar(40) NOT NULL,
  `publisherId` int(10) NOT NULL,
  `yearPublished` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `subject`, `author`, `publisherId`, `yearPublished`) VALUES
(7, 'sample', 'sample', 'sample', 1, 2019),
(8, 'Ethics in Information Technology, 6th Edition', 'Ethics', 'George Reynolds', 5, 2018),
(9, 'PHP', 'Programminng', 'Rasmus Lerdorf', 6, 2002),
(10, 'The Longest Ride', 'Novel', 'Nicholas Sparks', 7, 2013);

-- --------------------------------------------------------

--
-- Table structure for table `bookcount`
--

CREATE TABLE `bookcount` (
  `bookCountId` int(10) NOT NULL,
  `bookId` int(10) NOT NULL,
  `totalNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookcount`
--

INSERT INTO `bookcount` (`bookCountId`, `bookId`, `totalNumber`) VALUES
(3, 7, 10),
(4, 8, 5),
(5, 9, 10),
(6, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrowId` int(10) NOT NULL,
  `bookId` int(10) NOT NULL,
  `accountId` int(10) NOT NULL,
  `dateBorrowed` datetime NOT NULL,
  `dateReturned` datetime NOT NULL,
  `qty` int(10) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrowId`, `bookId`, `accountId`, `dateBorrowed`, `dateReturned`, `qty`, `status`) VALUES
(5, 7, 27, '2021-01-04 00:00:00', '2021-01-06 00:00:00', 1, 'Returned'),
(6, 8, 27, '2021-01-04 00:00:00', '2021-01-06 00:00:00', 1, 'Returned'),
(7, 7, 20, '2021-01-04 17:15:48', '2021-01-06 17:15:48', 1, 'Returned'),
(8, 7, 30, '2021-01-05 11:19:50', '2021-01-07 11:19:50', 1, 'Returned'),
(9, 8, 30, '2021-01-05 12:46:23', '2021-01-07 12:46:23', 1, 'Returned'),
(10, 7, 30, '2021-01-05 12:47:00', '2021-01-07 12:47:00', 1, 'Returned'),
(11, 8, 30, '2021-01-05 12:47:00', '2021-01-07 12:47:00', 1, 'Returned'),
(12, 7, 20, '2021-01-05 14:16:24', '2021-01-07 14:16:24', 1, 'Returned'),
(13, 7, 20, '2021-01-05 18:12:00', '2021-01-07 18:12:00', 1, 'Returned'),
(14, 8, 32, '2021-01-05 18:25:44', '2021-01-07 18:25:44', 1, 'Returned'),
(15, 7, 32, '2021-01-05 19:13:03', '2021-01-07 19:13:03', 1, 'Returned'),
(16, 8, 32, '2021-01-05 19:22:18', '2021-01-07 19:22:18', 1, 'Returned'),
(17, 8, 32, '2021-01-05 19:56:59', '2021-01-07 19:56:59', 1, 'Returned'),
(18, 8, 32, '2021-01-05 19:59:05', '2021-01-07 19:59:05', 1, 'Returned'),
(19, 8, 21, '2021-01-05 20:02:15', '2021-01-07 20:02:15', 1, 'Returned'),
(20, 7, 21, '2021-01-05 20:07:33', '2021-01-07 20:07:33', 1, 'Returned'),
(21, 7, 21, '2021-01-05 20:11:18', '2021-01-07 20:11:18', 1, 'Returned'),
(22, 8, 21, '2021-01-05 20:15:30', '2021-01-07 20:15:30', 1, 'Returned'),
(23, 8, 21, '2021-01-05 20:21:52', '2021-01-07 20:21:52', 1, 'Returned'),
(24, 8, 30, '2021-01-05 20:24:10', '2021-01-07 20:24:10', 1, 'Returned'),
(25, 8, 21, '2021-01-05 20:29:03', '2021-01-07 20:29:03', 1, 'Returned'),
(26, 8, 21, '2021-01-05 20:49:05', '2021-01-07 20:49:05', 1, 'Returned'),
(27, 7, 30, '2021-01-05 20:59:57', '2021-01-07 20:59:57', 1, 'Returned'),
(28, 8, 30, '2021-01-05 20:59:57', '2021-01-07 20:59:57', 1, 'Returned'),
(29, 7, 27, '2021-01-05 21:15:53', '2021-01-07 21:15:53', 1, 'Returned'),
(30, 8, 27, '2021-01-05 21:15:53', '2021-01-07 21:15:53', 1, 'Returned'),
(31, 8, 21, '2021-01-06 14:14:26', '2021-01-08 14:14:26', 1, 'Returned'),
(32, 8, 32, '2021-01-07 21:33:03', '2021-01-09 21:33:03', 1, 'Returned'),
(33, 7, 32, '2021-01-07 21:58:47', '2021-01-09 21:58:47', 1, 'Returned'),
(34, 8, 32, '2021-01-07 22:35:36', '2021-01-09 22:35:36', 1, 'Returned'),
(35, 7, 32, '2021-01-07 23:08:05', '2021-01-09 23:08:05', 1, 'Returned'),
(36, 8, 32, '2021-01-07 23:25:24', '2021-01-09 23:25:24', 1, 'Returned'),
(37, 7, 20, '2021-01-08 00:08:52', '2021-01-10 00:08:52', 1, 'Returned'),
(38, 8, 21, '2021-01-09 12:14:46', '2021-01-11 12:14:46', 1, 'Returned'),
(39, 7, 21, '2021-01-09 15:57:34', '2021-01-11 15:57:34', 1, 'Returned'),
(40, 8, 21, '2021-01-09 15:57:49', '2021-01-11 15:57:49', 1, 'Returned'),
(41, 7, 27, '2021-01-10 16:52:59', '2021-01-12 16:52:59', 1, 'Returned'),
(42, 7, 27, '2021-01-10 17:01:04', '2021-01-12 17:01:04', 1, 'Returned'),
(43, 8, 27, '2021-01-11 20:43:08', '2021-01-13 20:43:08', 1, 'Returned'),
(44, 7, 27, '2021-01-12 10:54:36', '2021-01-14 10:54:36', 1, 'Returned'),
(45, 8, 27, '2021-01-12 10:54:36', '2021-01-14 10:54:36', 1, 'Returned'),
(46, 8, 21, '2021-01-14 12:59:58', '2021-01-14 17:18:45', 1, 'Returned'),
(47, 8, 27, '2021-01-14 17:23:49', '2021-01-16 08:18:58', 1, 'Returned'),
(48, 10, 36, '2021-01-15 12:32:46', '2021-01-16 08:19:05', 1, 'Returned'),
(49, 10, 20, '2021-01-15 12:36:21', '2021-01-16 08:19:10', 1, 'Returned'),
(50, 7, 20, '2021-01-15 12:37:35', '2021-01-15 12:38:06', 1, 'Returned'),
(51, 8, 20, '2021-01-15 12:37:35', '2021-01-15 12:38:07', 1, 'Returned'),
(52, 9, 20, '2021-01-15 12:37:35', '0000-00-00 00:00:00', 1, 'Borrowed'),
(53, 9, 21, '2021-01-16 08:15:38', '0000-00-00 00:00:00', 1, 'Borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisherId` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisherId`, `name`) VALUES
(1, 'Prentice Hall'),
(3, 'myline'),
(4, 'ejhay'),
(5, 'Cengage Learning US'),
(6, 'O\'Reilly Media, Inc.'),
(7, 'Grand Central Publishing');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `course` varchar(20) NOT NULL,
  `yearSection` varchar(10) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `accountId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `course`, `yearSection`, `gender`, `accountId`) VALUES
(2, 'E-Jhay V. Bumacod', 'BSIT', 'III-A', 'Male', 20),
(3, 'Myline C. Montemayor', 'BSIT', 'III-A', 'Male', 21),
(5, 'Louisa O. Cuenza', 'BSIT', 'III-A', 'Female', 30),
(6, 'Gerrence Brylle Bacayo', 'BSIT', 'III-A', 'Male', 32),
(7, 'Jan Alden Sevillena', 'BSIT', 'III-A', 'Male', 33),
(8, 'Ma Joshua Caras', 'BSHM', 'IV-A', 'Female', 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountId` (`accountId`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publisherId` (`publisherId`);

--
-- Indexes for table `bookcount`
--
ALTER TABLE `bookcount`
  ADD PRIMARY KEY (`bookCountId`),
  ADD KEY `test` (`bookId`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrowId`),
  ADD KEY `bookId` (`bookId`),
  ADD KEY `borrow_ibfk_2` (`accountId`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisherId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountId` (`accountId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookcount`
--
ALTER TABLE `bookcount`
  MODIFY `bookCountId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrowId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisherId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`publisherId`) REFERENCES `publisher` (`publisherId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookcount`
--
ALTER TABLE `bookcount`
  ADD CONSTRAINT `test` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
