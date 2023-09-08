-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 06:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leave_memo`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_info`
--

CREATE TABLE `leave_info` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `IDemp` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `type_leave` varchar(100) NOT NULL,
  `note_leave` varchar(100) NOT NULL,
  `leave_dt1` varchar(100) NOT NULL,
  `leave_dt2` varchar(100) NOT NULL,
  `status_leave` varchar(100) NOT NULL,
  `whenmdy` varchar(100) NOT NULL,
  `idleave` varchar(100) NOT NULL,
  `CT` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_info`
--

INSERT INTO `leave_info` (`id`, `name`, `IDemp`, `position`, `type_leave`, `note_leave`, `leave_dt1`, `leave_dt2`, `status_leave`, `whenmdy`, `idleave`, `CT`) VALUES
(1, 'Kanin', '00000', 'Manager IT', 'อื่นๆ', 'ทดสอบระบบ', '2023-09-19', '2023-09-21', 'ส่งถึง HR แล้ว', '8 กันยายน 2566', 'TPF7156', '2023-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `IDemp` varchar(100) NOT NULL,
  `mdyhbd` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `Class` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `IDemp`, `mdyhbd`, `position`, `Class`) VALUES
(1, 'Kanin', '00000', '271043', 'Manager IT', 'User'),
(2, 'kanomprang', '11111', '010143', 'HR ทั่วไป', 'HR'),
(3, 'Kawasaki ', '22222', '221242', 'HR Manager', 'Head of HR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_info`
--
ALTER TABLE `leave_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_info`
--
ALTER TABLE `leave_info`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
