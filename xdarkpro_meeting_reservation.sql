-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2024 at 08:31 PM
-- Server version: 10.6.18-MariaDB-cll-lve
-- PHP Version: 8.1.29

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
(1, 1, 'ถาดเสิร์ฟ', '', '1', '', '2024-09-04', '2024-09-05', '07:00:00', '12:00:00'),
(2, 1, 'ช้อนเล็ก', '', '10', '', '2024-09-04', '2024-09-05', '07:00:00', '12:00:00'),
(3, 1, 'ชุดกาเเฟ', '', '10', '', '2024-09-04', '2024-09-05', '07:00:00', '12:00:00'),
(4, 1, 'ถ้วย', 'กลาง', '10', '', '2024-09-04', '2024-09-05', '07:00:00', '12:00:00'),
(5, 1, 'เเก้วน้ำดื่ม', '', '10', '', '2024-09-04', '2024-09-05', '07:00:00', '12:00:00'),
(6, 1, 'คูลเลอร์ใส่น้ำดื่ม', '', '2', '', '2024-09-04', '2024-09-05', '07:00:00', '12:00:00'),
(7, 1, 'คูลเลอร์ใส่น้ำร้อน', '', '2', '', '2024-09-04', '2024-09-05', '07:00:00', '12:00:00'),
(8, 1, 'ที่จอดรถชั้น', '', '1', '', '0000-00-00', '2024-09-05', '00:00:00', '00:00:00'),
(9, 1, 'จำนวนคัน', '', '1', '', '0000-00-00', '2024-09-05', '00:00:00', '00:00:00'),
(10, 1, 'เลขทะเบียนรถ', '', '1กข 741 กรุงเทพมหานคร', '', '0000-00-00', '2024-09-05', '00:00:00', '00:00:00'),
(11, 2, 'ถาดเสิร์ฟ', '', '2', '', '2024-09-04', '2024-09-04', '08:00:00', '16:00:00'),
(12, 2, 'ช้อนเล็ก', '', '30', '', '2024-09-04', '2024-09-04', '08:00:00', '16:00:00'),
(13, 2, 'ชุดกาเเฟ', '', '30', '', '2024-09-04', '2024-09-04', '08:00:00', '16:00:00'),
(14, 2, 'คูลเลอร์ใส่น้ำร้อน', '', '1', '', '2024-09-04', '2024-09-04', '08:00:00', '16:00:00'),
(15, 3, 'ถาดเสิร์ฟ', '', '2', '', '2024-09-05', '2024-09-05', '09:00:00', '10:00:00'),
(16, 3, 'ช้อนเล็ก', '', '20', '', '2024-09-05', '2024-09-05', '09:00:00', '10:00:00'),
(17, 3, 'ส้อมเล็ก', '', '20', '', '2024-09-05', '2024-09-05', '09:00:00', '10:00:00'),
(18, 3, 'ชุดกาเเฟ', '', '20', '', '2024-09-05', '2024-09-05', '09:00:00', '10:00:00'),
(19, 4, 'ชุดโต๊ะหมู่บูชา', '', '1', '', '2024-09-12', '2024-09-12', '12:00:00', '13:00:00'),
(20, 4, 'ถาดเสิร์ฟ', '', '5', '', '2024-09-12', '2024-09-12', '12:00:00', '13:00:00'),
(21, 5, 'ถาดเสิร์ฟ', '', '1', '', '2024-09-05', '2024-09-05', '10:00:00', '12:00:00'),
(22, 5, 'ชุดกาเเฟ', '', '15', '', '2024-09-05', '2024-09-05', '10:00:00', '12:00:00'),
(23, 5, 'คูลเลอร์ใส่น้ำร้อน', '', '1', '', '2024-09-05', '2024-09-05', '10:00:00', '12:00:00'),
(24, 6, 'ถาดเสิร์ฟ', '', '1', '', '0000-00-00', '0000-00-00', '12:00:00', '16:00:00'),
(25, 6, 'คูลเลอร์ใส่น้ำร้อน', '', '1', '', '0000-00-00', '0000-00-00', '12:00:00', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_sod_reservations`
--

CREATE TABLE `equipment_sod_reservations` (
  `equipment_sod_reservations_id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `equipment_sod_name` varchar(255) DEFAULT NULL,
  `equipment_sod_quantity` varchar(255) DEFAULT NULL,
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
(1, 1, 'ชุดเครื่องเสียงห้องประชุม', '1', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(2, 1, 'ชุดเครื่องเสียงนอกสถานที่', '1', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(3, 1, 'เครื่องโปรเจคเตอร์', '1', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(4, 1, 'เครื่องเสียงพกพาพร้อมไมโครโฟน', '1', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(5, 1, 'การบันทึกเทปภาพบรรยาย', '1', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(6, 1, 'การบันทึกเทปเสียงบรรยาย', '1', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(7, 1, 'แฟ้มเอกสาร', '50', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(8, 1, 'เอกสารของที่ระลึก', '100', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(9, 1, 'พิธีกรดำเนินงาน (วัน/เวลา) ในวันที่', '1', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(10, 1, 'ช่างภาพ (วัน/เวลา) ในวันที่', '1', '', '2024-09-04', '09:00:00', NULL, NULL, NULL, NULL, '2024-09-05', '12:00:00'),
(11, 2, 'ชุดเครื่องเสียงห้องประชุม', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(12, 2, 'เครื่องโปรเจคเตอร์', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(13, 2, 'เจ้าหน้าที่ควบคุม', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(14, 2, 'อื่นๆ', '1', 'เครื่องคอมพิวเตอร์ Notebook', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(15, 3, 'ชุดเครื่องเสียงห้องประชุม', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(16, 3, 'เครื่องโปรเจคเตอร์', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(17, 3, 'เจ้าหน้าที่ควบคุม', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(18, 3, 'อื่นๆ', '1', 'เครื่องคอมพิวเตอร์ Notebook', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(19, 4, 'ชุดเครื่องเสียงห้องประชุม', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(20, 4, 'ชุดเครื่องเสียงนอกสถานที่', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(21, 4, 'เครื่องโปรเจคเตอร์', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(22, 4, 'เครื่องเสียงลำโพงกระเป๋าหิ้ว', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(23, 4, 'เจ้าหน้าที่ควบคุม', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(24, 4, 'เครื่องเสียงพกพาพร้อมไมโครโฟน', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(25, 4, 'การบันทึกเทปภาพบรรยาย', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(26, 4, 'การบันทึกเทปเสียงบรรยาย', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(27, 4, 'การบันทึกภาพนิ่ง', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(28, 4, 'การส่งข่าวประชาสัมพันธ์', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(29, 4, 'แฟ้มเอกสาร', '10', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(30, 4, 'เอกสารของที่ระลึก', '10', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(31, 4, 'เอกสารแจก', '10', 'เอกสารต่างๆ', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(32, 4, 'พิธีกรดำเนินงาน (วัน/เวลา) ในวันที่', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(33, 4, 'ช่างภาพ (วัน/เวลา) ในวันที่', '1', '', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(34, 4, 'รถประชาสัมพันธ์เคลื่อนที่', '1', '2 คัน', '2024-09-12', '12:00:00', NULL, NULL, NULL, NULL, '2024-09-12', '12:00:00'),
(35, 5, 'ชุดเครื่องเสียงห้องประชุม', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(36, 5, 'เครื่องโปรเจคเตอร์', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(37, 5, 'เจ้าหน้าที่ควบคุม', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(38, 6, 'ชุดเครื่องเสียงห้องประชุม', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(39, 6, 'เครื่องโปรเจคเตอร์', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00'),
(40, 6, 'เจ้าหน้าที่ควบคุม', '1', '', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, '0000-00-00', '00:00:00');

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
(1, 'กองสาธารณะสุขฯ ฝ่ายบริหารงานสาธารณะสุข งานส่งเสริมคุณภาพสิ่งแวดล้อม', '1598', 'ห้องประชุมชั้น 9', 'โครงการอบรมความรู้การลด คัดแยกมูลฝอยและมูลฝอยอันตราย', 'รับคณะ', 100, 'เจษฎากร', '021598375', '2024-09-04', '2024-09-05', '07:00:00', '12:00:00', 'หมายเหตุแจ้งแอดมิน', '2024-09-06 08:57:58', -1, 2),
(2, 'สำนักปลัดเทศบาล', '', 'ห้องประชุมชั้น 4', 'พิจารณาผลโครงการก่อสร้างอาคาร', 'ประชุม', 30, 'จิรินทร์นุช จันทร์วงษ์', '419', '2024-09-04', '2024-09-04', '08:00:00', '16:00:00', '', '2024-09-06 08:48:23', 1, 4),
(3, 'สำนักปลัดเทศบาล', '11', 'ห้องประชุมชั้น 4', 'สรุปงบประมาณสำนักปลัดเทศบาล', 'ประชุม', 20, 'จิรินทร์นุช จันทร์วงษ์', '419', '2024-09-05', '2024-09-05', '09:00:00', '10:00:00', 'qweqwe', '2024-09-06 08:48:20', 1, 4),
(4, 'กองสาธารณสุข', '1234', 'ห้องประชุมชั้น 5', 'สมดุล ฝุ่น คน เมือง', 'อบรม', 30, 'จิรินทร์นุช จันทร์วงษ์', '419', '2024-09-12', '2024-09-12', '12:00:00', '13:00:00', '', '2024-09-06 08:57:52', 0, 1),
(5, 'สำนักปลัดเทศบาล', '', 'ห้องประชุมชั้น 4', 'พิจารณาผลโครงการก่อสร้างอาคาร', 'ประชุม', 30, 'จิรินทร์นุช จันทร์วงษ์', '419', '2024-09-05', '2024-09-05', '08:30:00', '12:00:00', '', '2024-09-06 08:48:18', 1, 4),
(6, 'สำนักปลัดเทศบาล', '', 'ห้องประชุมชั้น 4', 'พิจารณาผลโครงการก่อสร้างอาคาร', 'ประชุม', 20, 'จิรินทร์นุช จันทร์วงษ์', '419', '2024-09-04', '2024-09-04', '12:00:00', '16:00:00', '', '2024-09-05 03:27:39', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(10) NOT NULL,
  `userlevel` varchar(10) NOT NULL,
  `datasave` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `first_name`, `last_name`, `phone_number`, `userlevel`, `datasave`) VALUES
(1, 'admin', '$2y$10$SKb60DuwLgBHsMP1J/7mSu4DI4ojXJWR3ixKnDXTbRQL32cPQWaIO', 'Admin', 'istrator', '805552736', 'admin', '2024-08-22 14:39:31'),
(2, 'user', '$2y$10$Ox/wUg.Lo4J0c9bSqZ3zgekHAME99Hu.ArIWo5Ci750aQpOfqaeQO', 'User', 'lastname', '979868567', 'user', '2024-08-22 11:57:08'),
(3, 'user2', '$2y$10$OQzycwX8FoiAa6CEG0DqqOxC5a.VefpSo7/Gwpy3RysI2zLslPf4e', 'User2', 'Two', '12345', 'user', '2024-08-23 02:50:06'),
(4, 'jirinnuch', '$2y$10$s85FGcUZib1GzErVBmIY9uG6hkeD.gIFy8NLkNcMJ5szGzlWD6C6y', 'จิรินทร์นุช ', 'จันทร์วงษ์', '961655549', 'user', '2024-09-02 07:12:47');

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
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `equipment_reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `equipment_sod_reservations`
--
ALTER TABLE `equipment_sod_reservations`
  MODIFY `equipment_sod_reservations_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
