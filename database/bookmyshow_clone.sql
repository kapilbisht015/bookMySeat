-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2025 at 04:23 AM
-- Server version: 9.1.0
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookmyshow_clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `event_id` int DEFAULT NULL,
  `ticket_no` varchar(50) DEFAULT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'success',
  `booked_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `movie_id` int DEFAULT NULL,
  `sports_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `event_id`, `ticket_no`, `payment_id`, `amount`, `status`, `booked_at`, `movie_id`, `sports_id`) VALUES
(19, 1, 3, 'TKT68D151EC47984', 'pay_RKfRel9lmcXI3m', '350.00', 'success', '2025-09-22 13:41:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `event_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `event_id`, `created_at`) VALUES
(3, 'Kapil Bisht', 'kapil.nsic07@gmail.com', 'hi', NULL, '2025-09-22 15:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `details` text,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `category`, `date`, `city`, `details`, `image`, `price`) VALUES
(1, 'Papa Yaar by Zakir Khan - Delhi ', 'Comedy Shows', '2025-11-01', 'Delhi', 'Indira Gandhi Indoor Stadium: New Delhi', 'comedy1.jpg', '999.00'),
(2, 'Kumar Sanu Live in Concert- Delhi', 'Music Shows', '2026-01-10', 'Delhi', 'Plenary Hall Bharat Mandapam: Delhi', 'music.jpg', '2899.00'),
(3, 'Samay Raina - Still Alive & Unfiltered - Delhi', 'Comedy Shows', '2025-11-08', 'Delhi', 'Indira Gandhi Indoor Stadium: New Delhi', 'comedy3.jpg', '999.00'),
(4, 'Max Amini - Delhi', 'Comedy Shows', NULL, 'Delhi', 'Yashobhoomi Convention Center: Delhi', 'comedy4.jpg', '1699.00'),
(5, 'Rambo Circus - Delhi ', 'Kids', '2025-12-05', 'Delhi', 'Talkatora Stadium: Delhi', 'kids.jpg', '500.00'),
(6, 'Daily ka Kaam Hai By Aakash Gupta', 'Comedy Shows', '2025-09-17', 'Delhi', 'The Laugh Casa, Rcube Monad Mall: Noida', 'comedy2.jpg', '999.00'),
(8, 'Indias Biggest Halloween Ft. Talwiinder - Delhi', 'Music Shows', '2025-11-02', 'Delhi', 'Venue To Be Announced: Delhi (NCR)', 'music1.jpg', '3000.00'),
(9, 'Saturday Open Mic - Unmukt Delhi', 'Performances', '2025-09-20', 'Delhi', 'Unmukt studio: Delhi', 'performance.jpg', '149.00'),
(10, 'Nayab Midha Live', 'Performances', '2025-09-29', 'Delhi', 'The Laugh Store: DLF Cyberhub, Gurugram', 'performance1.jpg', '999.00'),
(11, 'Shaan - Live Concert Delhi', 'Music Shows', '2025-10-01', 'Delhi', 'Major Dhyanchand National Stadium: Delhi', 'music2.jpg', '1299.00'),
(12, 'FUNKY ISLAND - JASOLA', 'Kids', '2025-09-15', 'Delhi', 'Funky Island - Jasola: Delhi', 'kids1.jpg', '990.00'),
(13, 'Magic Show by Magician O P Sharma Jr.', 'Performances', '2025-09-19', 'Delhi', 'Aiwan-E-Ghalib Auditorium: Delhi', 'performance2.jpg', '150.00'),
(21, 'Sachet-Parampara Live Concert - Delhi', 'Music Shows', '2025-09-28', 'Delhi', 'Major Dhyanchand National Stadium: Delhi', 'music3.jpg', '999.00'),
(22, 'Navratri Special - Garba Dance Workshop for Kids', 'Kids', '2025-09-28', 'Delhi', 'Inomi Creative Labs: Gurugram', 'kids2.jpg', '499.00'),
(23, 'FUNKY ISLAND - NIRMAN VIHAR', 'Kids', '2025-09-24', 'Delhi', 'Funky Island - Nirman Vihar: Delhi', 'kids3.jpg', '990.00'),
(24, 'Blaaze NSP', 'Performances', '2025-09-24', 'Delhi', 'Blaaze , Netaji Subhash Palace: New Delhi', 'performance3.jpg', '990.00');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `details` text,
  `price` decimal(10,2) NOT NULL,
  `duration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `image`, `details`, `price`, `duration`) VALUES
(1, 'Demon Slayer: Kimetsu no Yaiba Infinity Castle', 'Deamon.jpg', 'Action/Adventure/Anime', '300.00', 120),
(2, 'Param Sundari', 'param.jpg', 'Comedy/Drama/Romantic', '450.00', 100),
(3, 'Baaghi 4', 'baaghi.jpg', 'Action/Thriller', '300.00', 100),
(4, 'The Conjuring: Last Rites', 'Conjuring.jpg', 'Horror/Thriller', '270.00', 135),
(5, 'Ek Chatur Naar', 'chatur.jpg', 'Comedy/Thriller', '300.00', 120),
(6, 'Mahavatar Narsimha', 'mahavatar.jpg', 'Action/Animation/Drama/Mythological', '350.00', 110),
(7, 'The Bengal Files', 'bengal.jpg', 'Drama/Historical', '300.00', 115),
(8, 'Mirai', 'Mirai.jpg', 'Action/Adventure/Thriller/Fantasy', '300.00', 95),
(9, 'Heer Express', 'heer.jpg', 'Comedy/Drama/Family', '300.00', 120),
(10, 'Lokah: Chapter 1 - Chandra', 'lokah.jpg', 'Action/Comedy/Fantasy', '400.00', 150),
(11, 'Downton Abbey: The Grand Finale', 'Downtown.jpg', 'Drama/Period/Romantic', '350.00', 135),
(12, 'Vash Level 2', 'vash.jpg', 'Supernatural/Thriller', '400.00', 120),
(13, 'Jolly LLB 3', 'jolly.jpg', 'comedy,Drama', '400.00', 135),
(16, 'Ajey: The Untold Story of a Yogi', 'ajey.jpg', 'Biography/Drama', '300.00', 140),
(17, 'Nishaanchi', 'nisha.jpg', 'Crime/Drama', '400.00', 150),
(18, 'They Call Him OG', 'call.jpg', 'Action/Crime/Drama/Thriller', '300.00', 140);

-- --------------------------------------------------------

--
-- Table structure for table `sports_events`
--

CREATE TABLE `sports_events` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `details` text,
  `image` varchar(255) DEFAULT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sports_events`
--

INSERT INTO `sports_events` (`id`, `name`, `category`, `date`, `city`, `details`, `image`, `price`) VALUES
(1, 'INDIA VS SRI LANKA- ICC WOMEN\'S CWC 2025', 'Cricket', '2025-09-30', 'Delhi', 'ACA STADIUM, GUWAHATI', 'cricket1.jpg', 250),
(2, 'IGPL INVITATIONAL 2025- DELHI NCR BY GAURAV GHEI', 'Golf', '2025-09-17', 'Delhi', 'Jaypee Greens Golf and spa Resort: Greater Noida\r\n', 'golf.jpg', 150),
(3, 'DP World India Championship 2025', 'Golf', '2025-10-16', 'Delhi', 'Delhi Golf Club', 'golf2.jpg', 200),
(4, 'Mahatma Virtual Marathon- Get Medal by Courier', 'Running', '2025-09-14', 'Delhi', 'Your Place Your Time', 'mg.jpg', 100),
(5, 'RIDE FOR SOMEONE- Virtual Cyclothon', 'Cycling', '2025-09-14', 'Delhi', 'Your Place Your Time', 'ride.jpg', 100),
(6, 'Fit Ride', 'Cycling', '2025-09-14', 'Delhi', 'Your place Your Time', 'ride2.jpg', 100),
(7, 'Mahakumbh Year 2025 Cyclathon', 'Cycling', '2025-09-14', 'Delhi', 'Your Place and Your Time', 'ride3.jpg', 150),
(8, 'Bharat Cycling Challenge- Get Medal by Courier', 'Cycling', '2025-09-14', 'delhi', 'Your Place and Your Time:India', 'ride4.jpg', 100),
(9, 'NEW ZEALAND VS SOUTH AFRICA -ICC WOMEN\'S CWC 2025', 'Cricket', '2025-10-06', 'Delhi', 'Holkar Stadium: Indore', 'cricket2.jpg', 250),
(10, 'INDIA VS SOUTH AFRICA -ICC WOMEN\'S CWC 2025', 'Cricket', '2025-10-09', 'Delhi', 'ACA-VDCA Cricket Stadium: Visakhapatnam', 'cricket3.jpg', 250),
(11, 'NEW ZEALAND VS BANGLADESH -ICC WOMEN\'S CWC 2025', 'Cricket', '2025-10-10', 'Delhi', 'ACA STADIUM, GUWAHATI', 'cricket4.jpg', 250),
(12, 'AUSTRALIA VS BANGLADESH -ICC WOMEN\'S CWC 2025', 'Cricket', '2025-10-16', 'Delhi', 'ACA-VDCA Cricket Stadium: Visakhapatnam', 'cricket5.jpg', 250);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'kapil', 'kapil.nsic07@gmail.com', '$2y$10$T22OyX6aFRm6hbyIGSEGeOQMRrbqGgxLiVCjXD40kr9BKq2xiX0vi', '2025-09-05 13:07:15'),
(2, 'Anuj', 'anuj015@gmail.com', '$2y$10$Ak63.fOQGrQAyEyPVA1Qdu3sxTAW7KjgSA/E2PINAhUrab0VoJf6m', '2025-09-05 13:54:57'),
(3, 'demo', 'demo_102@gmail.com', '$2y$10$LPSBIucxxdAN2kcduA1Ap.2hhVBDOFS.NQ90lR2XwFtW95fifxoJC', '2025-09-05 14:04:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_no` (`ticket_no`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sports_events`
--
ALTER TABLE `sports_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sports_events`
--
ALTER TABLE `sports_events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
