-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2024 at 01:22 PM
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
  `reservation_date_end` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `Timestamps` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_approve` int(2) DEFAULT -1,
  `user_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `equipment_reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

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
