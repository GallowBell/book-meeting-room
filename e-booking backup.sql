-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 11:04 AM
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
  `sector` varchar(255) DEFAULT NULL,
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
-- Table structure for table `user2`
--

CREATE TABLE `user2` (
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
-- Dumping data for table `user2`
--

INSERT INTO `user2` (`user_id`, `username`, `password`, `first_name`, `last_name`, `phone_number`, `userlevel`, `datasave`) VALUES
(1, 'admin', '$2y$10$SKb60DuwLgBHsMP1J/7mSu4DI4ojXJWR3ixKnDXTbRQL32cPQWaIO', 'Admin', 'istrator', '805552736', 'admin', '2024-08-22 14:39:31'),
(2, 'user', '$2y$10$Ox/wUg.Lo4J0c9bSqZ3zgekHAME99Hu.ArIWo5Ci750aQpOfqaeQO', 'User', 'lastname', '979868567', 'user', '2024-08-22 11:57:08'),
(3, 'user2', '$2y$10$OQzycwX8FoiAa6CEG0DqqOxC5a.VefpSo7/Gwpy3RysI2zLslPf4e', 'User2', 'Two', '12345', 'user', '2024-08-23 02:50:06'),
(4, 'user3', '$2y$10$2wbwOEWtxoQVpyUCCHCu0eDN4DAOsr7QWXC3AvahdoeRKcTXHBtWK', 'User3', 'User3', '885461234', 'user', '2024-08-27 02:57:31'),
(5, 'user4', '$2y$10$OSBOKeDNOgIgPYaxKSi8IeApbuQakU5oxsR7fqQ2OeV5qitzhC4Xq', 'User4', 'user4', '0805552736', 'user', '2024-08-27 02:59:06'),
(6, 'test', '$2y$10$v2H.oi5C6QEOF/6zMe.0s.A9R1vNNHBnfM6ERW53Lah1564mZzkIa', 'Tester', 'ter', '0854123456', 'user', '2024-09-04 04:15:03');

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
  `role_id` int(11) DEFAULT 2,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `phone_number`, `role_id`, `create_date`) VALUES
(1, 'admin', '$2y$10$pVUnxAD6KIYHzFMWAy82K.FOA2579EAMmSOTm6T9898aF6UvI8onK', 'Administrator', 'A1', '0123456789', 2, '2024-09-19 08:33:19'),
(2, 'user', '$2y$10$gq6OhsVvgSqqNnoc823hgOb0nq.Y0oCyP7v.mjgknxrTuIWEDZ.Yu', 'User', 'U1', '0123456789', 1, '2024-09-13 09:02:27'),
(3, 'user2', '$2y$10$f3qCeW4AM01X5ht5aQKREufU.asO/34u4lqljwhE5nUSBk9wzwL5y', 'realname', 'lastname', '0123456789', 2, '2024-09-19 09:04:06'),
(4, 'user3', '$2y$10$NLxvtfIgQYymduY7i59nzuR7JnKcT2O25z7q6Sq4HUktEu5.KlTTW', 'realname', 'lastname', '0123456789', 2, '2024-09-19 09:04:15');

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
-- Indexes for table `user2`
--
ALTER TABLE `user2`
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `equipment_reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_sod_reservations`
--
ALTER TABLE `equipment_sod_reservations`
  MODIFY `equipment_sod_reservations_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user2`
--
ALTER TABLE `user2`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
