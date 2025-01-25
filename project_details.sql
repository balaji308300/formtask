-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 06:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logo`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_details`
--

CREATE TABLE `project_details` (
  `id` int(11) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `tender_no` varchar(50) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `assigned_team` int(11) NOT NULL,
  `current_status` varchar(100) NOT NULL,
  `project_duration` varchar(50) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `pile_type` varchar(100) NOT NULL,
  `no_of_piles` int(11) NOT NULL,
  `pile_length` decimal(10,2) NOT NULL,
  `pile_rate` decimal(10,2) NOT NULL,
  `penetration_record` text NOT NULL,
  `rig_details` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `rig_length` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `restrike` varchar(100) NOT NULL,
  `piling_days` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_details`
--

INSERT INTO `project_details` (`id`, `contact_no`, `tender_no`, `project_name`, `assigned_team`, `current_status`, `project_duration`, `client_name`, `client_id`, `pile_type`, `no_of_piles`, `pile_length`, `pile_rate`, `penetration_record`, `rig_details`, `address`, `rig_length`, `start_date`, `end_date`, `restrike`, `piling_days`, `image_path`, `created_at`, `updated_at`) VALUES
(1, '9876543210', 'T12345', 'Bridge Construction Project', 1, 'In Progress', '6 months', 'ABC Corp.', 'C98765', 'Bored Pile', 150, '12.50', '1000.50', 'Good penetration up to 12 meters.', 'Rig Model X123 with 200 HP', '123 Main Street, Cityville', '18.00', '2025-01-01', '2025-06-30', 'None', 120, 'uploads/images/project_image.jpg', '2025-01-24 19:19:50', '2025-01-24 19:19:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_details`
--
ALTER TABLE `project_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project_details`
--
ALTER TABLE `project_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
