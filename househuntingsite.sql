-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 05:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `househuntingsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `creditpasses`
--

CREATE TABLE `creditpasses` (
  `unitID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `time` varchar(20) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expiryDate` varchar(30) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `creditpasses`
--

INSERT INTO `creditpasses` (`unitID`, `userID`, `time`, `expired`, `expiryDate`, `id`) VALUES
(16, 3, '2023-05-25 12:31:06', 1, '2023-05-24 11:42:48pm', 1),
(16, 3, '2023-05-25 12:41:44', 1, '2023-05-24 11:46:31pm', 2),
(16, 3, '2023-05-25 01:00:16', 1, '2023-05-25 12:01:38am', 3),
(16, 3, '2023-05-25 01:02:15', 1, '2023-05-25 12:02:21am', 4),
(16, 3, '2023-05-25 01:02:24', 1, '2023-05-25 12:02:29am', 5),
(16, 3, '2023-05-25 01:02:41', 1, '2023-05-25 12:02:46am', 6),
(16, 3, '2023-05-25 01:02:51', 1, '2023-05-25 12:02:54am', 7),
(16, 3, '2023-05-25 01:02:58', 1, '2023-05-25 12:03:02am', 8),
(16, 3, '2023-05-25 01:03:07', 1, '2023-05-25 12:03:10am', 9),
(16, 3, '2023-05-25 01:03:13', 1, '2023-05-25 12:03:20am', 10),
(16, 3, '2023-05-25 01:03:23', 1, '2023-05-25 12:03:27am', 11),
(16, 3, '2023-05-25 01:03:41', 1, '2023-05-25 12:03:44am', 12),
(16, 3, '2023-05-25 01:03:47', 1, '2023-05-25 12:03:52am', 13),
(16, 3, '2023-05-25 01:04:04', 1, '2023-05-25 12:04:10am', 14),
(16, 3, '2023-05-25 01:04:25', 1, '2023-05-25 12:04:30am', 15),
(16, 3, '2023-05-25 01:04:43', 1, '2023-05-25 12:05:14am', 16),
(16, 3, '2023-05-25 01:06:16', 1, '2023-05-25 12:07:49am', 17),
(16, 3, '2023-05-25 01:09:31', 1, '2023-05-25 12:09:43am', 18),
(16, 3, '2023-05-25 01:12:00', 1, '2023-05-26 02:02:17am', 19);

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `phoneNumber` varchar(11) NOT NULL,
  `amount` int(10) NOT NULL,
  `credits` int(10) NOT NULL,
  `time` varchar(100) NOT NULL,
  `userID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`phoneNumber`, `amount`, `credits`, `time`, `userID`) VALUES
