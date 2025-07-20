-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 04:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orb_supplier`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sizes` varchar(100) DEFAULT NULL,
  `colors` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `status` enum('Available','Out of Stock','Discontinued') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `sizes`, `colors`, `stock`, `status`) VALUES
(3, 'Stoic', 'A celebration of timeless style and enduring strength. Inspired by the philosophy of resilience and simplicity, this collection blends minimalist designs with powerful, elevated details. ', 799.00, 'Stoic.jpg', 'S, M, L, XL', 'Midnight Blue, Shadow Grey', 10, 'Available'),
(4, 'Epiphany', 'A moment of sudden and great realization.', 899.00, 'Epiphany.jpg', 'S, M, L, XL', 'Heather Grey, Noir Black', 0, 'Out of Stock'),
(5, 'Elysium', 'The complete freedom to act as one wishes or thinks best.', 699.00, 'Elysium.jpg', 'S, M, L, XL', 'Azure Blue, Calm White', 8, 'Available'),
(6, 'Liebe', 'Silent language of the heart, an enduring force that shapes our connections, enriches our existence, and whispers the profound beauty of human emotion.\r\n', 699.00, 'Liebe.jpg', 'S, M, L, XL', 'Cream, Maroon', 0, 'Out of Stock'),
(8, 'Lui et Elle', 'shinid', 599.00, 'Lui et Elle.jpg', 'S, M, L, XL', 'Black, White', 10, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Shei De Leon', 'shei@example.com', '$2y$10$OlFOTLt/.XwA1f2t.mBS5.4Fj7DQzQa3AlM34nBvYkGzGgM2YIBGS'),
(2, 'Marco Rivera', 'marco@example.com', '$2y$10$OlFOTLt/.XwA1f2t.mBS5.4Fj7DQzQa3AlM34nBvYkGzGgM2YIBGS'),
(3, 'Alyssa Gomez', 'alyssa@example.com', '$2y$10$OlFOTLt/.XwA1f2t.mBS5.4Fj7DQzQa3AlM34nBvYkGzGgM2YIBGS'),
(4, 'John Cruz', 'john@example.com', '$2y$10$OlFOTLt/.XwA1f2t.mBS5.4Fj7DQzQa3AlM34nBvYkGzGgM2YIBGS'),
(5, 'Faith Santos', 'faith@example.com', '$2y$10$OlFOTLt/.XwA1f2t.mBS5.4Fj7DQzQa3AlM34nBvYkGzGgM2YIBGS'),
(6, 'Shei Nicolle', 'sheinicolle@gmail.com', '$2y$10$2Qt5wehG1HtYem.PG1D79O/5gc4UHYxZ2mBHQA/bJXVL/Wjz7SeTK'),
(7, 'Shei Nicolle', 'sheinicolle.deleon@gmail.com', '$2y$10$58SM4Pi9.9IKBFUP63eD1.SSRfnm5EZKe1c0Rcipr8qKEnHJBxO8a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
