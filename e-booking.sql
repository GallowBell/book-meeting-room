-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 10:53 AM
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
-- Database: `xdarkpro_meeting_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_name` varchar(255) DEFAULT NULL,
  `comment_text` varchar(255) DEFAULT NULL,
  `time_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `reservation_date_end` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_reservations`
--

INSERT INTO `equipment_reservations` (`equipment_reservation_id`, `reservation_id`, `equipment_name`, `equipment_size`, `equipment_quantity`, `additional_details`, `reservation_date`, `reservation_date_end`, `start_time`, `end_time`) VALUES
(1, 1, 'ชุดโต๊ะหมู่บูชา', '', '1', '', '2024-09-10', '2024-09-11', '08:00:00', '12:00:00'),
(2, 1, 'จาน + ช้อนส้อม', '', '20', '', '2024-09-10', '2024-09-11', '08:00:00', '12:00:00'),
(3, 1, 'ถาดเสิร์ฟ', '', '20', '', '2024-09-10', '2024-09-11', '08:00:00', '12:00:00'),
(4, 1, 'จานแก้วใส', 'กลาง', '20', '', '2024-09-10', '2024-09-11', '08:00:00', '12:00:00'),
(5, 1, 'คูลเลอร์ใส่น้ำดื่ม', '', '3', '', '2024-09-10', '2024-09-11', '08:00:00', '12:00:00'),
(6, 1, 'ผ้าคลุมเก้าอี้', '', '20', '', '2024-09-10', '2024-09-11', '08:00:00', '12:00:00'),
(7, 1, 'ที่จอดรถชั้น', '', '1', '', '0000-00-00', '2024-09-11', '00:00:00', '00:00:00'),
(8, 1, 'จำนวนคัน', '', '1', '', '0000-00-00', '2024-09-11', '00:00:00', '00:00:00'),
(9, 1, 'เลขทะเบียนรถ', '', '1กก 1234', '', '0000-00-00', '2024-09-11', '00:00:00', '00:00:00'),
(10, 1, 'อื่นๆ', '', '0', 'อาหารกลางวัน จำนวน 50 ท่าน', '2024-09-10', '2024-09-11', '08:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_sod_reservations`
--

CREATE TABLE `equipment_sod_reservations` (
  `equipment_sod_reservations_id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `equipment_sod_name` varchar(255) DEFAULT NULL,
  `equipment_sod_quantity` varchar(255) DEFAULT '1',
  `additional_sod_details` text DEFAULT NULL,
  `operate_date` date DEFAULT NULL,
  `operate_time` time DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `reservation_date_end` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `operate_date_2` date DEFAULT NULL,
  `operate_time_2` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_sod_reservations`
--

INSERT INTO `equipment_sod_reservations` (`equipment_sod_reservations_id`, `reservation_id`, `equipment_sod_name`, `equipment_sod_quantity`, `additional_sod_details`, `operate_date`, `operate_time`, `reservation_date`, `reservation_date_end`, `start_time`, `end_time`, `operate_date_2`, `operate_time_2`) VALUES
(1, 1, 'ชุดเครื่องเสียงห้องประชุม', '1', '', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(2, 1, 'เครื่องโปรเจคเตอร์', '1', '', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(3, 1, 'เจ้าหน้าที่ควบคุม', '1', '', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(4, 1, 'เครื่องเสียงพกพาพร้อมไมโครโฟน', '1', '', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(5, 1, 'การบันทึกภาพนิ่ง', '1', '', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(6, 1, 'แฟ้มเอกสาร', '20', '', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(7, 1, 'เอกสารของที่ระลึก', '10', '', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(8, 1, 'การประชุมออนไลน์', '1', 'Adobe Effect', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(9, 1, 'เอกสารแจก', '20', 'เอกสารแจก A4 ใบนำเสนอ', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(10, 1, 'พิธีกรดำเนินงาน (วัน/เวลา) ในวันที่', '1', '', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00'),
(11, 1, 'ช่างภาพ (วัน/เวลา) ในวันที่', '1', '', '2024-09-10', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-10', '08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `government_sector` varchar(255) DEFAULT NULL,
  `document_number` text DEFAULT NULL,
  `meeting_room` varchar(255) DEFAULT NULL,
  `meeting_name` varchar(255) DEFAULT NULL,
  `meeting_type` varchar(255) DEFAULT NULL,
  `participant_count` int(11) DEFAULT NULL,
  `organizer_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `reservation_date_end` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `Timestamps` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_approve` int(2) DEFAULT -1,
  `user_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `government_sector`, `document_number`, `meeting_room`, `meeting_name`, `meeting_type`, `participant_count`, `organizer_name`, `contact_number`, `reservation_date`, `reservation_date_end`, `start_time`, `end_time`, `notes`, `Timestamps`, `is_approve`, `user_id`) VALUES
(1, 'กองสาธารณสุข', '', 'ห้องประชุมชั้น 4', '(ทดสอบ) สมดุล ฝุ่น คน เมือง', 'ประชุม', 50, 'เจษฎากร (Admin)', '555', '2024-09-10', '2024-09-11', '08:00:00', '12:00:00', '', '2024-09-10 08:48:28', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `phone_number`, `role_id`, `create_date`) VALUES
(1, 'admin', '$2y$10$pVUnxAD6KIYHzFMWAy82K.FOA2579EAMmSOTm6T9898aF6UvI8onK', 'Administrator', 'A1', '0123456789', 1, '2024-09-10 08:33:39'),
(2, 'user', '$2y$10$gq6OhsVvgSqqNnoc823hgOb0nq.Y0oCyP7v.mjgknxrTuIWEDZ.Yu', 'User', 'U1', '0123456789', 2, '2024-09-10 08:34:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `equipment_reservations`
--
ALTER TABLE `equipment_reservations`
  ADD PRIMARY KEY (`equipment_reservation_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `equipment_sod_reservations`
--
ALTER TABLE `equipment_sod_reservations`
  ADD PRIMARY KEY (`equipment_sod_reservations_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_reservations`
--
ALTER TABLE `equipment_reservations`
  MODIFY `equipment_reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `equipment_sod_reservations`
--
ALTER TABLE `equipment_sod_reservations`
  MODIFY `equipment_sod_reservations_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment_reservations`
--
ALTER TABLE `equipment_reservations`
  ADD CONSTRAINT `equipment_reservations_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
