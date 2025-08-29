-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2025 at 08:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `Produkt`
--

CREATE TABLE `Produkt` (
  `id` varchar(30) NOT NULL,
  `bez` varchar(255) NOT NULL,
  `beschr` varchar(255) NOT NULL,
  `preis` decimal(10,2) NOT NULL,
  `tierart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Produkt`
--

INSERT INTO `Produkt` (`id`, `bez`, `beschr`, `preis`, `tierart`) VALUES
('1', 'Katzenfutter trocken vom Rind.', '500g Trockenfutter für Katzen vom Rind.', 9.99, 2),
('2', 'Hundefutter trocken vom Rind.', '500g Trockenfutter für Hunde vom Rind.', 8.99, 1),
('3', 'Nassfutter für Katzen 1kg.', 'Nassfutter für Katzen 1kg.', 17.99, 2),
('4', 'Nassfutter für Katzen 500g.', 'Nassfutter für Katzen 500g.', 10.99, 2),
('5', 'Trockenfutter für Katzen 1kg.', 'Trockenfutter für Katzen 1kg.', 12.99, 2),
('6', 'Trockenfutter für Hunde 1kg.', 'Trockenfutter für Hunde 1kg.', 12.90, 1),
('7', 'Nassfutter für Hunde 500g.', 'Nassfutter für Hunde 500g.', 11.90, 1),
('8', 'Nassfutter für Hunde 1kg.', 'Nassfutter für Hunde 1kg.', 15.99, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Produkt`
--
ALTER TABLE `Produkt`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