('900', 100, 2, '2023-05-03 01:47:07am', 3),
('900', 100, 2, '2023-05-03 01:47:41am', 3),
('60000', 50, 1, '2023-05-03 01:52:17am', 3),
('045', 400, 8, '2023-05-03 01:54:02am', 3),
('045', 400, 8, '2023-05-03 01:54:16am', 3),
('045', 400, 8, '2023-05-03 01:55:59am', 3),
('045', 400, 8, '2023-05-03 01:56:19am', 3),
('8098', 50, 1, '2023-05-03 02:05:20am', 3),
('8098', 50, 1, '2023-05-03 02:08:50am', 3),
('578', 50, 1, '2023-05-03 02:11:03am', 3),
('', 50, 1, '2023-05-03 02:12:25am', 3),
('', 50, 1, '2023-05-03 02:15:05am', 3),
('', 50, 1, '2023-05-03 02:19:24am', 3),
('', 50, 1, '2023-05-03 02:23:14am', 3),
('', 50, 1, '2023-05-03 02:33:51am', 3),
('', 50, 1, '2023-05-03 02:34:22am', 3),
('', 50, 1, '2023-05-03 02:38:23am', 3),
('', 100, 2, '2023-05-03 03:17:06pm', 3),
('', 100, 2, '2023-05-03 03:27:28pm', 3),
('', 50, 1, '2023-05-03 07:59:55am', 3),
('', 50, 1, '2023-05-03 08:16:01am', 3),
('', 50, 1, '2023-05-03 08:17:18am', 3),
('', 50, 1, '2023-05-03 08:24:40am', 3),
('', 50, 1, '2023-05-03 08:24:59am', 3),
('', 50, 1, '2023-05-03 08:31:49am', 3),
('', 1, 0, '2023-05-03 08:42:13am', 3),
('', 1, 0, '2023-05-03 08:42:34am', 3),
('', 50, 1, '2023-05-03 09:23:46am', 3),
('', 50, 1, '2023-05-03 09:26:56am', 3),
('', 50, 1, '2023-05-03 09:27:42am', 3),
('', 50, 1, '2023-05-03 09:28:34am', 3),
('', 50, 1, '2023-05-03 09:28:45am', 3),
('', 50, 1, '2023-05-03 09:29:17am', 3),
('', 50, 1, '2023-05-03 09:29:36am', 3),
('', 50, 1, '2023-05-03 09:31:53am', 3),
('', 50, 1, '2023-05-03 09:32:21am', 3),
('', 50, 1, '2023-05-03 09:32:35am', 3),
('', 50, 1, '2023-05-03 09:32:44am', 3),
('', 50, 1, '2023-05-03 09:33:12am', 3),
('', 50, 1, '2023-05-03 09:33:29am', 3),
('7356', 100, 2, '2023-05-25 01:07:30am', 3),
('463746', 50, 1, '2023-05-25 01:09:29am', 3),
('7347617', 2, 0, '2023-05-25 01:11:13am', 3),
('184578934', 50, 1, '2023-05-25 01:11:57am', 3);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `senderID` int(11) NOT NULL,
  `receipientID` int(11) NOT NULL,
  `time` varchar(60) NOT NULL,
  `subjectUnit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `senderID`, `receipientID`, `time`, `subjectUnit`) VALUES
(63, 'Yo', 11, 3, '2023-04-12 12:25:11pm', 15),
(64, 'hui', 11, 3, '2023-04-12 12:30:51pm', 15),
(65, 'hui', 11, 3, '2023-04-12 12:31:01pm', 15),
(66, 'hiii', 11, 3, '2023-04-12 12:31:11pm', 15),
(67, 'HI', 11, 3, '2023-04-12 12:32:37pm', 15),
(68, 'HI', 11, 3, '2023-04-12 12:32:44pm', 15),
(69, 'HI', 11, 3, '2023-04-12 12:33:06pm', 15),
(71, 'hiii', 11, 3, '2023-04-12 12:34:00pm', 15),
(72, 'yo', 11, 3, '2023-04-12 12:34:07pm', 15),
(75, 'Hello', 9, 3, '2023-04-12 12:55:13pm', 16),
(76, 'hdfjaksaksflsdhfkadjadksalkfalfkfdlkkkkhlashdfajkkkkkkkkkkfhl', 9, 3, '2023-04-12 12:58:45pm', 16),
(77, 'hi', 9, 11, '2023-04-12 01:04:52pm', 19),
(78, 'So', 9, 3, '2023-04-12 01:06:04pm', 15),
(79, 'kk', 9, 3, '2023-04-12 01:07:41pm', 16),
(99, 'yoh\r\n', 9, 3, '2023-04-12 11:52:16pm', 0),
(100, 'hey man', 9, 3, '2023-04-12 11:53:32pm', 0),
(101, 'so', 9, 3, '2023-04-12 11:53:56pm', 0),
(102, 'hello', 4, 3, '2023-04-13 10:46:46pm', 0),
(103, 'hey\r\n', 4, 3, '2023-04-13 10:50:54pm', 0),
(104, 'hm?', 4, 3, '2023-04-13 10:52:18pm', 15);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `emailAddress` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `category` varchar(10) NOT NULL,
  `dateRegistered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profilePhoto` blob NOT NULL,
  `phoneNumber` varchar(14) NOT NULL,
  `rating` int(1) NOT NULL,
  `credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `emailAddress`, `password`, `category`, `dateRegistered`, `profilePhoto`, `phoneNumber`, `rating`, `credits`) VALUES
