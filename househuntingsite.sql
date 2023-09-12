-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 04:52 AM
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
-- Table structure for table `admin_receipient`
--

CREATE TABLE `admin_receipient` (
  `lastReceipient` varchar(20) NOT NULL,
  `senderID` int(11) NOT NULL,
  `TIME` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_receipient`
--

INSERT INTO `admin_receipient` (`lastReceipient`, `senderID`, `TIME`, `id`) VALUES
('hhs1@admin.com', 26, 2023, 540),
('hhs2@admin.com', 28, 2023, 541),
('hhs@admin.com', 26, 2023, 542),
('hhs1@admin.com', 28, 2023, 543),
('hhs2@admin.com', 23, 2023, 544),
('hhs@admin.com', 43, 2023, 545);

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
(16, 3, '2023-05-25 01:12:00', 1, '2023-05-26 02:02:17am', 19),
(27, 3, '2023-06-08 04:37:56', 1, '2023-06-08 05:57:58pm', 20),
(26, 3, '2023-06-08 05:22:19', 1, '2023-06-08 05:58:14pm', 21);

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
('184578934', 50, 1, '2023-05-25 01:11:57am', 3),
('', 50, 1, '2023-06-08 04:37:56pm', 3),
('', 50, 1, '2023-06-17 12:58:01pm', 27),
('', 50, 1, '2023-06-17 02:07:35pm', 3),
('', 50, 1, '2023-06-17 02:08:44pm', 3),
('', 100, 2, '2023-06-17 02:24:55pm', 28),
('878797', 100, 2, '2023-06-28 05:16:09pm', 29),
('', 100, 2, '2023-07-31 11:14:07pm', 30),
('', 100, 2, '2023-07-31 11:15:29pm', 30),
('', 25452, 509, '2023-08-05 11:30:51pm', 39),
('', 100, 2, '2023-08-05 11:47:25pm', 39),
('0789898989', 100, 2, '2023-08-25 03:55:02pm', 41),
('980998098', 700, 14, '2023-09-12 01:44:49am', 43);

-- --------------------------------------------------------

--
-- Table structure for table `forum_answers`
--

CREATE TABLE `forum_answers` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_text` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_answers`
--

INSERT INTO `forum_answers` (`answer_id`, `question_id`, `answer_text`) VALUES
(1, 1, 'Create a new account as a new user and indicate that you are showing houses. Click on the link on your profile page to upload a new listing and fill in the following form appropriately.'),
(2, 2, 'When interacting with a listing by hitting the like button or ... indicating more you will be redirected to details of that specific listing. \r\nYou will then be able to chat with our staff once you top up on your credits. \r\nFeel free to ask any questions on the listing you liked. \r\nThank you for choosing us! We are here for you in your house hunting journey.'),
(3, 4, 'Go to your profile through the menu by clicking on the menu bar on any page\'s top right corner. \r\nThen click on the settings icon on your profile page and proceed to click \"delete account\" and confirm your choice.\r\nThank you for choosing us! You\'re welcome back at any time.'),
(4, 3, 'Yes, click on view on the green button at the top of your profile page and your ready to go!');

-- --------------------------------------------------------

--
-- Table structure for table `forum_questions`
--

CREATE TABLE `forum_questions` (
  `question_id` int(11) NOT NULL,
  `question_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_questions`
--

INSERT INTO `forum_questions` (`question_id`, `question_text`) VALUES
(1, 'How do I upload a new listing?'),
(2, 'How do I get more information about a listing?'),
(3, 'Can I use the same account from which I upload listings to check out other listings?'),
(4, 'How do I delete my account?');

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
(154, 'asnfjah', 3, 23, '2023-06-13 04:23:18pm', 33),
(155, 'DJSFHAJKSDH', 3, 23, '2023-06-13 04:34:34pm', 33),
(156, 'slkfngkslfjg', 3, 23, '2023-06-13 04:39:58pm', 33),
(157, 'JKDFhfkadjgkahfbgkhabdgjkdhfbvjiehrufgierhfjdnvkjasbdkjabsdfjkadhfjadhijvadhnvjadkhfvjakdhfjakdfhakjdhakjdfnakjdnvkajdnvkjsdfnvkjdfnsjkdfnvksjdfvnskdjfvnkdsnvskdjfvnsdkjfvnsdkjfvnsdfkjvnsdjkfvhsndjfkghkjdfkghsdfjksfjgdshf', 3, 23, '2023-06-13 04:40:19pm', 33),
(158, 'JKDFhfkadjgkahfbgkhabdgjkdhfbvjiehrufgierhfjdnvkjasbdkjabsdfjkadhfjadhijvadhnvjadkhfvjakdhfjakdfhakjdhakjdfnakjdnvkajdnvkjsdfnvkjdfnsjkdfnvksjdfvnskdjfvnkdsnvskdjfvnsdkjfvnsdkjfvnsdfkjvnsdjkfvhsndjfkghkjdfkghsdfjksfjgdshf', 3, 23, '2023-06-13 04:40:20pm', 33),
(159, 'kjfhadiusfhjsdh  ahdfjasdnfjsldhfsdjlfasdklfasldkfjasdklfjasdlfasdfhaskjdfhajdfadfh adfjasldf', 3, 23, '2023-06-13 04:44:06pm', 33),
(160, 'nbknbjknjdfjaksdhfjksdfhjasdhfajkdshfjasdfhsdjkfhasdkjfashdfjasdfhakjsdfhaksjdfhsdjkashdshfjaskdfhasjkdfhasdjfaskdfhasdjfkasdfkaskdfhasdkjfashdkfjadshkajsdfhasjkdfhasdkjfashdkfashfkjdshfjsdkfhajskdfhsdkjfafksdfhsdkjfh', 3, 23, '2023-06-13 04:46:07pm', 33),
(161, 'CKSHDKFHS', 3, 0, '2023-06-13 05:13:53pm', 33),
(162, 'jsdfhakjsdhf', 23, 0, '2023-06-13 11:19:54pm', 33),
(163, 'kslajlafkljadkf', 23, 0, '2023-06-13 11:20:29pm', 33),
(164, 'mdsfhjkdshfkj', 23, 0, '2023-06-13 11:22:19pm', 33),
(165, 'sdjahfkjdsh', 23, 0, '2023-06-13 11:23:05pm', 33),
(166, 'djsfhkasjdhfjkasdhf', 23, 0, '2023-06-13 11:28:40pm', 33),
(167, 'sdhgjkashdfasdhfkj', 23, 0, '2023-06-13 11:29:44pm', 33),
(168, 'dsfhkjsdf', 23, 0, '2023-06-13 11:30:05pm', 33),
(169, 'dsfhkjsdf', 23, 3, '2023-06-13 11:30:29pm', 33),
(170, 'jDHFsj', 23, 3, '2023-06-13 11:30:38pm', 33),
(171, 'jkDHFjkshfj', 23, 3, '2023-06-13 11:34:10pm', 33),
(172, 'jhjlllllhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhk', 23, 3, '2023-06-14 12:40:09pm', 33),
(173, 'bshdgasjkgdjas', 23, 3, '2023-06-14 12:41:02pm', 33),
(174, 'jkdfhsdkjf', 23, 3, '2023-06-14 12:41:18pm', 33),
(175, 'sjdfhksjdhf', 23, 3, '2023-06-14 12:46:37pm', 33),
(176, 'jshjvdfhfjasd', 23, 3, '2023-06-14 12:47:53pm', 33),
(177, 'asjhgjdhsfds', 23, 3, '2023-06-14 12:49:07pm', 33),
(178, 'DKFshdkfj', 23, 3, '2023-06-14 12:55:26pm', 33),
(179, 'HJdskfhs', 3, 0, '2023-06-14 01:13:38pm', 33),
(193, 'JhsJKHDSJFHSDF', 1, 23, '2023-06-14 02:34:02pm', 0),
(194, 'dsjhfadsjkdfh', 24, 23, '2023-06-15 07:05:45pm', 0),
(195, 'dsjhfadsjkdfh', 24, 23, '2023-06-15 07:06:50pm', 0),
(196, 'sdfadf\r\n', 26, 23, '2023-06-16 06:20:46pm', 0),
(197, 'SKSJDFHKDSJ', 26, 23, '2023-06-16 06:33:43pm', 0),
(198, 'adshfkahsdfj', 26, 23, '2023-06-16 06:36:24pm', 0),
(199, 'Hi where exactly is this house?\r\n', 27, 23, '2023-06-17 12:28:49pm', 0),
(200, 'What about this house', 27, 23, '2023-06-17 12:45:21pm', 0),
(201, 'Hm?', 27, 23, '2023-06-17 12:58:39pm', 0),
(202, 'DJHjd', 27, 23, '2023-06-17 01:02:41pm', 0),
(203, 'kghhj', 27, 23, '2023-06-17 01:21:22pm', 26),
(204, 'hkj', 3, 23, '2023-06-17 02:08:56pm', 31),
(205, 'Hello, how can we help you?', 23, 28, '', 0),
(206, 'iko wapi exactly', 28, 23, '2023-06-17 02:25:14pm', 28),
(207, 'm nb,n', 0, 23, '2023-06-27 04:04:58pm', 26),
(208, 'jhfjHWF', 3, 23, '2023-06-28 04:13:12pm', 31),
(209, 'khhkj\r\n', 29, 0, '2023-06-28 05:07:29pm', 0),
(210, 'Hello, how can we help you?', 23, 29, '', 0),
(211, 'jdhcjkdshf', 29, 23, '2023-06-28 05:16:30pm', 26),
(216, 'dasdf\r\n', 30, 23, '2023-07-31 11:18:14pm', 27),
(217, '', 30, 23, '2023-07-31 11:18:16pm', 27),
(218, 'sdfjdfjld', 30, 23, '2023-07-31 11:36:24pm', 27),
(219, 'mhjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjk', 30, 23, '2023-07-31 11:37:09pm', 27),
(220, 'sdfsdhkfasjkdfjsdhf\r\n', 3, 23, '2023-08-03 05:28:49pm', 27),
(221, 'djhsdfhds\r\n', 3, 23, '2023-08-03 05:29:25pm', 27),
(222, 'hdfjashdjkf\r\n', 3, 23, '2023-08-03 05:42:27pm', 27),
(223, 'sdfhdgsj\r\n', 3, 23, '2023-08-03 05:52:23pm', 27),
(224, 'sdhfkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 3, 23, '2023-08-03 05:52:57pm', 27),
(225, 'Hello, how can we help you?', 23, 33, '', 0),
(226, 'Hello, how can we help you?', 23, 38, '', 0),
(227, 'JSDFHKSHDFDHJF\r\n', 38, 23, '2023-08-05 11:03:47pm', 0),
(228, 'dhhdfjashdfjahsdjf\r\n', 38, 23, '2023-08-05 11:15:49pm', 2),
(229, 'gdfgjfdgh\r\n', 38, 23, '2023-08-05 11:18:36pm', 2),
(230, 'Hello, how can we help you?', 23, 39, '2023-08-05 11:24:44pm', 0),
(231, 'FJHSGKH', 39, 23, '2023-08-05 11:25:32pm', 0),
(232, 'BFFDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDZ', 39, 23, '2023-08-05 11:26:09pm', 0),
(233, 'sdfjghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhkj\r\n', 39, 23, '2023-08-05 11:47:46pm', 26),
(234, 'jsdhfkhdsf\r\n', 39, 23, '2023-08-08 12:16:30pm', 28),
(235, 'Hello, how can we help you?', 23, 41, '2023-08-25 03:50:03pm', 0),
(236, 'Hi, I am looking for a house, how can I get its exact location?\r\n', 41, 23, '2023-08-25 03:50:52pm', 29),
(237, 'Hello, how can we help you?', 23, 42, '2023-08-25 04:20:21pm', 0),
(238, 'hI \r\n\r\n', 41, 23, '2023-08-28 02:47:30pm', 38),
(239, 'Hello, how can we help you?', 23, 23, '2023-08-28 02:55:48pm', 0),
(240, 'Hello, how can we help you?', 22, 41, '2023-08-28 03:04:56pm', 0),
(241, 'Hekllo\r\n', 41, 22, '2023-08-28 03:05:09pm', 0),
(242, 'Hello, how can we help you?', 22, 26, '2023-08-28 03:07:45pm', 0),
(243, 'Hello\r\n', 28, 23, '2023-08-28 03:10:30pm', 0),
(244, 'Hello, how can we help you?', 21, 26, '2023-08-28 03:11:15pm', 0),
(245, 'dafs\r\n', 26, 21, '2023-08-28 03:11:23pm', 0),
(246, 'Hello, how can we help you?', 22, 28, '2023-08-28 03:12:24pm', 0),
(247, 'HI\r\n', 28, 22, '2023-08-28 03:12:50pm', 0),
(248, 'Hello, how can we help you?', 21, 43, '2023-09-12 01:44:08am', 0);

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
(3, 'Fredrick Kamau', 'fredric.ngugi@yahoo.com', 'fred234', 'showing', '2023-06-17 11:08:44', 0x6f6666696369616c2070617373706f7274207069632e6a7067, '0724175469', 0, 1),
(13, 'person person', 'person@person.com', 'person123', '', '2023-06-08 12:10:05', '', '', 0, 0),
(15, 'name', 'name@name.com', 'name124', 'showing', '2023-06-08 12:12:24', '', '', 0, 0),
(16, 'name', 'name1@name.com', 'name123', 'looking', '2023-06-08 12:12:51', '', '', 0, 0),
(17, 'fjfh', 'mail@mail.com', 'mail123', 'looking', '2023-06-08 12:13:55', '', '', 0, 0),
(18, 'random', 'random', 'random', '', '2023-06-08 12:14:35', '', '', 0, 0),
(19, 'random', 'randommm', 'random', 'showing', '2023-06-08 12:14:47', '', '', 0, 0),
(20, 'random', 'randomm', 'random', 'showing', '2023-06-08 12:20:11', '', '', 0, 0),
(21, 'hhs admin', 'hhs@admin.com', 'hhsadmin1', 'showing', '2023-06-09 14:27:06', '', '', 0, 0),
(22, 'hhs admin', 'hhs1@admin.com', 'hhs123', 'showing', '2023-06-13 12:18:15', '', '', 0, 0),
(23, 'hhs admin', 'hhs2@admin.com', 'hhs123', 'showing', '2023-06-13 12:20:26', '', '', 0, 0),
(24, 'rand', 'rand@rand.com', 'rand123', 'looking', '2023-06-15 15:27:11', '', '', 0, 0),
(25, 'mindy', 'mindy@user.com', 'mindy123', '', '2023-06-16 09:17:33', '', '', 0, 0),
(26, 'andy', 'andy@user.com', 'andy123', 'looking', '2023-06-16 09:18:40', '', '', 0, 0),
(27, 'brandy', 'brandy@gorgeous.com', 'brandy123', 'looking', '2023-06-17 09:58:01', '', '', 0, 1),
(28, 'user', 'user@user1.com', 'user234', 'looking', '2023-06-17 11:33:34', '', '', 0, 2),
(29, 'tester', 'tester@test.com', 'tester123', 'looking', '2023-06-28 14:16:10', '', '', 0, 2),
(30, 'user', 'testing@user.com', 'testing@User12', 'looking', '2023-07-31 20:46:38', 0x696d6731332e6a7067, '', 0, 4),
(31, 'Jane doe', 'janedoe123@gmail.com', 'janeDoe12#', 'looking', '2023-08-03 14:58:57', '', '', 0, 0),
(36, 'jAjkds', 'sdfhsdfj', 'sdjfskdf', 'showing', '2023-08-03 15:13:45', '', '', 0, 0),
(37, 'JDfhjdsfhk', 'dhfds', 'shd675%SHGD', 'showing', '2023-08-03 15:17:45', '', '', 0, 0),
(39, 'uploaderr', 'uploaderr@user.com', 'uPLOADER123%', 'showing', '2023-08-05 20:47:26', '', '', 0, 2),
(41, 'testing user', 'testing@user2.com', 'Testinguser123#', 'looking', '2023-08-25 12:55:04', '', '', 0, 2),
(42, 'testing uploader', 'testing@uploader.com', 'Testinguploader123#', 'showing', '2023-08-25 13:14:10', '', '', 0, 0),
(43, 'final tester', 'final@tester.com', 'Finaltester123!', 'looking', '2023-09-11 22:44:49', '', '', 0, 14);

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
('forSale', 30000, 'Nairobi, Kenya', 500, 2, 'living-room.jpg', 26, 'Pets allowed', 3, 2, '*28*26', 'Move-in ready', 1, 'Running water*Storage area*High speed internet', 'Single storey building'),
('rental', 30000, 'Muthaiga', 700, 2, 'living-room.jpg', 37, 'pets allowed', 42, 3, '*42*26*43', 'move-in ready', 0, 'Running water*Gym', 'ramp*elevator'),
('forSale', 30000, 'Nairobi, Kenya', 500, 2, 'living-room.jpg', 38, 'Pets allowed', 0, 1, '*28', 'Move-in ready', 1, 'Running water*Storage area*High speed internet', 'Single storey building');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_receipient`
--
ALTER TABLE `admin_receipient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditpasses`
--
ALTER TABLE `creditpasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_answers`
--
ALTER TABLE `forum_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `forum_questions`
--
ALTER TABLE `forum_questions`
  ADD PRIMARY KEY (`question_id`);

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
-- AUTO_INCREMENT for table `admin_receipient`
--
ALTER TABLE `admin_receipient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=546;

--
-- AUTO_INCREMENT for table `creditpasses`
--
ALTER TABLE `creditpasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `forum_answers`
--
ALTER TABLE `forum_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forum_questions`
--
ALTER TABLE `forum_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forum_answers`
--
ALTER TABLE `forum_answers`
  ADD CONSTRAINT `forum_answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `forum_questions` (`question_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
