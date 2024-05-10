-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2024 at 06:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcd`
--

-- --------------------------------------------------------

--
-- Table structure for table `cover`
--

CREATE TABLE `cover` (
  `id` int NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cover`
--

INSERT INTO `cover` (`id`, `image_name`, `image_path`, `alt_text`, `description`) VALUES
(8, 'Slide 2', 'global/img/uploads/carousel/2020-Koenigsegg-Jesko-009-2160.jpg', '', ''),
(9, 'Slide 3', 'global/img/uploads/carousel/2020-Koenigsegg-Jesko-010-2160.jpg', 'Slide 3', ''),
(10, 'Slide 4', 'global/img/uploads/carousel/2020-Koenigsegg-Jesko-011-2160.jpg', 'Slide 4', ''),
(13, 'Slide 5', 'global/img/uploads/carousel/2020-Koenigsegg-Jesko-007-2160.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image_name`, `image_path`, `alt_text`, `description`) VALUES
(8, 'Apparel &amp; Accessories', 'global/img/uploads/products/desain kaos keren.png', '', ''),
(9, 'Merchandise &amp; Souvenir', 'global/img/uploads/products/desain merchandise.png', '', ''),
(10, 'Percetakan dan Fotocopy', 'global/img/uploads/products/digital printing 24 jam.png', '', ''),
(11, 'Digital Printing &amp; Digital Offset', 'global/img/uploads/products/percetakan terdekat.png', '', ''),
(12, 'Desain Grafis', 'global/img/uploads/products/desain rumah minimalis.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`) VALUES
(7, 'banguncitradata', '$2y$10$63bx8pTIfSa9q8UkbpRYsO3vv4d3xGNkMSS4Dim8IJxO8HOHQ5qmC', '2024-05-10 06:27:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cover`
--
ALTER TABLE `cover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cover`
--
ALTER TABLE `cover`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
