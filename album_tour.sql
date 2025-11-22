-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 15, 2025 at 05:35 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tour_du_lich`
--

-- --------------------------------------------------------

--
-- Table structure for table `album_tour`
--

CREATE TABLE `album_tour` (
  `id` int NOT NULL,
  `tour_id` int NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `created_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `album_tour`
--

INSERT INTO `album_tour` (`id`, `tour_id`, `file_name`, `created_at`) VALUES
(1, 21, 'tour/album/1763183279-z6446856953195_b2075d34f5135ac50aa1ce4f3f856587.jpg', '2025-11-15 05:07:59'),
(2, 21, 'tour/album/1763183279-z6446856953196_28341d9d91362d72be9f4c62f9949aba.jpg', '2025-11-15 05:07:59'),
(3, 21, 'tour/album/1763183279-z6446856953197_bbcc131931c29325722ffc4e97622416.jpg', '2025-11-15 05:07:59'),
(4, 21, 'tour/album/1763183279-z6446856953216_8e87c12bcbda109d61ca24b72ac29d57.jpg', '2025-11-15 05:07:59'),
(5, 22, 'tour/album/1763183475-z6446856953197_bbcc131931c29325722ffc4e97622416.jpg', '2025-11-15 05:11:15'),
(6, 22, 'tour/album/1763183475-z6446856953216_8e87c12bcbda109d61ca24b72ac29d57.jpg', '2025-11-15 05:11:15'),
(7, 22, 'tour/album/1763183475-z6446856991507_2ff8ef50fff02ebfef68194e04c26add.jpg', '2025-11-15 05:11:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album_tour`
--
ALTER TABLE `album_tour`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album_tour`
--
ALTER TABLE `album_tour`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
