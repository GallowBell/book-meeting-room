-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 04:22 PM
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
-- Database: `meeting_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment_reservations`
--

CREATE TABLE `equipment_reservations` (
  `equipment_reservation_id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `equipment_name` varchar(255) DEFAULT NULL,
  `equipment_size` varchar(50) DEFAULT NULL,
  `equipment_quantity` varchar(255) DEFAULT NULL,
  `additional_details` text DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_reservations`
--

INSERT INTO `equipment_reservations` (`equipment_reservation_id`, `reservation_id`, `equipment_name`, `equipment_size`, `equipment_quantity`, `additional_details`, `reservation_date`, `start_time`, `end_time`) VALUES
(1, 1, 'ชุดโต๊ะหมู่บูชา', '', '1', '', '2024-08-20', '08:00:00', '10:30:00'),
(2, 1, 'จาน + ช้อนส้อม', '', '3', '', '2024-08-20', '08:00:00', '10:30:00'),
(3, 1, 'ถาดเสิร์ฟ', '', '3', '', '2024-08-20', '08:00:00', '10:30:00'),
(4, 1, 'จานแก้วใส', 'ใหญ่', '4', '', '2024-08-20', '08:00:00', '10:30:00'),
(5, 1, 'ถ้วย', 'ใหญ่', '5', '', '2024-08-20', '08:00:00', '10:30:00'),
(6, 1, 'ผ้าปูโต๊ะ', '', '6', '', '2024-08-20', '08:00:00', '10:30:00'),
(7, 1, 'ผ้าคลุมเก้าอี้', '', '7', '', '2024-08-20', '08:00:00', '10:30:00'),
(8, 1, 'ชั้น', '', '1', '', '2024-08-20', '08:00:00', '10:30:00'),
(9, 1, 'จำนวนคัน', '', '2', '', '2024-08-20', '08:00:00', '10:30:00'),
(10, 1, 'เลขทะเบียนรถ', '', '9กช 96 1กก 1111', '', '2024-08-20', '08:00:00', '10:30:00'),
(11, 1, 'อื่นๆ', '', '0', 'อื่นๆระบุ', '2024-08-20', '08:00:00', '10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `meeting_room` varchar(255) DEFAULT NULL,
  `meeting_name` varchar(255) DEFAULT NULL,
  `meeting_type` varchar(255) DEFAULT NULL,
  `participant_count` int(11) DEFAULT NULL,
  `organizer_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `Timestamps` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `meeting_room`, `meeting_name`, `meeting_type`, `participant_count`, `organizer_name`, `contact_number`, `reservation_date`, `start_time`, `end_time`, `notes`, `Timestamps`) VALUES
(1, 'ห้องประชุมชั้น 4', 'ทดสอบ 1', 'ประชุม', 50, 'เจษฎากร', '080', '2024-08-20', '08:00:00', '10:30:00', 'หมายเหตุ', '2024-08-20 14:19:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment_reservations`
--
ALTER TABLE `equipment_reservations`
  ADD PRIMARY KEY (`equipment_reservation_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipment_reservations`
--
ALTER TABLE `equipment_reservations`
  MODIFY `equipment_reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment_reservations`
--
ALTER TABLE `equipment_reservations`
  ADD CONSTRAINT `equipment_reservations_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
