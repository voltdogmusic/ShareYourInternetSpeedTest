-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2019 at 06:49 AM
-- Server version: 8.0.15
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body` text,
  `publish_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `body`) VALUES
(1, 1, 3, 'This is comment one'),
(2, 2, 1, 'This is comment two'),
(3, 5, 3, 'This is comment three'),
(4, 2, 4, 'This is comment four'),
(5, 1, 2, 'This is comment five'),
(6, 3, 1, 'This is comment six'),
(7, 3, 2, 'This is comment six'),
(8, 5, 4, 'This is comment seven'),
(9, 2, 3, 'This is comment seven');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `body` text,
  `publish_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`) VALUES
(1, 1, 'Post One', 'This is post one'),
(2, 3, 'Post Two', 'This is post two'),
(3, 1, 'Post Three', 'This is post three'),
(4, 2, 'Post Four', 'This is post four'),
(5, 5, 'Post Five', 'This is post five'),
(6, 4, 'Post Six', 'This is post six'),
(7, 2, 'Post Seven', 'This is post seven'),
(8, 1, 'Post Eight', 'This is post eight'),
(9, 3, 'Post Nine', 'This is post none'),
(10, 4, 'Post Ten', 'This is post ten');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `dept` varchar(75) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `age` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `location`, `dept`, `is_admin`, `register_date`, `age`) VALUES
(1, 'Brad', 'Traversy', 'brad@gmail.com', '123456', 'Massachusetts', 'development', 1, '2019-08-22 12:30:36', 20),
(2, 'Fred', 'Smith', 'newEmail@gmail.com', '123456', 'New York', 'design', 0, '2019-08-22 12:57:41', NULL),
(3, 'Sara', 'Watson', 'sara@gmail.com', '123456', 'New York', 'design', 0, '2019-08-22 12:57:41', NULL),
(4, 'Will', 'Jackson', 'will@yahoo.com', '123456', 'Rhode Island', 'development', 1, '2019-08-22 12:57:41', NULL),
(5, 'Paula', 'Johnson', 'paula@yahoo.com', '123456', 'Massachusetts', 'sales', 0, '2019-08-22 12:57:41', NULL),
(6, 'Tom', 'Spears', 'tom@yahoo.com', '123456', 'Massachusetts', 'sales', 0, '2019-08-22 12:57:41', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `LIndex` (`location`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