(1, 'Sandra Bullock', 'sandy@bullock.com', 'sandy123', 'looking', '2023-03-30 11:04:11', '', '0', 0, 0),
(3, 'Fredrick Kamau', 'fredric.ngugi@yahoo.com', 'fred123', 'showing', '2023-05-26 00:02:18', '', '0724175469', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `category` varchar(20) NOT NULL,
  `cost` int(8) NOT NULL,
  `location` varchar(60) NOT NULL,
  `size` int(8) NOT NULL,
  `bedroomNo` int(8) NOT NULL,
  `virtualTour` varchar(60) NOT NULL,
  `id` int(11) NOT NULL,
  `others` varchar(60) NOT NULL,
  `userID` int(10) NOT NULL,
  `likes` int(10) NOT NULL,
  `likedBy` mediumtext NOT NULL,
  `unitCondition` varchar(20) NOT NULL,
  `bathroomNo` int(5) NOT NULL,
  `amenities` varchar(200) NOT NULL,
  `accessibility` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`category`, `cost`, `location`, `size`, `bedroomNo`, `virtualTour`, `id`, `others`, `userID`, `likes`, `likedBy`, `unitCondition`, `bathroomNo`, `amenities`, `accessibility`) VALUES
('rental', 7000, 'Nairobi, Kenya', 300, 1, 'living-room.jpg*living-room.jpg*user.png*living-room.jpg*liv', 25, 'Pets allowed', 3, 0, '', 'Move-in ready', 1, 'Gym*Laundry machine', 'Ramp'),
('forSale', 30000, 'Nairobi, Kenya', 500, 2, 'living-room.jpg*user.png*user.png', 26, 'pets allowed', 3, 0, '', 'move-in ready', 0, 'Storage area*High speed internet', 'ramp*elevator'),
('forSale', 1000000, 'Muthaiga', 400, 2, 'living-room.jpg*user.png*living-room.jpg', 27, 'pets allowed', 3, 0, '', 'move-in ready', 0, 'Gym', 'ramp'),
('forSale', 7000, 'dahfkjad', 90, 1, 'living-room.jpg*user.png', 28, 'pets allowed', 3, 0, '', 'fixer upper', 0, 'Storage area', 'ramp'),
('forSale', 1000000, 'home', 400, 2, 'living-room.jpg*user.png', 29, 'Furnished', 3, 0, '', 'Move-in ready', 1, 'Storage area*High speed internet', 'Single storey building'),
('forSale', 6000000, 'Muthaiga', 1200, 2, 'living-room.jpg*user.png', 30, 'pets allowed*Swimming pool', 3, 0, '', 'Move-in ready', 0, 'Parking space*Playground', 'Ramp*Elevator'),
('forSale', 6000000, 'Muthaiga', 1200, 2, 'living-room.jpg*living-room.jpg*user.png', 31, 'Swimming pool*Pets allowed', 3, 0, '', 'Move-in ready', 1, 'Parking space*Playground', 'Ramp*Elevator'),
('forSale', 900000, 'Nairobi, Kenya', 200, 2, 'living-room.jpg*user.png', 32, 'Swimming pool', 3, 0, '', 'Move-in ready', 0, 'Parking space*Playground', 'Ramp*Single storey building'),
('forSale', 10000, 'worldwide', 200, 1, 'living-room.jpg*user.png', 33, 'Swimming pool', 3, 0, '', 'fixer upper', 0, 'High speed internet', 'ramp*elevator'),
('forSale', 1000000, 'Muthaiga', 700, 2, 'living-room.jpg*user.png*user.png', 34, 'Pets allowed', 3, 0, '', 'Move-in ready', 0, 'High speed internet', 'Elevator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creditpasses`
--
ALTER TABLE `creditpasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creditpasses`
--
ALTER TABLE `creditpasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
