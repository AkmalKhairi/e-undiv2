-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2021 at 11:19 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date DEFAULT NULL,
  `status` varchar(25) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `password`, `firstname`, `lastname`, `photo`, `created_on`, `status`, `phone`) VALUES
(1, '1000', '$2y$10$OspU4uZBxhlIUnjJbaH0GOmmBcbdW0qC7KOETtdQYAcyUULCK1Ac.', 'admin', 'admin', 'hacker.png', '2021-05-24', 'Verified', '0192775020'),
(2, '5055', '$2y$10$rI1ZUMc/Sq4ONblsyrxf4.63QW483Jd6h.ou1Kjsmp71eJ504fMQ.', 'admin', 'test', 'hacker.png', '2021-05-28', 'Verified', '0192775020'),
(3, '980422145183', '$2y$10$7TajBeBVQYRgU1p6oTNb4eh5QPx98ClFQmQK5k43OSj45ANX0Fupu', 'muhammad afiq', 'kamaruzzaman', 'hacker.png', '2021-06-27', 'Not Verified', '0192775020'),
(4, '030306147189', '$2y$10$gnRSu4jmJQBDwQDuE6EHge5iYN5CbOiY9hkrA5nLfFT3lM8yCW3RC', 'muhammad arfan', 'rafi yussof', 'hacker.png', '2021-06-27', 'Not Verified', '0192775020'),
(5, '010701076657', '$2y$10$GloNaUD0htzbRix981KMBu/8gt.q9GzoVLT6HW5KbpAjri7ET9eE6', 'muhammad adham', 'azizan', 'hacker.png', '2021-06-27', 'Not Verified', '0192775020'),
(6, '5533', '$2y$10$HMCKHYEMzwsqOjpmRTwJoObGZ3JQ6rkCj/5KTYAew0blWBZDS986e', 'muhammad azrif', 'yunus', 'hacker.png', '2021-06-27', 'Verified', '0192775020');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `candidate_id` varchar(15) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `platform` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `candidate_id`, `firstname`, `lastname`, `photo`, `platform`, `status`) VALUES
(1, 1, '7775', 'AHMAD ADI IMAN', 'ZURAIDI', 'hacker.png', 'berusaha mendekati para pelajar dengan lebih mesra dan terbuka\r\n', 'Approve'),
(2, 1, '8871', 'WAN MUHAMMAD ISMAT', 'WAN AZMY', 'hacker.png', 'menjadi lidah pelajar dalam menyuarakan sebarang permasalahan\r\n', 'Approve'),
(3, 3, '6689', 'MUHAMMAD AKMAL', 'MOHD SABRI', 'hacker.png', 'aduan pelajar akan di tampal di papan kenyataan', 'Approve'),
(4, 3, '5431', 'ZULAZRI', 'ZULKARNAIN', 'hacker.png', 'berusaha mencadangkan wifi di kolej disediakan', 'Approve'),
(5, 4, '7543', 'IMRAN', 'ISMAIL', 'hacker.png', 'menjadi penyambung lidah mahasiswa dengan pihak pengurusan UTeM', 'Approve'),
(6, 2, '4411', 'ahmad syuhaimy', 'najib', 'hacker.png', 'To ensure that all student receive good study environment', 'Approve'),
(9, 2, '5031', 'MUHAMMAD AKMAL KHAIRI', 'ABDUL HALIM', 'hacker.png', 'memperjuangkan isu-isu berbangkit seperti masalah isu parking, mesin atm, wifi', 'Approve'),
(16, 4, '5031', 'MUHAMMAD AKMAL KHAIRI', 'ABDUL HALIM', 'hacker.png', 'testing manifesto ', 'Approve'),
(17, 5, '5031', 'MUHAMMAD AKMAL KHAIRI', 'ABDUL HALIM', 'hacker.png', 'testing ', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `created_by` int(5) NOT NULL,
  `description` varchar(50) NOT NULL,
  `max_vote` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `nominationdate` datetime NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `created_by`, `description`, `max_vote`, `priority`, `status`, `nominationdate`, `startdate`, `enddate`) VALUES
(1, 1000, 'AJK MPP UTeM', 1, 1, 'Ongoing', '2021-06-27 21:00:00', '2021-06-27 21:35:18', '2021-06-28 18:30:00'),
(2, 1000, 'BENDAHARI MPP UTeM', 1, 2, 'Ongoing', '2021-06-27 21:00:00', '2021-06-27 22:03:38', '2021-06-27 22:15:00'),
(3, 1000, 'SETIAUSAHA MPP UTeM', 1, 3, 'Pending', '2021-06-27 21:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1000, 'PENGERUSI MPP UTeM', 1, 4, 'Ongoing', '2021-06-30 10:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1000, 'TIMBALAN MPP UTeM', 1, 5, 'Pending', '2021-06-27 21:50:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'superadmin', '$2y$10$4oPXJAjKvCJ4/K2kgm24YOKiEUOg8Af2ZkrnV.To/rpsQsbfBtcYm', 'Super Admin', '', 'admin_1246350.png', '2018-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `voters_id` varchar(15) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `status` varchar(25) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `created_on` date NOT NULL,
  `logintime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `voters_id`, `password`, `firstname`, `lastname`, `photo`, `status`, `phone`, `created_on`, `logintime`) VALUES
(1, '5031', '$2y$10$Ct4iJ9t9wOv7//c1FMSJG.DxZvkJAElUHYMMQeArZMUOy6GPpnAb2', 'MUHAMMAD AKMAL KHAIRI', 'ABDUL HALIM', 'hacker.png', 'Verified', '0192775020', '2021-05-22', '11:54:44'),
(2, '716761771717', '$2y$10$4QCMKOyNC9.VZjlYiRRqkO5sw7muvSokF7Vy6a4gKQxkf2Y2Hl8lu', 'MUHAMMAD QUDUS', 'NASSIR', 'hacker.png', 'Not Verified', '0192775020', '2021-06-27', '00:00:00'),
(3, '861553771999', '$2y$10$j5o0ULZJbvG/5dJajy/2bORoAej8q2zjGLZl6StdASSVy3eJqrOpm', 'MUHAMMAD ZAFIR', 'BAREED', 'hacker.png', 'Not Verified', '0192775020', '2021-06-27', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voters_id`, `candidate_id`, `position_id`) VALUES
(2, 1, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voters_id` (`voters_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
