-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 06:57 AM
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
(1, 1, 'ที่จอดรถชั้น', '', '1', '', '0000-00-00', '2024-08-26', '00:00:00', '00:00:00'),
(2, 1, 'จำนวนคัน', '', '2', '', '0000-00-00', '2024-08-26', '00:00:00', '00:00:00'),
(3, 1, 'เลขทะเบียนรถ', '', '9กช 9966 1กก 1234', '', '0000-00-00', '2024-08-26', '00:00:00', '00:00:00'),
(4, 1, 'อื่นๆ', '', '0', 'ขอจอดชั้น G', '2024-08-26', '2024-08-26', '08:00:00', '16:30:00'),
(5, 2, 'ชุดโต๊ะหมู่บูชา', '', '1', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(6, 2, 'ถาดเสิร์ฟ', '', '1', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(7, 2, 'จานแก้วใส', 'ใหญ่', '10', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(8, 2, 'ช้อนเล็ก', '', '1', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(9, 2, 'ชุดกาเเฟ', '', '1', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(10, 2, 'ถ้วย', 'ใหญ่', '20', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(11, 2, 'เเก้วน้ำดื่ม', '', '1', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(12, 2, 'คูลเลอร์ใส่น้ำดื่ม', '', '1', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(13, 2, 'ผ้าปูโต๊ะ', '', '1', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(14, 2, 'ผ้าคลุมเก้าอี้', '', '1', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(15, 2, 'ที่จอดรถชั้น', '', '5', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(16, 2, 'จำนวนคัน', '', '20', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(17, 2, 'เลขทะเบียนรถ', '', 'asdasda sdasdas dasd asdas dasd asd asd asdas dasd asd', '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(18, 2, 'อื่นๆ', '', '0', 'อื่นๆ ระบุ', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(19, 3, 'ชุดโต๊ะหมู่บูชา', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(20, 3, 'จาน + ช้อนส้อม', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(21, 3, 'ถาดเสิร์ฟ', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(22, 3, 'จานแก้วใส', 'ใหญ่', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(23, 3, 'ช้อนเล็ก', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(24, 3, 'ชุดกาเเฟ', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(25, 3, 'ถ้วย', 'ใหญ่', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(26, 3, 'เเก้วน้ำดื่ม', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(27, 3, 'คูลเลอร์ใส่น้ำดื่ม', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(28, 3, 'คูลเลอร์ใส่น้ำร้อน', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(29, 3, 'กระติกน้ำเเข็ง', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(30, 3, 'ผ้าปูโต๊ะ', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(31, 3, 'ผ้าคลุมเก้าอี้', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(32, 3, 'ที่จอดรถชั้น', '', '1', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(33, 3, 'จำนวนคัน', '', '33', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(34, 3, 'เลขทะเบียนรถ', '', 'qwe qwe e qweqw asdx azsd asda', '', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(35, 3, 'อื่นๆ', '', '0', 'as dasdaqw eqaweqwe', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00'),
(36, 4, 'ชุดโต๊ะหมู่บูชา', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(37, 4, 'ถาดเสิร์ฟ', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(38, 4, 'จานแก้วใส', 'ใหญ่', '50', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(39, 4, 'ช้อนเล็ก', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(40, 4, 'ชุดกาเเฟ', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(41, 4, 'ถ้วย', 'เล็ก', '60', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(42, 4, 'เเก้วน้ำดื่ม', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(43, 4, 'เหยือกน้ำ', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(44, 4, 'คูลเลอร์ใส่น้ำดื่ม', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(45, 4, 'คูลเลอร์ใส่น้ำร้อน', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(46, 4, 'กระติกน้ำเเข็ง', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(47, 4, 'ผ้าปูโต๊ะ', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(48, 4, 'ที่จอดรถชั้น', '', '1', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(49, 4, 'จำนวนคัน', '', '10', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(50, 4, 'เลขทะเบียนรถ', '', 'sdasdasdasd', '', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(51, 4, 'อื่นๆ', '', '0', 'asdasdasdasdasd', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00'),
(52, 5, 'ชุดโต๊ะหมู่บูชา', '', '1', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(53, 5, 'ถาดเสิร์ฟ', '', '2', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(54, 5, 'ช้อนเล็ก', '', '3', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(55, 5, 'ชุดกาเเฟ', '', '4', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(56, 5, 'เเก้วน้ำดื่ม', '', '5', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(57, 5, 'คูลเลอร์ใส่น้ำดื่ม', '', '6', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(58, 5, 'กระติกน้ำเเข็ง', '', '7', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(59, 5, 'ผ้าคลุมเก้าอี้', '', '8', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(60, 5, 'ที่จอดรถชั้น', '', '9', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(61, 5, 'จำนวนคัน', '', '9', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(62, 5, 'เลขทะเบียนรถ', '', '9', '', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(63, 5, 'อื่นๆ', '', '0', '10', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00'),
(64, 6, 'ชุดโต๊ะหมู่บูชา', '', '1', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(65, 6, 'จาน + ช้อนส้อม', '', '2', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(66, 6, 'ถาดเสิร์ฟ', '', '3', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(67, 6, 'จานแก้วใส', 'ใหญ่', '4', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(68, 6, 'ช้อนเล็ก', '', '5', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(69, 6, 'ส้อมเล็ก', '', '6', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(70, 6, 'ชุดกาเเฟ', '', '7', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(71, 6, 'ถ้วย', 'กลาง', '8', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(72, 6, 'เเก้วน้ำดื่ม', '', '9', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(73, 6, 'เหยือกน้ำ', '', '10', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(74, 6, 'คูลเลอร์ใส่น้ำดื่ม', '', '11', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(75, 6, 'คูลเลอร์ใส่น้ำร้อน', '', '12', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(76, 6, 'กระติกน้ำเเข็ง', '', '13', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(77, 6, 'ผ้าปูโต๊ะ', '', '14', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(78, 6, 'ผ้าคลุมเก้าอี้', '', '15', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(79, 6, 'ที่จอดรถชั้น', '', '16', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(80, 6, 'จำนวนคัน', '', '17', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(81, 6, 'เลขทะเบียนรถ', '', '18', '', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00'),
(82, 6, 'อื่นๆ', '', '0', '19', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00');

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
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `government_sector` varchar(255) DEFAULT NULL,
  `document_number` int(11) DEFAULT NULL,
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
(1, 'กองช่าง', NULL, 'ห้องประชุมชั้น 5', 'เทศบาลปลอดฝุ่น', 'ประชุม', 35, 'เจษฎากร', '0805552736', '2024-08-26', '2024-08-26', '08:00:00', '16:30:00', 'ประเมินระดับประเทศ', '2024-08-25 11:17:13', 1, 2),
(2, 'กองปลัด', NULL, 'ห้องประชุมชั้น 5', 'qwe', 'อบรม', 123, '123', '123', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 'qweqwe', '2024-08-25 12:17:40', 1, 1),
(3, 'กองช่าง', NULL, 'ห้องประชุมชั้น 9', 'qweqwe', 'ฝึกอาชีพ', 123, '123', '123', '2024-09-05', '2024-09-06', '08:00:00', '15:00:00', 'หมายเหตุหมายเหตุหมายเหตุหมายเหตุ', '2024-08-25 12:18:56', 1, 1),
(4, 'กองปลัด', NULL, 'ห้องประชุมชั้น 5', 'qweqweqweqwe', 'อบรม', 123, 'qweqwe', '12312312', '2024-09-02', '2024-09-03', '08:00:00', '16:00:00', 'หมายเหตุหมายเหตุหมายเหตุ', '2024-08-25 12:20:44', 1, 1),
(5, 'กองสาธารณสุขฯ', NULL, 'ห้องประชุมชั้น 4', 'dasda', 'ฝึกอาชีพ', 12, 'dasda', '23131', '2024-08-31', '2024-08-31', '09:00:00', '10:00:00', 'dasda', '2024-08-25 13:13:00', -1, 1),
(6, 'กองช่าง', 1234, 'ห้องประชุมชั้น 5', 'หัวข้อ 5', 'อบรม', 50, 'เจษฎากร', '0805552736', '2024-08-27', '2024-08-31', '09:00:00', '16:00:00', 'หมายเหตุ', '2024-08-26 04:18:48', 1, 2),
(7, 'กองสาธารณสุข', 22504, 'ห้องประชุมชั้น 4', 'ทดสอบห้อง 4', 'ฝึกอาชีพ', 12, 'กกฟหกฟ', '0805552736', '2024-09-01', '2024-09-01', '10:00:00', '12:00:00', '', '2024-08-26 04:54:29', 1, 2);

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
  `phone_number` int(10) NOT NULL,
  `userlevel` varchar(10) NOT NULL,
  `datasave` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `first_name`, `last_name`, `phone_number`, `userlevel`, `datasave`) VALUES
(1, 'admin', '$2y$10$SKb60DuwLgBHsMP1J/7mSu4DI4ojXJWR3ixKnDXTbRQL32cPQWaIO', 'Admin', 'istrator', 805552736, 'admin', '2024-08-22 14:39:31'),
(2, 'user', '$2y$10$Ox/wUg.Lo4J0c9bSqZ3zgekHAME99Hu.ArIWo5Ci750aQpOfqaeQO', 'User', 'lastname', 979868567, 'user', '2024-08-22 11:57:08'),
(3, 'user2', '$2y$10$OQzycwX8FoiAa6CEG0DqqOxC5a.VefpSo7/Gwpy3RysI2zLslPf4e', 'User2', 'Two', 12345, 'user', '2024-08-23 02:50:06');

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
-- AUTO_INCREMENT for table `equipment_reservations`
--
ALTER TABLE `equipment_reservations`
  MODIFY `equipment_reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `equipment_sod_reservations`
--
ALTER TABLE `equipment_sod_reservations`
  MODIFY `equipment_sod_reservations_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
