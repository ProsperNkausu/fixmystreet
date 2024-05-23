-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 11:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fixmystreet`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `report_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 16, 14, 'ASDAS', '2024-05-18 20:55:41'),
(2, 16, 15, 'OK', '2024-05-18 20:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(15) NOT NULL,
  `P_idd` int(15) NOT NULL,
  `district_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `problem_category`
--

CREATE TABLE `problem_category` (
  `Pro_id` int(15) NOT NULL,
  `Problem_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `P_id` int(15) NOT NULL,
  `Province_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_problem`
--

CREATE TABLE `report_problem` (
  `user_id` int(15) NOT NULL,
  `Rp_id` int(15) NOT NULL,
  `pro_idd` int(15) NOT NULL,
  `problem_discription` text NOT NULL,
  `image_1` varchar(250) NOT NULL,
  `image_2` varchar(250) NOT NULL,
  `image_3` varchar(250) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_problem`
--

INSERT INTO `report_problem` (`user_id`, `Rp_id`, `pro_idd`, `problem_discription`, `image_1`, `image_2`, `image_3`, `status`, `date`) VALUES
(14, 16, 0, 'welcome', '', '', '', '', '2024-05-18 16:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(15) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `Wardname` varchar(250) NOT NULL,
  `details_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `password`, `email`, `gender`, `nickname`, `Wardname`, `details_updated`) VALUES
(11, 'prosper', '827ccb0eea8a706c4c34a16891f84e7b', 'prospernkausu@gmail.com', 'Male', 'Hashira', 'chalala', 0),
(12, 'mary', '827ccb0eea8a706c4c34a16891f84e7b', 'mary@sample.com', 'Female', 'MN', 'chalala', 0),
(13, 'pac', '827ccb0eea8a706c4c34a16891f84e7b', 'pac@gmail.com', 'Male', 'pac', 'woodlands', 0),
(14, 'Hashira', 'e10adc3949ba59abbe56e057f20f883e', 'davidnkhoma78@gmail.com', 'Male', 'MN', 'chalala', 1),
(15, 'David Nkhoma', 'e10adc3949ba59abbe56e057f20f883e', 'prospernausu@gmail.com', 'Male', 'Hashira', 'chilstone', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `w_id` int(15) NOT NULL,
  `d_idd` int(15) NOT NULL,
  `ward_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `problem_category`
--
ALTER TABLE `problem_category`
  ADD PRIMARY KEY (`Pro_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`P_id`);

--
-- Indexes for table `report_problem`
--
ALTER TABLE `report_problem`
  ADD PRIMARY KEY (`Rp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `problem_category`
--
ALTER TABLE `problem_category`
  MODIFY `Pro_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `P_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_problem`
--
ALTER TABLE `report_problem`
  MODIFY `Rp_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
  MODIFY `w_id` int(15) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
