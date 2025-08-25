-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2025 at 09:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `produkt`
--

CREATE TABLE `produkt` (
  `id` varchar(30) NOT NULL,
  `bez` varchar(255) NOT NULL,
  `beschr` varchar(255) NOT NULL,
  `preis` decimal(10,2) NOT NULL,
  `tierart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkt`
--

INSERT INTO `produkt` (`id`, `bez`, `beschr`, `preis`, `tierart`) VALUES
('1', 'Katzenfutter trocken vom Rind.', '500g Trockenfutter für Katzen vom Rind.', 9.99, 2),
('10', 'futter', 'nassfutter', 3.00, 1),
('11', 'futter', 'nassfutter', 3.00, 1),
('12', 'futter', 'trockenfutter', 3.00, 2),
('13', 'futter', 'trockenfutter', 3.00, 1),
('14', 'futter', 'trockenfutter', 3.00, 1),
('15', 'futter', 'trockenfutter', 3.00, 1),
('16', 'futter', 'trockenfutter', 3.00, 1),
('17', 'futter', 'trockenfutter', 3.00, 1),
('18', 'futter', 'trockenfutter', 3.00, 1),
('19', 'futter', 'trockenfutter', 3.00, 1),
('2', 'Hundefutter trocken vom Rind.', '500g Trockenfutter für Hunde vom Rind.', 8.99, 1),
('20', 'futter', 'trockenfutter', 3.00, 2),
('3', 'Nassfutter für Katzen 1kg.', 'Nassfutter für Katzen 1kg.', 17.99, 2),
('4', 'Nassfutter für Katzen 500g.', 'Nassfutter für Katzen 500g.', 10.99, 2),
('5', 'Trockenfutter für Katzen 1kg.', 'Trockenfutter für Katzen 1kg.', 12.99, 2),
('6', 'Trockenfutter für Hunde 1kg.', 'Trockenfutter für Hunde 1kg.', 12.90, 1),
('7', 'Nassfutter für Hunde 500g.', 'Nassfutter für Hunde 500g.', 11.90, 1),
('8', 'Nassfutter für Hunde 1kg.', 'Nassfutter für Hunde 1kg.', 15.99, 1),
('9', 'futter', 'nassfutter', 3.00, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`id`);
COMMIT;
