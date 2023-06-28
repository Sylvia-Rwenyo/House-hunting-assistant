-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2023 at 05:26 PM
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
  `lastReceipientID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `TIME` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_receipient`
--

INSERT INTO `admin_receipient` (`lastReceipientID`, `senderID`, `TIME`, `id`) VALUES
(0, 0, 2023, 1),
(0, 0, 2023, 2),
(0, 0, 2023, 3),
(0, 0, 2023, 4),
(0, 0, 2023, 5),
(0, 0, 2023, 6),
(0, 0, 2023, 7),
(0, 0, 2023, 8),
(0, 0, 2023, 9),
(0, 0, 2023, 10),
(0, 0, 2023, 11),
(0, 0, 2023, 12),
(0, 0, 2023, 13),
(0, 0, 2023, 14),
(0, 0, 2023, 15),
(0, 0, 2023, 16),
(0, 0, 2023, 17),
(0, 0, 2023, 18),
(0, 0, 2023, 19),
(0, 0, 2023, 20),
(0, 0, 2023, 21),
(0, 0, 2023, 22),
(0, 0, 2023, 23),
(0, 0, 2023, 24),
(0, 0, 2023, 25),
(0, 0, 2023, 26),
(0, 0, 2023, 27),
(0, 0, 2023, 28),
(0, 0, 2023, 29),
(0, 0, 2023, 30),
(0, 0, 2023, 31),
(0, 0, 2023, 32),
(0, 0, 2023, 33),
(0, 0, 2023, 34),
(0, 0, 2023, 35),
(0, 0, 2023, 36),
(0, 0, 2023, 37),
(0, 0, 2023, 38),
(0, 0, 2023, 39),
(0, 0, 2023, 40),
(0, 0, 2023, 41),
(0, 0, 2023, 42),
(0, 0, 2023, 43),
(0, 0, 2023, 44),
(0, 0, 2023, 45),
(0, 0, 2023, 46),
(0, 0, 2023, 47),
(0, 0, 2023, 48),
(0, 0, 2023, 49),
(0, 0, 2023, 50),
(0, 0, 2023, 51),
(0, 0, 2023, 52),
(0, 0, 2023, 53),
(0, 0, 2023, 54),
(0, 0, 2023, 55),
(0, 0, 2023, 56),
(0, 0, 2023, 57),
(0, 0, 2023, 58),
(0, 0, 2023, 59),
(0, 0, 2023, 60),
(0, 0, 2023, 61),
(0, 0, 2023, 62),
(0, 0, 2023, 63),
(0, 0, 2023, 64),
(0, 0, 2023, 65),
(0, 0, 2023, 66),
(0, 0, 2023, 67),
(0, 0, 2023, 68),
(0, 0, 2023, 69),
(0, 0, 2023, 70),
(0, 0, 2023, 71),
(0, 0, 2023, 72),
(0, 0, 2023, 73),
(0, 0, 2023, 74),
(0, 0, 2023, 75),
(0, 0, 2023, 76),
(0, 0, 2023, 77),
(0, 0, 2023, 78),
(0, 0, 2023, 79),
(0, 0, 2023, 80),
(0, 0, 2023, 81),
(0, 0, 2023, 82),
(0, 0, 2023, 83),
(0, 0, 2023, 84),
(0, 0, 2023, 85),
(0, 0, 2023, 86),
(0, 0, 2023, 87),
(0, 0, 2023, 88),
(0, 0, 2023, 89),
(0, 0, 2023, 90),
(0, 0, 2023, 91),
(0, 0, 2023, 92),
(0, 0, 2023, 93),
(0, 0, 2023, 94),
(0, 0, 2023, 95),
(0, 0, 2023, 96),
(0, 0, 2023, 97),
(0, 0, 2023, 98),
(0, 0, 2023, 99),
(0, 0, 2023, 100),
(0, 0, 2023, 101),
(0, 0, 2023, 102),
(0, 0, 2023, 103),
(0, 0, 2023, 104),
(0, 0, 2023, 105),
(0, 0, 2023, 106),
(0, 0, 2023, 107),
(0, 0, 2023, 108),
(0, 0, 2023, 109),
(0, 0, 2023, 110),
(0, 0, 2023, 111),
(0, 0, 2023, 112),
(0, 0, 2023, 113),
(0, 0, 2023, 114),
(0, 0, 2023, 115),
(0, 0, 2023, 116),
(0, 0, 2023, 117),
(0, 0, 2023, 118),
(0, 0, 2023, 119),
(0, 0, 2023, 120),
(0, 0, 2023, 121),
(0, 0, 2023, 122),
(0, 0, 2023, 123),
(0, 0, 2023, 124),
(0, 0, 2023, 125),
(0, 0, 2023, 126),
(0, 0, 2023, 127),
(0, 0, 2023, 128),
(0, 0, 2023, 129),
(0, 0, 2023, 130),
(0, 0, 2023, 131),
(0, 0, 2023, 132),
(0, 0, 2023, 133),
(0, 0, 2023, 134),
(0, 0, 2023, 135),
(0, 0, 2023, 136),
(0, 0, 2023, 137),
(0, 0, 2023, 138),
(0, 0, 2023, 139),
(0, 0, 2023, 140),
(0, 0, 2023, 141),
(0, 0, 2023, 142),
(0, 0, 2023, 143),
(0, 0, 2023, 144),
(0, 0, 2023, 145),
(0, 0, 2023, 146),
(0, 0, 2023, 147),
(0, 0, 2023, 148),
(0, 0, 2023, 149),
(0, 0, 2023, 150),
(0, 0, 2023, 151),
(0, 0, 2023, 152),
(0, 0, 2023, 153),
(0, 0, 2023, 154),
(0, 0, 2023, 155),
(0, 0, 2023, 156),
(0, 0, 2023, 157),
(0, 0, 2023, 158),
(0, 0, 2023, 159),
(0, 0, 2023, 160),
(0, 0, 2023, 161),
(0, 0, 2023, 162),
(0, 0, 2023, 163),
(0, 0, 2023, 164),
(0, 0, 2023, 165),
(0, 0, 2023, 166),
(0, 0, 2023, 167),
(0, 0, 2023, 168),
(0, 0, 2023, 169),
(0, 0, 2023, 170),
(0, 0, 2023, 171),
(0, 0, 2023, 172),
(0, 0, 2023, 173),
(0, 0, 2023, 174),
(0, 0, 2023, 175),
(0, 0, 2023, 176),
(0, 0, 2023, 177),
(0, 0, 2023, 178),
(0, 0, 2023, 179),
(0, 0, 2023, 180),
(0, 0, 2023, 181),
(0, 0, 2023, 182),
(0, 0, 2023, 183),
(0, 0, 2023, 184),
(0, 0, 2023, 185),
(0, 0, 2023, 186),
(0, 0, 2023, 187),
(0, 0, 2023, 188),
(0, 0, 2023, 189),
(0, 0, 2023, 190),
(0, 0, 2023, 191),
(0, 0, 2023, 192),
(0, 0, 2023, 193),
(0, 0, 2023, 194),
(0, 0, 2023, 195),
(0, 0, 2023, 196),
(0, 0, 2023, 197),
(0, 0, 2023, 198),
(0, 0, 2023, 199),
(0, 0, 2023, 200),
(0, 0, 2023, 201),
(0, 0, 2023, 202),
(0, 0, 2023, 203),
(0, 0, 2023, 204),
(0, 0, 2023, 205),
(0, 0, 2023, 206),
(0, 0, 2023, 207),
(0, 0, 2023, 208),
(0, 0, 2023, 209),
(0, 0, 2023, 210),
(0, 0, 2023, 211),
(0, 0, 2023, 212),
(0, 0, 2023, 213),
(0, 0, 2023, 214),
(0, 0, 2023, 215),
(0, 0, 2023, 216),
(0, 0, 2023, 217),
(0, 0, 2023, 218),
(0, 0, 2023, 219),
(0, 0, 2023, 220),
(0, 0, 2023, 221),
(0, 0, 2023, 222),
(0, 0, 2023, 223),
(0, 0, 2023, 224),
(0, 0, 2023, 225),
(0, 0, 2023, 226),
(0, 0, 2023, 227),
(0, 0, 2023, 228),
(0, 0, 2023, 229),
(0, 0, 2023, 230),
(0, 0, 2023, 231),
(0, 0, 2023, 232),
(0, 0, 2023, 233),
(0, 0, 2023, 234),
(0, 0, 2023, 235),
(0, 0, 2023, 236),
(0, 0, 2023, 237),
(0, 0, 2023, 238),
(0, 0, 2023, 239),
(0, 0, 2023, 240),
(0, 0, 2023, 241),
(0, 0, 2023, 242),
(0, 0, 2023, 243),
(0, 0, 2023, 244),
(0, 0, 2023, 245),
(0, 0, 2023, 246),
(0, 0, 2023, 247),
(0, 0, 2023, 248),
(0, 0, 2023, 249),
(0, 0, 2023, 250),
(0, 0, 2023, 251),
(0, 0, 2023, 252),
(0, 0, 2023, 253),
(0, 0, 2023, 254),
(0, 0, 2023, 255),
(0, 0, 2023, 256),
(0, 0, 2023, 257),
(0, 0, 2023, 258),
(0, 0, 2023, 259),
(0, 0, 2023, 260),
(0, 0, 2023, 261),
(0, 0, 2023, 262),
(0, 0, 2023, 263),
(0, 0, 2023, 264),
(0, 0, 2023, 265),
(0, 0, 2023, 266),
(0, 0, 2023, 267),
(0, 0, 2023, 268),
(0, 0, 2023, 269),
(0, 0, 2023, 270),
(0, 0, 2023, 271),
(0, 0, 2023, 272),
(0, 0, 2023, 273),
(0, 0, 2023, 274),
(0, 0, 2023, 275),
(0, 0, 2023, 276),
(0, 0, 2023, 277),
(0, 0, 2023, 278),
(0, 0, 2023, 279),
(0, 0, 2023, 280),
(0, 0, 2023, 281),
(0, 0, 2023, 282),
(0, 0, 2023, 283),
(0, 0, 2023, 284),
(0, 0, 2023, 285),
(0, 0, 2023, 286),
(0, 0, 2023, 287),
(0, 0, 2023, 288),
(0, 0, 2023, 289),
(0, 0, 2023, 290),
(0, 0, 2023, 291),
(0, 0, 2023, 292),
(0, 0, 2023, 293),
(0, 0, 2023, 294),
(0, 0, 2023, 295),
(0, 0, 2023, 296),
(0, 0, 2023, 297),
(0, 0, 2023, 298),
(0, 0, 2023, 299),
(0, 0, 2023, 300),
(0, 0, 2023, 301),
(0, 0, 2023, 302),
(0, 0, 2023, 303),
(0, 0, 2023, 304),
(0, 0, 2023, 305),
(0, 0, 2023, 306),
(0, 0, 2023, 307),
(0, 0, 2023, 308),
(0, 0, 2023, 309),
(0, 0, 2023, 310),
(0, 0, 2023, 311),
(0, 0, 2023, 312),
(0, 0, 2023, 313),
(0, 0, 2023, 314),
(0, 0, 2023, 315),
(0, 0, 2023, 316),
(0, 0, 2023, 317),
(0, 0, 2023, 318),
(0, 0, 2023, 319),
(0, 0, 2023, 320),
(0, 0, 2023, 321),
(0, 0, 2023, 322),
(0, 0, 2023, 323),
(0, 0, 2023, 324),
(0, 0, 2023, 325),
(0, 0, 2023, 326),
(0, 0, 2023, 327),
(0, 0, 2023, 328),
(0, 0, 2023, 329),
(0, 0, 2023, 330),
(0, 0, 2023, 331),
(0, 0, 2023, 332),
(0, 0, 2023, 333),
(0, 0, 2023, 334),
(0, 0, 2023, 335),
(0, 0, 2023, 336),
(0, 0, 2023, 337),
(0, 0, 2023, 338),
(0, 0, 2023, 339),
(0, 0, 2023, 340),
(0, 0, 2023, 341),
(0, 0, 2023, 342),
(0, 0, 2023, 343),
(0, 0, 2023, 344),
(0, 0, 2023, 345),
(0, 0, 2023, 346),
(0, 0, 2023, 347),
(0, 0, 2023, 348),
(0, 0, 2023, 349),
(0, 0, 2023, 350),
(0, 0, 2023, 351),
(0, 0, 2023, 352),
(0, 0, 2023, 353),
(0, 0, 2023, 354),
(0, 0, 2023, 355),
(0, 0, 2023, 356),
(0, 0, 2023, 357),
(0, 0, 2023, 358),
(0, 0, 2023, 359),
(0, 0, 2023, 360),
(0, 0, 2023, 361),
(0, 0, 2023, 362),
(0, 0, 2023, 363),
(0, 0, 2023, 364),
(0, 0, 2023, 365),
(0, 0, 2023, 366),
(0, 0, 2023, 367),
(0, 0, 2023, 368),
(0, 0, 2023, 369),
(0, 0, 2023, 370),
(0, 0, 2023, 371),
(0, 0, 2023, 372),
(0, 0, 2023, 373),
(0, 0, 2023, 374),
(0, 0, 2023, 375),
(0, 0, 2023, 376),
(0, 0, 2023, 377),
(0, 0, 2023, 378),
(0, 0, 2023, 379),
(0, 0, 2023, 380),
(0, 0, 2023, 381),
(0, 0, 2023, 382),
(0, 0, 2023, 383),
(0, 0, 2023, 384),
(0, 0, 2023, 385),
(0, 0, 2023, 386),
(0, 0, 2023, 387),
(0, 0, 2023, 388),
(0, 0, 2023, 389),
(0, 0, 2023, 390),
(0, 0, 2023, 391),
(0, 0, 2023, 392),
(0, 0, 2023, 393),
(0, 0, 2023, 394),
(0, 0, 2023, 395),
(0, 0, 2023, 396),
(0, 0, 2023, 397),
(0, 0, 2023, 398),
(0, 0, 2023, 399),
(0, 0, 2023, 400),
(0, 0, 2023, 401),
(0, 0, 2023, 402),
(0, 0, 2023, 403),
(0, 0, 2023, 404),
(0, 0, 2023, 405),
(0, 0, 2023, 406),
(0, 0, 2023, 407),
(0, 0, 2023, 408),
(0, 0, 2023, 409),
(0, 0, 2023, 410),
(0, 0, 2023, 411),
(0, 0, 2023, 412),
(0, 0, 2023, 413),
(0, 0, 2023, 414),
(0, 0, 2023, 415),
(0, 0, 2023, 416),
(0, 0, 2023, 417),
(0, 0, 2023, 418),
(0, 0, 2023, 419),
(0, 0, 2023, 420),
(0, 0, 2023, 421),
(0, 0, 2023, 422),
(0, 0, 2023, 423),
(0, 0, 2023, 424),
(0, 0, 2023, 425),
(0, 0, 2023, 426),
(0, 0, 2023, 427),
(0, 0, 2023, 428),
(0, 0, 2023, 429),
(0, 0, 2023, 430),
(0, 0, 2023, 431),
(0, 0, 2023, 432),
(0, 0, 2023, 433),
(0, 0, 2023, 434),
(0, 0, 2023, 435),
(0, 0, 2023, 436),
(0, 0, 2023, 437),
(0, 0, 2023, 438),
(0, 0, 2023, 439),
(0, 0, 2023, 440),
(0, 0, 2023, 441),
(0, 0, 2023, 442),
(0, 0, 2023, 443),
(0, 0, 2023, 444),
(0, 0, 2023, 445),
(0, 0, 2023, 446),
(0, 0, 2023, 447),
(0, 0, 2023, 448),
(0, 0, 2023, 449),
(0, 0, 2023, 450),
(0, 0, 2023, 451),
(0, 0, 2023, 452),
(0, 0, 2023, 453),
(0, 0, 2023, 454),
(0, 0, 2023, 455),
(0, 0, 2023, 456),
(0, 0, 2023, 457),
(0, 0, 2023, 458),
(0, 0, 2023, 459),
(0, 0, 2023, 460),
(0, 0, 2023, 461),
(0, 0, 2023, 462),
(0, 0, 2023, 463),
(0, 0, 2023, 464),
(0, 0, 2023, 465),
(0, 0, 2023, 466),
(0, 0, 2023, 467),
(0, 0, 2023, 468),
(0, 0, 2023, 469),
(0, 0, 2023, 470),
(0, 0, 2023, 471),
(0, 0, 2023, 472),
(0, 0, 2023, 473),
(0, 0, 2023, 474),
(0, 0, 2023, 475),
(0, 0, 2023, 476),
(0, 0, 2023, 477),
(0, 0, 2023, 478),
(0, 0, 2023, 479),
(0, 0, 2023, 480),
(0, 0, 2023, 481),
(0, 0, 2023, 482),
(0, 0, 2023, 483),
(0, 0, 2023, 484),
(0, 0, 2023, 485),
(0, 0, 2023, 486),
(0, 0, 2023, 487),
(0, 0, 2023, 488),
(0, 0, 2023, 489),
(0, 3, 2023, 490),
(0, 3, 2023, 491),
(0, 3, 2023, 492),
(0, 3, 2023, 493),
(0, 21, 2023, 494),
(0, 21, 2023, 495),
(0, 3, 2023, 496),
(0, 23, 2023, 497),
(0, 23, 2023, 498),
(0, 23, 2023, 499),
(0, 23, 2023, 500),
(0, 23, 2023, 501),
(0, 23, 2023, 502),
(0, 23, 2023, 503),
(0, 23, 2023, 504),
(0, 3, 2023, 505),
(0, 1, 2023, 506),
(0, 1, 2023, 507),
(0, 0, 2023, 508),
(0, 0, 2023, 509),
(0, 0, 2023, 510),
(0, 0, 2023, 511),
(0, 0, 2023, 512),
(0, 1, 2023, 513),
(0, 1, 2023, 514),
(0, 1, 2023, 515),
(23, 1, 2023, 516),
(23, 1, 2023, 517),
(0, 24, 2023, 518),
(0, 24, 2023, 519),
(0, 24, 2023, 520),
(0, 26, 2023, 521),
(0, 26, 2023, 522),
(0, 3, 2023, 523),
(0, 28, 2023, 524),
(0, 6, 2023, 525),
(0, 27, 2023, 526),
(0, 3, 2023, 527),
(0, 3, 2023, 528),
(0, 29, 2023, 529);

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
('878797', 100, 2, '2023-06-28 05:16:09pm', 29);

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
(211, 'jdhcjkdshf', 29, 23, '2023-06-28 05:16:30pm', 26);

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
(29, 'tester', 'tester@test.com', 'tester123', 'looking', '2023-06-28 14:16:10', '', '', 0, 2);

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
('forSale', 30000, 'Nairobi, Kenya', 500, 2, 'living-room.jpg', 26, 'Pets allowed', 3, 5, '', 'Move-in ready', 1, 'Running water*Storage area*High speed internet', 'Single storey building'),
('forSale', 1000000, 'Muthaiga', 400, 2, 'living-room.jpg*user.png*living-room.jpg', 27, 'pets allowed', 3, 0, '', 'move-in ready', 0, 'Gym', 'ramp'),
('forSale', 7000, 'dahfkjad', 90, 1, 'living-room.jpg*user.png', 28, 'pets allowed', 3, 1, '*3', 'fixer upper', 0, 'Storage area', 'ramp'),
('forSale', 1000000, 'home', 400, 2, 'living-room.jpg*user.png', 29, 'Furnished', 3, 1, '*27', 'Move-in ready', 1, 'Storage area*High speed internet', 'Single storey building'),
('forSale', 6000000, 'Muthaiga', 1200, 2, 'living-room.jpg*living-room.jpg*user.png', 31, 'Swimming pool*Pets allowed', 3, 1, '', 'Move-in ready', 1, 'Parking space*Playground', 'Ramp*Elevator'),
('forSale', 10000, 'worldwide', 200, 1, 'living-room.jpg*user.png', 33, 'Swimming pool', 3, 0, '*27', 'fixer upper', 0, 'High speed internet', 'ramp*elevator');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530;

--
-- AUTO_INCREMENT for table `creditpasses`
--
ALTER TABLE `creditpasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;