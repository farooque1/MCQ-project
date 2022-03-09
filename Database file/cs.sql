-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2021 at 08:38 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `n_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `q_id` int(11) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`) VALUES
(1, 'Math'),
(2, 'Science'),
(3, 'English'),
(4, 'Language');

-- --------------------------------------------------------

--
-- Table structure for table `subject_question`
--

CREATE TABLE `subject_question` (
  `q_id` int(11) NOT NULL,
  `subject_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_question`
--

INSERT INTO `subject_question` (`q_id`, `subject_id`, `name`) VALUES
(1, 1, 'Measurement and Geometry'),
(2, 1, 'Statistics'),
(3, 1, 'Number and Algebra'),
(4, 1, 'Area and Volume'),
(5, 1, 'Fractions and Decimals'),
(6, 1, 'Percentage and Ratio'),
(7, 1, 'Rate and Speed'),
(8, 1, 'Past Papers'),
(9, 2, 'Energy'),
(10, 2, 'Diversity'),
(11, 2, 'Cycles'),
(12, 2, 'Systems'),
(13, 2, 'Interactions'),
(14, 2, 'Past Papers'),
(18, 9, 'marathi q1'),
(19, 9, 'question2'),
(20, 10, 'q1'),
(21, 10, 'q2'),
(22, 10, 'q3'),
(23, 11, 'm q1'),
(24, 11, 'm q2'),
(25, 11, 'm q3'),
(26, 11, 'm q4'),
(27, 12, 'test q1');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_question`
--
ALTER TABLE `subject_question`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subject_question`
--
ALTER TABLE `subject_question`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
