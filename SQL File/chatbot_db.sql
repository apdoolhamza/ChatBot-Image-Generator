-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 03:16 AM
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
-- Database: `chatbot_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(50) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `date_created`) VALUES
(1, 'ApdoolHamza', 'apdoolhamza@gmail.com', '$2y$10$Xjy.EtCKO/dG/959sbVnFu0zcQ5Uwt13E0Vo3WsxMGtrtSPwqYLgO', '2021-01-20 14:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `chat_history`
--

CREATE TABLE `chat_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `chat_summary` varchar(255) DEFAULT NULL,
  `full_chat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_history`
--

INSERT INTO `chat_history` (`id`, `user_id`, `chat_summary`, `full_chat`, `create_at`) VALUES
(1886, 1, 'Jan - Sat , what is your name?', '{\"user\":[\"what is your name?\",\"thanks\"],\"bot\":[\"My name is Gemma. 😊  \\n\",\"You\'re very welcome! Is there anything else I can help you with today? 😀 \\n\"]}', '2025-01-25 13:40:24'),
(1920, 1, 'Jan - Fri , hi', '{\"user\":[\"hi\",\"full stack web developer with loptop\"],\"bot\":[\"Hello! 👋  \\n\\nHow can I help you today? 😊 \\n\",\"<p class=\'mb-3\'><a class=\'btn p-2\' style=\'font-size:14px;border-radius:15px 15px 0 15px;background-color:#00000020;border:1px solid #00000020;display:block !important;\' href=\'generated_imgs/generated_image_1738323417.png\' download>Download <svg class=\'bi pe-none mb-1\' width=\'17\' height=\'17\'><use xlink:href=\'#downloadIcon\'/></svg></a></p><img id=\'generatedImg\' src=\'generated_imgs/generated_image_1738323417.png\'>\"]}', '2025-01-31 11:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `userpassword` varchar(100) DEFAULT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `userpassword`, `reg_date`) VALUES
(1, 'Apdoolmajeed Hamza', 'abdulmajeedone23@gmail.com', '$2y$10$Ei1QWTDM6sqgEBwHba8DBeEMPwdOx/JItUKMG9QMvdBDBpSu1GsFW', '2025-01-14 02:43:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_history`
--
ALTER TABLE `chat_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chat_history`
--
ALTER TABLE `chat_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1921;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
