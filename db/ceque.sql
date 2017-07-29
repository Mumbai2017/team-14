-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2017 at 08:25 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ceque`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback_lp`
--

CREATE TABLE `feedback_lp` (
  `fb_id` bigint(100) NOT NULL,
  `sme_id` bigint(100) NOT NULL,
  `lp_id` bigint(100) NOT NULL,
  `feedback` text CHARACTER SET utf8 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_video`
--

CREATE TABLE `feedback_video` (
  `fb_id` bigint(100) NOT NULL,
  `sme_id` bigint(100) NOT NULL,
  `video_id` bigint(100) NOT NULL,
  `feedback` blob NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learning_program`
--

CREATE TABLE `learning_program` (
  `lp_id` bigint(100) NOT NULL,
  `teacher_id` bigint(100) NOT NULL,
  `lp_name` varchar(50) NOT NULL,
  `lp_subject` varchar(50) NOT NULL,
  `lp_grade` varchar(50) NOT NULL,
  `lp_language` varchar(50) NOT NULL,
  `lp_desc` text CHARACTER SET utf8 NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(100) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` int(15) NOT NULL,
  `user_city` varchar(50) NOT NULL,
  `user_password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` bigint(100) NOT NULL,
  `lp_id` bigint(100) NOT NULL,
  `video_link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `video_title` varchar(50) NOT NULL,
  `teacher_id` bigint(20) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback_lp`
--
ALTER TABLE `feedback_lp`
  ADD PRIMARY KEY (`fb_id`),
  ADD KEY `sme_id` (`sme_id`),
  ADD KEY `lp_id` (`lp_id`);

--
-- Indexes for table `feedback_video`
--
ALTER TABLE `feedback_video`
  ADD PRIMARY KEY (`fb_id`),
  ADD KEY `sme_id` (`sme_id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indexes for table `learning_program`
--
ALTER TABLE `learning_program`
  ADD PRIMARY KEY (`lp_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD KEY `role_id` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `lp_id` (`lp_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `lp_id_2` (`lp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback_lp`
--
ALTER TABLE `feedback_lp`
  MODIFY `fb_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback_video`
--
ALTER TABLE `feedback_video`
  MODIFY `fb_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `learning_program`
--
ALTER TABLE `learning_program`
  MODIFY `lp_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback_lp`
--
ALTER TABLE `feedback_lp`
  ADD CONSTRAINT `feedback_lp_ibfk_1` FOREIGN KEY (`sme_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_lp_ibfk_2` FOREIGN KEY (`lp_id`) REFERENCES `learning_program` (`lp_id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback_video`
--
ALTER TABLE `feedback_video`
  ADD CONSTRAINT `feedback_video_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `video` (`video_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_video_ibfk_2` FOREIGN KEY (`sme_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `learning_program`
--
ALTER TABLE `learning_program`
  ADD CONSTRAINT `learning_program_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`role_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`lp_id`) REFERENCES `learning_program` (`lp_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
