-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2024 at 01:19 PM
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
-- Database: `bursary`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `opening_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `file` varchar(100) DEFAULT NULL,
  `amount` float DEFAULT 0,
  `status` int(1) NOT NULL COMMENT '0-Not Approved 1- Approved 2-Awarded 3-Disbursed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `opening_id`, `date`, `file`, `amount`, `status`) VALUES
(23, 28, 12, '2024-04-10 11:06:22', NULL, 8000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `background`
--

CREATE TABLE `background` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `ward` varchar(50) NOT NULL,
  `division` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `sub_location` varchar(50) NOT NULL,
  `village` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `background`
--

INSERT INTO `background` (`id`, `user_id`, `ward`, `division`, `location`, `sub_location`, `village`) VALUES
(19, 28, 'Kabianga', 'Kabianga', 'Kiptome', 'Kapkitony', 'Cheptigit');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `institution` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `latestScore` varchar(20) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `user_id`, `institution`, `location`, `course`, `year`, `latestScore`) VALUES
(19, 28, 'Multimedia University', 'Kiptome', 'Software Engineering', '3', '66.56');

-- --------------------------------------------------------

--
-- Table structure for table `need_level`
--

CREATE TABLE `need_level` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `parents` int(1) NOT NULL COMMENT '0-Both 1-Single 2-None',
  `disability` int(1) NOT NULL COMMENT '0-None 1-Present'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `need_level`
--

INSERT INTO `need_level` (`id`, `user_id`, `parents`, `disability`) VALUES
(19, 28, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `openings`
--

CREATE TABLE `openings` (
  `id` int(10) NOT NULL,
  `batch_no` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(1) NOT NULL COMMENT '0-Closed 1- Open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `openings`
--

INSERT INTO `openings` (`id`, `batch_no`, `description`, `start_date`, `end_date`, `status`) VALUES
(12, 'BNGCDF202040508', 'BELGUT NGCDF 2024 ', '2024-05-01', '2024-06-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `signatories`
--

CREATE TABLE `signatories` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `chief` int(1) NOT NULL COMMENT '0-Pending 1-Signed',
  `religious` int(1) NOT NULL COMMENT '0-Pending 1-Signed',
  `school` int(1) NOT NULL COMMENT '0-Pending 1-Signed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signatories`
--

INSERT INTO `signatories` (`id`, `user_id`, `chief`, `religious`, `school`) VALUES
(19, 28, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_level` int(1) NOT NULL COMMENT '0-Applicant 1- Admin',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `access_level`, `created_on`) VALUES
(25, 'Admin', 'admin@gmail.com', '0704327535', '$2y$10$M2QY8t90ThErasgG81MwbO7Uxp.bUFI/otbODd8h1DbMJh5MYJrz2', 1, '2021-03-19 20:42:09'),
(28, 'Ngeno Victor', 'ngeno@gmail.com', '0707142565', '$2y$10$2EiRYCmgWo/WkPD1RqDIjucVJPoNVeeR28RddOWmHPTYGBwIsFWm2', 0, '2024-04-10 10:29:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `background`
--
ALTER TABLE `background`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `need_level`
--
ALTER TABLE `need_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `openings`
--
ALTER TABLE `openings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatories`
--
ALTER TABLE `signatories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `1` (`email`),
  ADD UNIQUE KEY `2` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `background`
--
ALTER TABLE `background`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `need_level`
--
ALTER TABLE `need_level`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `openings`
--
ALTER TABLE `openings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `signatories`
--
ALTER TABLE `signatories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
