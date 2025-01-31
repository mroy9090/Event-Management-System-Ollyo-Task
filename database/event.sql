-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 10:02 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendee_registration`
--

CREATE TABLE `attendee_registration` (
  `registration_id` int(10) NOT NULL,
  `attendee_contact_number` int(20) NOT NULL,
  `registration_time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(10) NOT NULL,
  `event_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendee_registration`
--

INSERT INTO `attendee_registration` (`registration_id`, `attendee_contact_number`, `registration_time_stamp`, `user_id`, `event_id`) VALUES
(42, 345, '2025-01-30 00:43:57', 'event-001', 24),
(43, 567, '2025-01-30 00:44:11', 'event-003', 25),
(44, 123, '2025-01-30 00:44:47', 'event-002', 27),
(55, 234, '2025-01-31 10:59:16', 'event-725', 31),
(56, 234, '2025-01-31 11:00:07', 'event-311', 31);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_category` varchar(100) NOT NULL,
  `event_decription` text NOT NULL,
  `venue_name` text NOT NULL,
  `event_ticket_price` double NOT NULL,
  `event_ticket_total` int(11) NOT NULL,
  `event_ticket_sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`, `event_time`, `event_category`, `event_decription`, `venue_name`, `event_ticket_price`, `event_ticket_total`, `event_ticket_sold`) VALUES
(24, 'ollyocon-2024', '2025-01-31', '04:30:00', 'celebration', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'ollyo', 234, 3, 2),
(25, 'music fest-3.0', '2025-02-04', '12:12:00', 'Music', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'Army Stadium', 234, 3, 2),
(26, 'Campus vibes', '2025-02-05', '05:30:00', 'Gathering', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'UIU', 234, 3, 2),
(27, 'XYZ', '2025-01-31', '12:00:00', 'Fair', 'xyz', 'et', 456, 5, 2),
(31, 'music fest 4.0(Rahat Fateh Ali Khan)', '2025-02-18', '06:06:00', 'Music', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'Army', 345, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `password`, `name`, `email`, `usertype`) VALUES
(11, 'event-002', 'a', '$2y$10$.JnSUrWOfkiGMl8WhG5reepB6qbKJwakwW9AbT4ZQDXxpGLLOJsHu', 'a', 'a', 'ADMIN'),
(13, 'event-001', 'b', '$2y$10$IeGrIzuRYLeT.yBQDjwQYuaE3AvXXLzq0EGVr4t/4TMqfquNFaw12', 'b', 'b@mail.com', 'NON-ADMIN'),
(14, 'event-003', 'c', '$2y$10$Sl2W.dk6uz8FV8F2NatXweraTOTouQaFFxcsO0fwDq.IZ0uHydFq.', 'c', 'c@mail.com', 'NON-ADMIN'),
(16, 'event-68', 'd', '$2y$10$hwA0suQJ5toX8sozAUivC.oALCzPfjbDitWKhJlRbL1sA1S/JOdXC', 'd', 'd', 'NON-ADMIN'),
(17, 'event-725', 'admin', '$2y$10$1lrB9IHqxh3DP5mGUFgNMeSIIVJJXGST/gHEElocpyTmvleS23Re2', 'admin', 'admin@mail.com', 'ADMIN'),
(38, 'event-311', 'Raju21', '$2y$10$5ITzg0Rb6AnuHPtC9wpfEOwlyZFGUubHW247M75o8H69jKsNXEOn6', 'md raju islam', 'raju@mail.com', 'NON-ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendee_registration`
--
ALTER TABLE `attendee_registration`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `booking_details_ibfk_1` (`user_id`),
  ADD KEY `booking_details_ibfk_2` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UserID` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendee_registration`
--
ALTER TABLE `attendee_registration`
  MODIFY `registration_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendee_registration`
--
ALTER TABLE `attendee_registration`
  ADD CONSTRAINT `test_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `test_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
